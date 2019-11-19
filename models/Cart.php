<?php


namespace app\models;
use yii\base\model;

class Cart extends Model{

    public function addToCart($product, $qty = 1){

//        debugf($qty, '/_Cart_addToCart_qty.log');

        if( isset($_SESSION['cart'][$product->id]) ){
            $_SESSION['cart'][$product->id]['qty'] += $qty;
        }
        else{
            $_SESSION['cart'][$product->id] =
                [
                    'qty' => $qty,
                    'name' => $product->name,
                    'price' => $product->price,
                    'img' => $product->img,
                ];
        }

        $_SESSION['cart.qty'] = isset($_SESSION['cart.qty']) ? $_SESSION['cart.qty'] + $qty : $qty;
        $_SESSION['cart.sum'] = isset($_SESSION['cart.sum']) ? $_SESSION['cart.sum'] + $qty * $product->price : $qty * $product->price;

//        echo debug($_SESSION, true);
    }

    public function deleteFromCart($id){

        if( isset($_SESSION['cart'][$id]) ){

            $_SESSION['cart.qty'] = $_SESSION['cart.qty'] - $_SESSION['cart'][$id]['qty'];
            $_SESSION['cart.sum'] = $_SESSION['cart.sum'] - $_SESSION['cart'][$id]['qty'] * $_SESSION['cart'][$id]['price'];;

            unset($_SESSION['cart'][$id]);
        }
        else{
//            $_SESSION['cart'][$product->id] =
//                [
//                    'qty' => $qty,
//                    'name' => $product->name,
//                    'price' => $product->price,
//                    'img' => $product->img,
//                ];
        }
    }
}