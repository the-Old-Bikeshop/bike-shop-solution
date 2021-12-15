<?php
    class RouterController {


        public static $validRoutes = array();

        public static function set($route, $function) {

            self::$validRoutes[] = $route;


            if (!isset($_GET['url'])) {
                   $URL="https://raul-octavian.eu/bike-shop-solution/home";
                   echo "<script type='text/javascript'>document.location.href='{$URL}';</script>";
                   echo '<META HTTP-EQUIV="refresh" content="0;URL=' . $URL . '">';
            } elseif (isset($_GET['url'])  && $_GET['url'] == $route){
                $function->__invoke();
            }

        }

    }
?>