<?php

namespace app\fixtures;

use yii\test\ActiveFixture;

class TagFixture extends ActiveFixture
{
    public $modelClass = 'app\modules\shop\models\frontend\Tag';
    public $dataFile = '@app/fixtures/data/tag.php';
} 