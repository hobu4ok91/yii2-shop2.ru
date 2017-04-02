<?php

namespace app\modules\shop\controllers\frontend;

use app\modules\shop\models\frontend\Category;
use app\modules\shop\models\frontend\Product;
use app\modules\shop\models\frontend\Tag;
use yii\data\ActiveDataProvider;
use yii\web\NotFoundHttpException;

class CatalogController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Product::find()->active()->with(['category', 'tags'])->orderBy(['id' => SORT_DESC]),
        ]);
        return $this->render('index', ['dataProvider' => $dataProvider]);
    }

    public function actionCategory($id)
    {
        $category = $this->findCategoryModel($id);
        $dataProvider = new ActiveDataProvider([
            'query' => Product::find()->active()->forCategory($category->id)->with(['category', 'tags'])->orderBy(['id' => SORT_DESC]),
        ]);
        return $this->render('category', [
            'dataProvider' => $dataProvider,
            'category' => $category
        ]);
    }

    public function actionTag($tag_name)
    {
        $tag = $this->findTagModel($tag_name);
        $dataProvider = new ActiveDataProvider([
            'query' => Product::find()->active()->forTag($tag->id)->with(['category', 'tags'])->orderBy(['id' => SORT_DESC]),
        ]);
        return $this->render('tag', [
            'dataProvider' => $dataProvider,
            'tag' => $tag
        ]);
    }

    public function actionView($id)
    {
        $model = $this->findProductModel($id);
        $dataProvider = new ActiveDataProvider(['query' => $model->getValues()]);
        return $this->render('view', [
            'model' => $model,
            'dataProvider' => $dataProvider
        ]);
    }

    protected function findCategoryModel($id)
    {
        if (($model = Category::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    protected function findTagModel($name)
    {
        if (($model = Tag::findOne(['name' => $name])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    protected function findProductModel($id)
    {
        if (($model = Product::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
