<?php

class ViewController {

    public static function CreateView($viewName) {
        require_once("./views/admin/$viewName.php");
        require_once("./views/$viewName.php");
    }
    
}

?>