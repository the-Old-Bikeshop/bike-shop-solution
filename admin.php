<?php

require_once('./web-shop/Routes.php');

function __autoload($class_name)
{

    if (file_exists('./web-shop/controllers/' . $class_name . '.php')) {
        require_once './web-shop/controllers/' . $class_name . '.php';
    } elseif (file_exists('./web-shop/controllers/admin/' . $class_name . '.php')) {
        require_once './web-shop/controllers/admin/' . $class_name . '.php';
    }

}


?>
<h1>The admin page at root</h1>