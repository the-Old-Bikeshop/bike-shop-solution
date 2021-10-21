<?php
spl_autoload_register(function($class_name) {

    // Define an array of directories in the order of their priority to iterate through.
    $dirs = array(
        'models/',
        'controllers/',
    );

    // Looping through each directory to load all the class files. It will only require a file once.
    // If it finds the same class in a directory later on, IT WILL IGNORE IT! Because of that require once!
    foreach( $dirs as $dir ) {
        if (file_exists($dir . $class_name . '.php')) {
            require_once( $dir . $class_name . '.php');
            return;
        }
    }
});

class User {

    private $db;

    public function __construct() {
        $this->db = new DBcon();
    }

    //Register User
    public function registerUser($data, $password) {

        $query = $this->db->dbCon->prepare("INSERT INTO user (nick_name, first_name, last_name, email, `password_hash`, `role`)
        VALUES (:nick_name, :first_name, :last_name, :email, :password_hash, :role)");
        //Bind values
        $query->bindValue(':nick_name', $data['nick_name']);
        $query->bindValue(':first_name', $data['first_name']);
        $query->bindValue(':last_name', $data['last_name']);
        $query->bindValue(':email', $data['email']);
        $query->bindValue(':password_hash', $password);
        $query->bindValue(':role', $data['role']);

        //Execute
        if($query->execute()) {
            $this->message = "User created";
            new RedirectHandler("about");
        } else {
            $this->message = "ERROR, and shit happens";
        }

    }

       //Find user by email or username
       public function findUserByEmail($email){

        $query = $this->db->dbCon->query("SELECT * FROM `user` WHERE `email` = '{$email}'");

        $query->execute();
        $row = $query->fetch(PDO::FETCH_OBJ);
        //Check row
        if($query->rowCount() > 0){
            return $row;
        }else{
            return false;
        }
    }

    // Login User
    public function LogInUser($email, $password) {
        $row = $this->findUserByEmail($email);

        if($row == false) return false;


        $hashedPassword = $row->password_hash;
        if(password_verify($password, $hashedPassword)){
            return $row;
        }else{
            return false;
        }
  
    }
}