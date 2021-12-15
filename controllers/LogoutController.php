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
                $URL="https://raul-octavian.eu/bike-shop-solution/home";
                echo "<script type='text/javascript'>document.location.href='{$URL}';</script>";
                echo '<META HTTP-EQUIV="refresh" content="0;URL=' . $URL . '">';
            }else {
                $this->message = "Logout process failed, Try again";
                $URL=$_SERVER["HTTP_REFERER"];
                echo "<script type='text/javascript'>document.location.href='{$URL}';</script>";
                echo '<META HTTP-EQUIV="refresh" content="0;URL=' . $URL . '">';
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