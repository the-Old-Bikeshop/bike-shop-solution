<?php

class Database {
    protected const DB_SERVER = 'localhost';
    protected const DB_USER = 'root';
    protected const DB_PASSWORD = 'root';
    protected const DB_DATABASE = 'bikeshop';
    public $dbCon;

    public function __construct() {
        $user = $this::DB_USER;
        $password = $this::DB_PASSWORD;
        $server = $this::DB_SERVER;
        $database = $this::DB_DATABASE;

        try {
            $this->dbCon = new PDO("mysql:host=$server; dbname=$database; charset=utf8", $user, $password);
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

?>