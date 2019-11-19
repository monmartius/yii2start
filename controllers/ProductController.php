<?php


namespace app\controllers;
use app\models\Category;
use app\models\Product;


use app\controllers\AppController;
use yii\web\HttpException;

class ProductController extends AppController
{
    public function actionView(/*$id*/){

        $id = \Yii::$app->request->get('id');

        $product = Product::findOne($id);

        if(empty($product)) throw new HttpException(404, "Нет такого товара!");

//        $product = Product::find()->with('category')->where(['id' => $id])->limit(1)->one();
        $category = Category::find()->where(['id' => $product->category_id])->one();

        $hits = Product::find()->where(['hit'=> "1"])->limit(6)->all();

        return $this->render('view', compact('product', 'category', 'hits'));
    }
}