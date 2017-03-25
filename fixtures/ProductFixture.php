<?php

namespace app\fixtures;

use yii\test\ActiveFixture;

class ProductFixture extends ActiveFixture
{
    public $modelClass = 'app\modules\shop\models\frontend\Product';
    public $dataFile = '@app/fixtures/data/product.php';
} 