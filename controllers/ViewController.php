<?php



class ViewController {

//    logout

    private $logout;
    private $logMessage;
    protected function logoutCheck(){
        var_dump($_POST);
        if(isset($_POST['logout'])) {
            $this->logout = new Logout();
            if(!isset($_SESSION["user-role"])) {

                new RedirectHandler('home');
            }else {
                $this->message = "Logout process failed, Try again";
                new RedirectHandler($_SERVER["HTTP_REFERER"]);
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