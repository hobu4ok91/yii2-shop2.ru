<?php

namespace app\modules\shop\models\backend\query;
use app\modules\shop\models\frontend\Category;
use app\modules\shop\models\frontend\ProductTag;

/**
 * This is the ActiveQuery class for [[\app\modules\shop\models\frontend\Product]].
 *
 * @see \app\modules\shop\models\frontend\Product
 */
class ProductQuery extends \yii\db\ActiveQuery
{
    public function active()
    {
        return $this->andWhere(['active' => true]);
    }

    /**
     * @inheritdoc
     * @return self
     */
    public function forCategory($id)
    {
        $ids = [$id];
        $childrenIds = [$id];
        while ($childrenIds = Category::find()->select('id')->andWhere(['parent_id' => $childrenIds])->column()) {
            $ids = array_merge($ids, $childrenIds);
        }
        return $this->andWhere(['category_id' => array_unique($ids)]);
    }
    /**
     * @inheritdoc
     * @return self
     */
    public function forTag($id)
    {
        return $this->joinWith(['productTags'], false)->andWhere([ProductTag::tableName() . '.tag_id' => $id]);
    }

    /**
     * @inheritdoc
     * @return \app\modules\shop\models\frontend\Product[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \app\modules\shop\models\frontend\Product|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
