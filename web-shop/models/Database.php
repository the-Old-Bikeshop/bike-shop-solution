<?php

class Database
{
    public $dbCon;

    public function __construct() {
        $server = "localhost";
        $user = "admin2";
        $passport = "Mirodenii1!";
        $database = "bikeshop";

        try {
            $this->dbCon = new PDO("mysql:host=$server; dbname=$database; charset=utf8", $user, $passport);
            $this->dbCon->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $this->dbCon;
        } catch (PDOException $err) {
            echo "Error: " . $err->getMessage(). "<br />";
            die();
        }
    }
    public function dbClose() {
        $this->dbCon = null;
    }

}