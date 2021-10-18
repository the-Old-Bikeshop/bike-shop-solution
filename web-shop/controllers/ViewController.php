<?php



class ViewController {


    public static function CreateView($viewName) {

        if (file_exists('./views/'.$viewName.'.php')) {
            require_once './views/'.$viewName.'.php';
        } elseif (file_exists('./views/admin/'.$viewName.'.php')) {
            require_once './views/admin/'.$viewName.'.php';
        }
    }

}

?>