<?php

spl_autoload_register(function ($class_name) {

    // Define an array of directories in the order of their priority to iterate through.
    $dirs = array(
        'models/',
        'controllers/',
        'controllers/admin/',
    );

    // Looping through each directory to load all the class files. It will only require a file once.
    // If it finds the same class in a directory later on, IT WILL IGNORE IT! Because of that require once!
    foreach ($dirs as $dir) {
        if (file_exists($dir . $class_name . '.php')) {
            require_once($dir . $class_name . '.php');
            return;
        }
    }
});
?>
<?php require 'controllers/SessionHandler.php';

$session = new SessionHandle();
$session->startSession();
$session->setToken();?>

<?php $logout = new LogoutController();
$logout->logoutCheck();?>

<?php require('./components/Header.php')?>

    <?php require_once('./Routes.php');

    function loadView($class_name) {

        if (file_exists('./controllers/' . $class_name . '.php')) {
            require_once './controllers/' . $class_name . '.php';
        } elseif (file_exists('./controllers/admin/' . $class_name . '.php')) {
            require_once './controllers/admin/' . $class_name . '.php';
        } elseif (file_exists('./public/includes/' . $class_name . '.php')) {
            require_once './public/includes/' . $class_name . '.php';
        }

    }
       spl_autoload_register('loadView');

    ?>
<?php require('./components/Footer.php')?>
