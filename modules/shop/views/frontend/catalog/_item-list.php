<?php

use yii\bootstrap\Html;

/* @var $model app\modules\shop\models\frontend\Product */
/* @var $this yii\web\View */


$tagLinks = [];
foreach ($model->tags as $tag) {
    $tagLinks[] = Html::a(Html::encode($tag->name), ['tag', 'tag_name' => $tag->name]);
}

?>

<div class="panel panel-default">
    <div class="panel-heading">
        <span class="pull-right"><?= $model->price ?></span>
        <?= Html::a(Html::encode($model->name), ['view', 'id' => $model->id]) ?>
    </div>
    <div class="panel-body">
        <p>Категория: <?= $model->category ? Html::a(Html::encode($model->category->name), ['category', 'id' => $model->category_id]) : 'Без категории' ?></p>
        <?php if ($tagLinks): ?>
            <p>Метки: <?= implode(', ', $tagLinks) ?></p>
        <?php endif; ?>
        <div><?= Yii::$app->formatter->asNtext($model->content) ?></div>
    </div>
</div>


