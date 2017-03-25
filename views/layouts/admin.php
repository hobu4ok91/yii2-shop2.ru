<?php

use app\widgets\Alert;
use app\modules\admin\Module;
use yii\helpers\ArrayHelper;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;

/* @var $this \yii\web\View */
/* @var $content string */

/** @var \yii\web\Controller $context */
$context = $this->context;

if (isset($this->params['breadcrumbs'])) {
    $panelBreadcrumbs = [['label' => Module::t('module', 'ADMIN'), 'url' => ['/admin/default/index']]];
    $breadcrumbs = $this->params['breadcrumbs'];
} else {
    $panelBreadcrumbs = [Module::t('module', 'ADMIN')];
    $breadcrumbs = [];
}
?>
<?php $this->beginContent('@app/views/layouts/layout.php'); ?>

<?php
NavBar::begin([
    'brandLabel' => Yii::$app->name,
    'brandUrl' => Yii::$app->homeUrl,
    'options' => [
        'class' => 'navbar-inverse navbar-fixed-top',
    ],
]);
echo Nav::widget([
    'options' => ['class' => 'navbar-nav navbar-right'],
    'activateParents' => true,
    'items' => array_filter([
        ['label' => Yii::t('app', 'NAV_ADMIN'), 'url' => ['/admin/default/index']],
        ['label' => 'Магазин', 'items' => [
            ['label' => 'Продукты', 'url' => ['/admin/shop/product/index']],
            ['label' => 'Категории', 'url' => ['/admin/shop/category/index']],
            ['label' => 'Аттрибуты', 'url' => ['/admin/shop/attribute/index']],
            ['label' => 'Значения', 'url' => ['/admin/shop/value/index']],
            ['label' => 'Метки', 'url' => ['/admin/shop/tag/index']],
            ['label' => 'Метки продуктов', 'url' => ['/admin/shop/product-tag/index']],
        ]],
        ['label' => Yii::t('app', 'NAV_ADMIN_USERS'), 'url' => ['/admin/user/default/index'], 'active' => $context->module->id == 'users'],
        ['label' => Yii::t('app', 'NAV_LOGOUT'), 'url' => ['/user/default/logout'], 'linkOptions' => ['data-method' => 'post']]
    ]),
]);
NavBar::end();
?>

<div class="container">
    <?= Breadcrumbs::widget([
        'links' => ArrayHelper::merge($panelBreadcrumbs, $breadcrumbs),
    ]) ?>
    <?= Alert::widget() ?>
    <?= $content ?>
</div>

<?php $this->endContent(); ?>