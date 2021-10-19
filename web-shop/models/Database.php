<?php

<<<<<<< HEAD
class Database {
    protected const DB_SERVER = 'localhost';
    protected const DB_USER = 'admin2';
    protected const DB_PASSWORD = 'Mirodenii1!';
    protected const DB_DATABASE = 'bikeshop';
}

?>
=======
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
>>>>>>> implementing-mvc-upgrade
