<?php
    require_once('./Routes.php');

    function __autoload($class_name) {


        if (file_exists('./controllers/'.$class_name.'.php')) {
            require_once './controllers/'.$class_name.'.php';
        } elseif (file_exists('./controllers/admin/'.$class_name.'.php')) {
            require_once './controllers/admin/'.$class_name.'.php';
        }

    }
    
?>

<h1>you are logged in</h1>
