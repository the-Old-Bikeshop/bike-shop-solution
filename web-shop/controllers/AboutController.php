<?php

spl_autoload_register(function ($class)
{require_once"../admin/classes/".$class.".php";});

class AboutController extends ViewController {



    public $user;

    public function __construct()
    {
        $this->user = new User();
    }

    public function printhello()
    {
        echo "hello from the about controller" . "<br>";
    }


}

?>