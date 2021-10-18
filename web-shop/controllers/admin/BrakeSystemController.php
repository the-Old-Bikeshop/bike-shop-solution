<?php

spl_autoload_register(function($class_name) {

    // Define an array of directories in the order of their priority to iterate through.
    $dirs = array(
        'models/',
        'controllers/',
        'controllers/admin',
    );

    // Looping through each directory to load all the class files. It will only require a file once.
    // If it finds the same class in a directory later on, IT WILL IGNORE IT! Because of that require once!
    foreach( $dirs as $dir ) {
        if (file_exists($dir . $class_name .'.php')) {
            require_once($dir . $class_name.'.php');
            return;
        }
    }
});

$update = false;
$brake = new BrakeType();
if(isset($_POST['submit-new'])) {
    $brake = new BrakeType($_POST['name'], $_POST['condition']);
    $brake->createBrakeSystem();
}elseif(isset($_POST['update'])) {
    $brake = new BrakeType();
    $update= true;

    $val = $brake->fetchOneBrakeSystem($_POST['braking_systemID']);
}elseif(isset($_POST['submit-update'])){
    $brake = new BrakeType();
    $brake->updateBrakeSystem($_POST['name'], $_POST['condition'], $_POST['braking_systemID'] );
}elseif(isset($_POST['delete'])) {
    $brake = new BrakeType();
    $brake->deleteBrakeSystem($_POST['braking_systemID']);
}

$convert = new Convert();

echo "for the brake system controller";

class BrakeSystemController extends ViewController
{

}