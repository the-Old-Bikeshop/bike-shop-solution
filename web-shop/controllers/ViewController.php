<?php



class ViewController {


    public static function CreateView($viewName) {
        $dirs = array(
            'views/',
            'views/admin/',
        );

        foreach( $dirs as $dir ) {
            if (file_exists('./'. $dir . $viewName .'.php')) {
                require_once('./'. $dir . $viewName .'.php');
                return;
            }
        }

//        if (file_exists('./views/'.$viewName.'.php')) {
//            require_once './views/'.$viewName.'.php';
//        } elseif (file_exists('./views/admin/'.$viewName.'.php')) {
//            require_once './views/admin/'.$viewName.'.php';
//        }
    }

}

// CreateView($viewName) {
//
//    // Define an array of directories in the order of their priority to iterate through.
//    $dirs = array(
//        'models/',
//        'controllers/',
//        'controllers/admin',
//    );
//
//    // Looping through each directory to load all the class files. It will only require a file once.
//    // If it finds the same class in a directory later on, IT WILL IGNORE IT! Because of that require once!
//    foreach( $dirs as $dir ) {
//        if (file_exists($dir . $class_name .'.php')) {
//            require_once($dir . $class_name.'.php');
//            return;
//        }
//    }
//});

?>