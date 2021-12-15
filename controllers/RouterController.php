<?php
    class RouterController {


        public static $validRoutes = array();

        public static function set($route, $function) {

            self::$validRoutes[] = $route;


            if (!isset($_GET['url'])) {
//                new RedirectHandler('home');
            } elseif (isset($_GET['url'])  && $_GET['url'] == $route){
                $function->__invoke();
            }

        }

    }
?>