<?php

namespace app\modules\shop\models\backend\query;

/**
 * This is the ActiveQuery class for [[\app\modules\shop\models\frontend\Product]].
 *
 * @see \app\modules\shop\models\frontend\Product
 */
class ProductQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return \app\modules\shop\models\frontend\Product[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \app\modules\shop\models\frontend\Product|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
