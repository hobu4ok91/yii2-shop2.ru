<?php

namespace app\fixtures;

use yii\test\ActiveFixture;

class AttributeFixture extends ActiveFixture
{
    public $modelClass = 'app\modules\shop\models\frontend\Attribute';
    public $dataFile = '@app/fixtures/data/attribute.php';
} 