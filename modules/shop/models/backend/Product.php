<?php
namespace app\modules\shop\models\backend;

class Product extends \app\modules\shop\models\frontend\Product
{
    private $_tagsArray;

    public function rules()
    {
        return [
            [['category_id', 'active', 'status'], 'integer'],
            [['name'], 'required'],
            [['content'], 'string'],
            [['tagsArray'], 'safe'],
            [['price'], 'number'],
            [['name'], 'string', 'max' => 255],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::className(), 'targetAttribute' => ['category_id' => 'id']],
        ];
    }

    public function getTagsArray()
    {
        if ($this->_tagsArray === null) {
            $this->_tagsArray =  $this->getTags()->select('id')->column();
        }
        return $this->_tagsArray;
    }

    public function setTagsArray($value)
    {
        $this->_tagsArray = (array)$value;
    }

    public function afterSave($insert, $changedAttributes)
    {
        $this->updateTags();
        parent::afterSave($insert, $changedAttributes);
    }

    protected function updateTags()
    {
        $currentTagIds = $this->getTags()->select('id')->column();
        $newTagsIds = $this->getTagsArray();

        $toInsert = [];
        foreach (array_filter(array_diff($newTagsIds, $currentTagIds)) as $tagId) {
            $toInsert[] = ['product_id' => $this->id, 'tag_id' => $tagId];
        }
        if ($toInsert) {
            ProductTag::getDb()->createCommand()->batchInsert(ProductTag::tableName(), ['product_id', 'tag_id'], $toInsert)->execute();
        }

        if ($toRemove = array_filter(array_diff($currentTagIds, $newTagsIds))) {
            ProductTag::deleteAll(['product_id' => $this->id, 'tag_id' => to]);
        }

        foreach (array_filter(array_diff($currentTagIds, $newTagsIds)) as $tagId) {
            if ($tag = Tag::findOne($tagId)) {
                $this->unlink('tags', $tag, true);
            }
        }
    }
}