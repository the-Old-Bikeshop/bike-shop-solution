<?php



class  ViewController {

//    logout

    private $logout;
    private $logMessage;
    protected function logoutCheck(){
        if(isset($_POST['logout'])) {
            $this->logout = new Logout();
            if(!isset($_SESSION["user-role"])) {
                $URL="https://raul-octavian.eu/bike-shop-solution/home";
                echo "<script type='text/javascript'>document.location.href='{$URL}';</script>";
                echo '<META HTTP-EQUIV="refresh" content="0;URL=' . $URL . '">';;
            }else {
                $this->message = "Logout process failed, Try again";

                $URL=$_SERVER["HTTP_REFERER"];
                echo "<script type='text/javascript'>document.location.href='{$URL}';</script>";
                echo '<META HTTP-EQUIV="refresh" content="0;URL=' . $URL . '">';
            }
        }
    }

    /**
     * @return mixed
     */
    public function getLogMessage()
    {
        return $this->logMessage;
    }

//    create view


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