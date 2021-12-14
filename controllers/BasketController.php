<?php


class BasketController extends ViewController {

    private $product;

    public function addToBasket() {

        session_start();

        if ( isset($_POST['add']) ){

            $_SESSION['basket']=array(
                array("productID"=>"productID","name"=>"name","quantity"=>"quantity","price"=>"price","discount"=>"discount")
            ); 
            var_dump($_SESSION['basket']);
        }
    }

}
