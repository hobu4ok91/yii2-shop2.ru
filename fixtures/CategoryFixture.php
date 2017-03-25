<?php

namespace app\fixtures;

use yii\test\ActiveFixture;

class CategoryFixture extends ActiveFixture
{
    public $modelClass = 'app\modules\shop\models\frontend\Category';
    public $dataFile = '@app/fixtures/data/category.php';
} 