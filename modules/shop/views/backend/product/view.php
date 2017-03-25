<?php

use yii\data\ActiveDataProvider;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\shop\models\backend\Product */
/* @var $dataProvider ActiveDataProvider */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Products', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-view">

    <div class="h3">Основная информация</div>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            [
                'attribute' => 'category_id',
                'value' => function($model) {
                    return ArrayHelper::getValue($model, 'category.name');
                }
            ],
            'name',
            'content:ntext',
            'price',
            'active:boolean',
            'status',
        ],
    ]) ?>

    <div class="h3">Атрибуты товара</div>
    <p>
        <?= Html::a('Добавить характеристику', ['value/create', 'product_id' => $model->id], ['class' => 'btn btn-primary'])?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [

            [
                'attribute' => 'attribute_id',
                'value' => 'productAttribute.name'
            ],
            'value',

            [
                'class' => 'yii\grid\ActionColumn',
                'controller' => 'value'
            ],
        ],
    ]); ?>

</div>
