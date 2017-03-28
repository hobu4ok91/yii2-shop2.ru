<?php

use app\modules\shop\models\backend\Category;
use app\modules\shop\models\backend\Tag;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\shop\models\backend\Product */
/* @var $form yii\widgets\ActiveForm */
/* @var $values app\modules\shop\models\backend\Value */
?>


<div class="product-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'category_id')->dropDownList(Category::find()->select(['name', 'id'])->indexBy('id')->column()) ?>

            <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'content')->textarea(['rows' => 6]) ?>

            <?= $form->field($model, 'price')->textInput() ?>

            <?= $form->field($model, 'active')->textInput() ?>

            <?= $form->field($model, 'tagsArray')->checkboxList(Tag::find()->select(['name', 'id'])->indexBy('id')->column()) ?>
        </div>
        <div class="col-md-6">
            <?php foreach ($values as $value): ?>
                <?= $form->field($value, '[' . $value->productAttribute->id . ']value')->label($value->productAttribute->name); ?>
            <?php endforeach; ?>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>

