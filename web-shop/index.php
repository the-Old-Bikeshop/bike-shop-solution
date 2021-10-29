<?php  include_once "./includes/adminNavigation.php"?>

<h1>This is the index above</h1>
<?php
    require_once('./Routes.php');

    function __autoload($class_name) {


        if (file_exists('./controllers/'.$class_name.'.php')) {
            require_once './controllers/'.$class_name.'.php';
        } elseif (file_exists('./controllers/admin/'.$class_name.'.php')) {
            require_once './controllers/admin/'.$class_name.'.php';
        } elseif (file_exists('./public/includes/'.$class_name.'.php')) {
            require_once './public/includes/'.$class_name.'.php';
        }

    }
    
?>

<h1>This is the index php</h1>

