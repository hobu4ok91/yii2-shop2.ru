<?php

namespace app\modules\shop\controllers\frontend;

use app\modules\shop\models\frontend\Product;
use yii\data\ActiveDataProvider;

class CatalogController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Product::find()->active()->with(['category', 'tags'])->orderBy(['id' => SORT_DESC]),
        ]);
        return $this->render('index', ['dataProvider' => $dataProvider]);
    }

}
