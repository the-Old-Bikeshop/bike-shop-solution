<?php


class BasketController extends ViewController {

    private $product;
   public function quantityAction() {
        if(isset($_POST['action']) ) {
            if($_POST['action'] == 'add') {
                $_SESSION['basket'][$_POST['index']]['quantity']++;
            }elseif(($_POST['action'] == 'retract') && count($_SESSION['basket']) > 0) {
                $_SESSION['basket'][$_POST['index']]['quantity']--;
                if ($_SESSION['basket'][$_POST['index']]['quantity'] <= 0) {
                    array_splice($_SESSION['basket'], $_POST['index'], 1);
                }
            }
        }
    }





    public function addToBasket() {

//        session_start();

        if ( isset($_POST['add']) ){
//            var_dump($_SESSION['basket']);

            if(!isset($_SESSION['basket'])) {
                $_SESSION['basket'] = [];
            }

//             $productID = $_POST['productID'];

            $localProduct = [
                "productID"=>$_POST['productID'],
                "name"=>$_POST['name'],
                "quantity"=>$_POST['quantity'],
                "price"=>$_POST['price'],
                "discount"=>$_POST['discount']
            ];

             if(count($_SESSION['basket']) > 0) {
                 foreach ($_SESSION['basket'] as $index=>$item) {
                     if($item['productID'] == $_POST['productID']) {

                         $_SESSION['basket'][$index]['quantity']++;
                         return;
                     }
                 } array_push($_SESSION['basket'], $localProduct);
             } else {
                 array_push($_SESSION['basket'], $localProduct);
            }
        }


    }

}
