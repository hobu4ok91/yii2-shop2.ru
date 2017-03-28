<?php

use app\modules\shop\models\backend\Value;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\shop\models\backend\Value */
/* @var $form yii\widgets\ActiveForm */
/* @var $values Value */
?>

<div class="value-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'product_id')->textInput() ?>

            <?= $form->field($model, 'attribute_id')->textInput() ?>

            <?= $form->field($model, 'value')->textInput(['maxlength' => true]) ?>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
