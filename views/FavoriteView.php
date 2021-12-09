<?php

require_once ('controllers/FavoriteProductsController.php');

$fav = new FavoriteProductsController();
$previous = '';
if(isset($_SERVER['HTTP_REFERER'])) {
    $previous = $_SERVER['HTTP_REFERER'];
}

if (!isset($_SESSION['userID'])) {
    $fav->message = 'Login to add product to favorite';
}else{
    $fav->setData();
    $fav->likeAction();
    new RedirectHandler($previous);
}

?>

