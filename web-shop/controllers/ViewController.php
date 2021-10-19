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

    }

}


?>