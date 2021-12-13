<?php


class BasketController extends ViewController {

    private $product;

    public function addToBasket() {

        session_start();

        if ( isset($_POST['add']) ){

            // $_SESSION['basket']=array(array("product"=>"apple","quantity"=>2),
            //     array("product"=>"Orange","quantity"=>4),
            //     array("product"=>"Banana","quantity"=>5),
            //     array("product"=>"Mango","quantity"=>7),
            //     // array("productID"=>"productID","name"=>"name","quantity"=>"quantity","price"=>"price","discount"=>"discount")
            // ); 
            echo "gowno";
        }
    }

}
