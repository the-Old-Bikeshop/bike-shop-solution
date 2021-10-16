<?php
    require_once('./Routes.php');

    function __autoload($class_name) {

        if (file_exists('./controllers/'.$class_name.'.php')) {

            require_once './controllers/'.$class_name.'.php';

        }

    }
    
?>