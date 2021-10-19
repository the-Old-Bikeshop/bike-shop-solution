<?php
<<<<<<< HEAD
//
//spl_autoload_register(function ($class)
//{require_once"classes/".$class.".php";});



class User
{
    protected $nick_name= "";
    protected $last_name= "";
    protected $first_name= "";
    protected $phone_number= "";
    protected $email= "";
    protected $role = 1;
    public $db;
    public $message = '';

    public function __construct($nick_name = "", $last_name = "", $first_name = "", $phone_number = "", $role = 1, $email = "" ) {

        $this->db = new DBCon();
        $this->nick_name = $nick_name;
        $this->last_name = $last_name;
        $this->first_name = $first_name;
        $this->phone_number =$phone_number;
        $this->email = $email;
        $this->role = $role;

    }

    public function hashPassword( $password,  $iteration = 15 ) {
        $iterations = ['cost' => $iteration];
        $hashed_password = password_hash($password, PASSWORD_BCRYPT, $iterations);
        return $hashed_password;
    }

    public function fetchAllUsers() {

        $query = $this->db->dbCon->prepare("SELECT * FROM `user`");
        if($query->execute()) {
            $result = $query->fetchall();
            return $result;
        }
        return "The database did not hold any data";

    }

    public function createUser($pass, $itr = 15) {


        $password =  $this->hashPassword($pass, $itr);

        $query = $this->db->dbCon->prepare("INSERT INTO `user` (nick_name, password_hash, last_name, first_name, phone_number, email, role) 
                                    VALUES (:nick_name, :password_hash, :last_name, :first_name, :phone_number, :email, :role)");

        $query->bindValue(':nick_name', $this->nick_name);
        $query->bindValue(':last_name', $this->last_name);
        $query->bindValue(':first_name', $this->first_name);
        $query->bindValue(':phone_number', $this->phone_number);
        $query->bindValue(':email', $this->email);
        $query->bindValue(':role', $this->role);
        $query->bindValue(':password_hash', $password);

        if ($query->execute()) {
            $this->message = "User Created.";
            Header("Location: user.php");
        } else {
            $this->message = "User could not be created.";
        }

    }

    public function deleteUser($id) {
        $query = $this->db->dbCon->prepare("DELETE FROM `user` WHERE userID=$id" );
        if($query->execute()) {
            $this->message = "User deleted";
            Header("Location: user.php");
        } else {
            $this->message = "User could not be deleted";
        }
    }

    public function fetchUser($id) {

        $query =$this->db->dbCon->prepare(
            "SELECT nick_name, password_hash, last_name, first_name, phone_number, email, role 
                    FROM `user`
                    WHERE userID = '$id'
                    ");
        $result_user = null;
        if($query->execute()) {
            $result_user = $query->fetch(PDO::FETCH_ASSOC);
        }else {
            $this->message = "the user could not be found";
            exit;
        }
        $this->nick_name = $result_user['nick_name'];
        $this->last_name = $result_user['last_name'];
        $this->first_name = $result_user['first_name'];
        $this->phone_number =$result_user['phone_number'];
        $this->email = $result_user['email'];
        $this->role = $result_user['role'];



        return $result_user;
    }

    public function updateValues($nick_name, $last_name, $first_name , $phone_number , $role , $email, $id )
    {

        $this->nick_name = $nick_name;
        $this->last_name = $last_name;
        $this->first_name = $first_name;
        $this->phone_number = $phone_number;
        $this->email = $email;
        $this->role = $role;
        $ID = $id;

        $query = $this->db->dbCon->prepare("
                                            UPDATE `user` 
                                            SET 
                                                nick_name = :nick_name, 
                                                last_name = :last_name , 
                                                first_name = :first_name, 
                                                phone_number = :phone_number, 
                                                email = :email, 
                                                role = :role
                                            WHERE userID = '$ID'
                                            ");

        $query->bindValue(':nick_name', $this->nick_name);
        $query->bindValue(':last_name', $this->last_name);
        $query->bindValue(':first_name', $this->first_name);
        $query->bindValue(':phone_number', $this->phone_number);
        $query->bindValue(':email', $this->email);
        $query->bindValue(':role', $this->role);

        if ($query->execute()) {
            $this->message = "User Updated.";
        } else {
            $this->message = "User could not be updated.";
        }

    }
}
=======
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
        $this->db = new Database();
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
}
>>>>>>> implementing-mvc-upgrade
