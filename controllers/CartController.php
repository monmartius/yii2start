<?php


namespace app\controllers;
use app\models\Product;
use app\models\Cart;
use Yii;
use app\models\OrderItems;
use app\models\Order;

class CartController extends AppController
{
    public function actionAdd(){

        $this->layout = false;

        $id = Yii::$app->request->get("id");
        $qty = Yii::$app->request->get("qty");

        $qty = (integer)$qty;

        if( $qty == 0 ){
            $qty = 1;
        }

        $product = Product::findOne($id);


        if(empty($product)) return 'ffff';

        $session = Yii::$app->session;

        $session->open();

        $cart = new Cart();
//
        debugf($qty, "_CartController_actionAdd_qty.log");
        $cart->addToCart($product, $qty);
//        $this->addToCart($product);
//

        return $this->render('cart-modal', compact('session'));

    }

    public function actionClear(){
        $this->layout = false;
        $session = Yii::$app->session;
        $session->remove('cart');
        $session->remove('cart.qty');
        $session->remove('cart.sum');


        return $this->render('cart-modal', compact('session'));
    }

    public function actionDelete(){


        $this->layout = false;
        $session = Yii::$app->session;


        $id = Yii::$app->request->get('id');


        if(!$id) return $this->render('cart-modal', compact('session'));
        if(!$session['cart'][$id]) return $this->render('cart-modal', compact('session'));

        $cart = new Cart();

        $cart->deleteFromCart($id);

//        $cart = $session['cart'];
//
//        $session['cart.qty'] = $session['cart.qty'] - $cart["$id"]['qty'];
//        $session['cart.sum'] = $session['cart.sum'] - $cart["$id"]['qty'] * $cart["$id"]['price'];
//
//        unset($cart["$id"]);
//
//        $session['cart'] = $cart;

        return $this->render('cart-modal', compact('session'));
    }

    public function actionShow(){

        $this->layout = false;

        $session = Yii::$app->session;
        $session->open();
//        $cart = new Cart();
//        $cart->getCart($product);

        return $this->render('cart-modal', compact('session'));
    }

    public function actionView(){
        $session = Yii::$app->session;
        $session->open();
        $this->setMeta("Корзина");
        $order = new Order();

        if($order->load(Yii::$app->request->post())){

            $order->qty = $session['cart.qty'];
            $order->sum = $session['cart.sum'];

            if($order->save()){
                $this->saveOrderItems($session['cart'], $order->id);
                Yii::$app->session->setFlash('success', 'Ваш заказ принят, менеджер вскоре свяжется с вами.');

                Yii::$app->mailer->compose(
                    'order',
                    compact ('session'))
                    ->setFrom('r.e.g.4@yandex.ru')
                    ->setTo($order->email)
                    ->setSubject('Заказ')
                    ->setTextBody('Вам письмо!')
                    ->send();

                $session->remove('cart');
                $session->remove('cart.qty');
                $session->remove('cart.sum');
                return $this->refresh();
            }
            else{
                Yii::$app->session->setFlash('error', 'Ошибка оформления заказа.');
            }

        };


        return $this->render('view', compact('order', 'session'));
    }

    protected function saveOrderItems($items, $order_id){
        foreach ($items as $id => $item) {
            $order_items = new OrderItems();
            $order_items->order_id = $order_id;
            $order_items->product_id = $id;
            $order_items->name = $item['name'];
            $order_items->price = $item['price'];
            $order_items->qty_item = $item['qty'];
            $order_items->sum_item = $item['qty'] * $item['price'];
            $order_items->save();
        }
    }

}