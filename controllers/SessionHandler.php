<?php

class SessionHandle
{
    private $token;

    public function logged_in() {
        return isset($_SESSION['userID']);
    }

    public function confirm_logged_in() {
        if (!$this->logged_in()) {
            $redirect = new RedirectHandler("landing");
        }
    }

    public function setToken() {
        if (empty($_SESSION['token'])) {
            $_SESSION['token'] = bin2hex(random_bytes(32));
        }
        $this->token = $_SESSION['token'];

    }
    public function startSession() {
        session_start();
    }

    /**
     * @return mixed
     */
    public function getToken()
    {
        return $this->token;
    }

}