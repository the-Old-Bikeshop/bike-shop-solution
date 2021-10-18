<?php
require_once './Database.php';

class User {

    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    //Register User
    public function registerUser($data) {
        $query = $this->db->Database->prepare("INSERT INTO user (nick_name, first_name, last_name, email, `password`, `role`)
        VALUES (:nick_name, :first_name, :last_name, :email, :password_hash, :`role`)");
        //Bind values
        $this->db->bind(':nick_name', $data['nick_name']);
        $this->db->bind(':first_name', $data['first_name']);
        $this->db->bind(':last_name', $data['last_name']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':password_hash', $data['password']);
        $this->db->bind(':role', 'USER');

        // $query->bindValue(':nick_name', $this->nick_name);
        // $query->bindValue(':first_name', $this->first_name);
        // $query->bindValue(':last_name', $this->last_name);
        // $query->bindValue(':email', $this->email);
        // $query->bindValue(':phone_number', $this->phone_number);
        // $query->bindValue(':password_hash', $this->password_hash);
        // $query->bindValue(':role', $this->role);

        //Execute
        if($query->execute()) {
            $this->message = "Product created";
        } else {
            $this->message = "ERROR, product could not be created";
        }

    }
}