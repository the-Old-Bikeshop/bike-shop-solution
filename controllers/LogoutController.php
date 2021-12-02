<?php

class LogoutController extends
    ViewController
{
    private $logout;
    private $message;

    public function logoutCheck(){
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
     * @return Logout
     */
    public function getLogout(): Logout
    {
        return $this->logout;
    }

    /**
     * @return mixed
     */
    public function getMessage()
    {
        return $this->message;
    }


}