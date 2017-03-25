<?php

namespace app\fixtures;

use yii\test\ActiveFixture;

class ProductTagFixture extends ActiveFixture
{
    public $modelClass = 'app\modules\shop\models\frontend\ProductTag';
    public $dataFile = '@app/fixtures/data/product-tag.php';
} 