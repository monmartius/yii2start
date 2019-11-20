<?php


namespace app\controllers;
use app\controllers\AppController;
use app\models\Category;
use app\models\Product;
use Yii;
use yii\data\Pagination;


class CategoryController extends AppController
{
    public function actionIndex(){

//        $hits = Product::find()->where(['hit' => '1'])->indexBy('id')->asArray()->limit(6)->all();
//        debug($hits);
        //        die();
        $hits = Product::find()->where(['hit' => '1'])->limit(6)->all();
        $this->setMeta("E-SHOPPER");
        debugf($hits, "hits.log");

        return $this->render('index', compact('hits'));
    }

//    public function actionView($id){
    public function actionView(){

        $id = Yii::$app->request->get('id');
//        die();

//        $products = Product::find()->where(['category_id' => $id])->asArray()->all();
//        $products = Product::find()->where(['category_id' => $id])->all();
        $query = Product::find()->where(['category_id' => $id]);

        $category = Category::findOne($id);

        if(empty($category))
            throw new \yii\web\HttpException(404, 'Такой категории нет.');

        $pages = new Pagination([
            'totalCount' => $query->count(),
            'pageSize' => 2,
            'forcePageParam' => false,
            'pageSizeParam' => false
        ]);

        $products = $query->offset($pages->offset)->limit($pages->limit)->all();
        $this->setMeta("E-SHOPPER " . $category->name, $category->keywords, $category->description);
//        debugd($products);
        return $this->render('view', compact('products', 'category', 'pages'));
    }

    public function actionSearch(){

        $q = trim(Yii::$app->request->get('q'));

        if(!$q) return $this->render('search');
//        debugd(gettype($q));
        $query = Product::find()->where(['like', 'name', $q]);
        $pages = new Pagination([
            'totalCount' => $query->count(),
            'pageSize' => 3,
            'forcePageParam' => false,
            'pageSizeParam' => false
        ]);
        $this->setMeta("E-SHOPPER " . $q);
        $products = $query->offset($pages->offset)->limit($pages->limit)->all();
        return $this->render('search', compact('products', 'pages', 'q'));
    }
//
}