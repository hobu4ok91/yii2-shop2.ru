<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\shop\models\backend\Product */
/* @var $values app\modules\shop\models\backend\Value */

$this->title = 'Create Product';
$this->params['breadcrumbs'][] = ['label' => 'Products', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'values' => $values,
    ]) ?>

</div>
