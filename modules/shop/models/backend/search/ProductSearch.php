<?php

namespace app\modules\shop\models\backend\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\shop\models\backend\Product;

/**
 * ProductSearch represents the model behind the search form about `app\modules\shop\models\backend\Product`.
 */
class ProductSearch extends Product
{
    public $tag_id;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'category_id', 'tag_id', 'active', 'status'], 'integer'],
            [['name', 'content'], 'safe'],
            [['price'], 'number'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Product::find()->joinWith(['category', 'productTags'])->with(['tags']);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => ['id' => SORT_DESC],
                'attributes' => [
                    'id',
                    'name',
                    'price',
                    'active',
                    'status',
                    'category_id' => [
                        'asc' => ['category.name' => SORT_ASC],
                        'desc' => ['category.name' => SORT_DESC],
                    ],
                ],
            ]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'category_id' => $this->category_id,
            'price' => $this->price,
            'active' => $this->active,
            'status' => $this->status,
            'product_tag.tag_id' => $this->tag_id,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'content', $this->content]);

        return $dataProvider;
    }
}
