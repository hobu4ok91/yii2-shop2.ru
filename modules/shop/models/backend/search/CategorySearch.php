<?php

namespace app\modules\shop\models\backend\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\shop\models\backend\Category;
use yii\db\Expression;

/**
 * CategorySearch represents the model behind the search form about `app\modules\shop\models\backend\Category`.
 */
class CategorySearch extends Category
{
    public $products_count;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'parent_id', 'products_count'], 'integer'],
            [['name'], 'safe'],
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
        $query = Category::find()->select(['category.*', 'products_count' => new Expression('COUNT(product.id)')])
            ->joinWith(['products'], false)
            ->groupBy('category.id')
            ->with(['parent']);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'attributes' => [
                    'id',
                    'name',
                    'parent_id',
                    'products_count'
                ]
            ],
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
            'parent_id' => $this->parent_id,
        ]);
        $query->andFilterWhere(['like', 'category.name', $this->name]);

        if ($this->products_count === 0 || $this->products_count > 0) {
            $query->andHaving(['products_count' => $this->products_count]);
        }


        return $dataProvider;
    }
}
