<?php

namespace app\fixtures;

use yii\test\ActiveFixture;

class ValueFixture extends ActiveFixture
{
    public $modelClass = 'app\modules\shop\models\frontend\Value';
    public $dataFile = '@app/fixtures/data/value.php';
} 