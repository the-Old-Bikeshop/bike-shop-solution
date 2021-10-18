<?php
spl_autoload_register(function ($class)
{require_once"./".$class.".php";});

class DBcon extends Database
{
    public $dbCon;

    public function __construct() {
        $user = $this::DB_USER;
        $pass = $this::DB_PASSWORD;
        $server = $this::DB_SERVER;
        $database = $this::DB_DATABASE;


        try {
            $this->dbCon = new PDO("mysql:host=$server; dbname=$database; charset=utf8", $user, $pass);
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