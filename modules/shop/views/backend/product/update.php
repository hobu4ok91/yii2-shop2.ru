<?php

use app\modules\shop\models\backend\Value;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\shop\models\backend\Product */
/* @var $values Value[] */

$this->title = 'Update Product: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Products', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="product-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'values' => $values
    ]) ?>

</div>
