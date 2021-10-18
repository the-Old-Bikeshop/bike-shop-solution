<?php
require_once './Database.php';

class User {

    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    //Register User
    public function registerUser($data) {
        $query = $this->db->prepare("INSERT INTO user (nick_name, first_name, last_name, email, `password`, `role`)
        VALUES (:nick_name, :first_name, :last_name, :email, :password_hash, :`role`)");
        //Bind values
        $query->bindValue(':nick_name', $this->nick_name);
        $query->bindValue(':first_name', $this->first_name);
        $query->bindValue(':last_name', $this->last_name);
        $query->bindValue(':email', $this->email);
        $query->bindValue(':phone_number', $this->phone_number);
        $query->bindValue(':password_hash', $this->password_hash);
        $query->bindValue(':role', $this->role);

        //Execute
        if($query->execute()) {
            $this->message = "User created";
        } else {
            $this->message = "ERROR, and shit happens";
        }

    }
}