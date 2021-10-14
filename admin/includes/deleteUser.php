<?php
spl_autoload_register(function ($class)
{require_once"../classes/".$class.".php";});

if(isset($_POST["delete"])) {
    var_dump($_POST);
    $user = new User();
    $user->deleteUser($_POST["userID"]);

}