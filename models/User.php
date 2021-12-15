<?php
//spl_autoload_register(function($class_name) {
//
//    // Define an array of directories in the order of their priority to iterate through.
//    $dirs = array(
//        'models/',
//        'controllers/',
//    );
//
//    // Looping through each directory to load all the class files. It will only require a file once.
//    // If it finds the same class in a directory later on, IT WILL IGNORE IT! Because of that require once!
//    foreach( $dirs as $dir ) {
//        if (file_exists($dir . $class_name . '.php')) {
//            require_once( $dir . $class_name . '.php');
//            return;
//        }
//    }
//});

class User extends BasisSQL {


    //Register User
    public function registerUser($data, $password) {
        $this->db->dbCon->beginTransaction();
        try {
            $query = $this->db->dbCon->prepare("INSERT INTO user (nick_name, first_name, last_name, email, `password_hash`, `role`)
        VALUES (:nick_name, :first_name, :last_name, :email, :password_hash, :role)");
            //Bind values
            $query->bindValue(':nick_name', $data['nick_name']);
            $query->bindValue(':first_name', $data['first_name']);
            $query->bindValue(':last_name', $data['last_name']);
            $query->bindValue(':email', $data['email']);
            $query->bindValue(':password_hash', $password);
            $query->bindValue(':role', $data['role']);

            $query->execute();

            $userID = $this->db->dbCon->lastInsertId();

            $_SESSION['name'] = $data['first_name'] . " " . $data['last_name'] ;
            $_SESSION['user-role'] = $data['role'];
            $_SESSION['email'] = $data['email'];
            $_SESSION['userID'] = $userID;

            $URL="https://raul-octavian.eu/bike-shop-solution/home";
            echo "<script type='text/javascript'>document.location.href='{$URL}';</script>";
            echo '<META HTTP-EQUIV="refresh" content="0;URL=' . $URL . '">';
            $this->db->dbCon->commit();

        }catch (Exception $e) {
            $this->db->dbCon->rollBack();

            $this->message = $e;
        }


    }

    public function registerAnonimusUser($data) {

        $this->db->dbCon->beginTransaction();
        try{
            $query = $this->db->dbCon->prepare("INSERT INTO user ( first_name, last_name, email, phone_number, `role`)
        VALUES ( :first_name, :last_name, :email, :phone_number, :role)");
            //Bind values
            $query->bindValue(':first_name', $data['first_name']);
            $query->bindValue(':last_name', $data['last_name']);
            $query->bindValue(':email', $data['email']);
            $query->bindValue(':phone_number', $data['phone_number']);
            $query->bindValue(':role', $data['role']);

            $_SESSION['userID']= $this->db->dbCon->lastInsertId();
            $_SESSION['email'] = $data['email'];
            $_SESSION['first_name'] = $data['first_name'];
            $_SESSION['last_name'] = $data['last_name'];
            $_SESSION['phone_number'] = $data['phone_number'];

            $query->execute();
            $this->db->dbCon->commit();

        } catch (Exception $e) {
            $this->db->dbCon->rollBack();
            $this->message = $e;
        }



    }

       //Find user by email or username
       public function findUserByEmail($email){

        $query = $this->db->dbCon->prepare("SELECT * FROM `user` WHERE `email` = :email");

        $query->bindValue(':email', $email);

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

    public function updateUserRole($data, $id) {
        $this->db->dbCon->beginTransaction();
        try {
            $query = $this->db->dbCon->prepare("UPDATE `user` SET 
                                                                    nick_name = :nick_name, 
                                                                    first_name = :first_name,
                                                                    last_name = :last_name,
                                                                    email = :email,
                                                                    phone_number = :phone_number,
                                                                    role = :role
                                                                    WHERE userID = :userID");

            $query->bindValue(':nick_name', $data['nick_name']);
            $query->bindValue(':first_name', $data['first_name']);
            $query->bindValue(':last_name', $data['last_name']);
            $query->bindValue(':email', $data['email']);
            $query->bindValue(':phone_number', $data['phone_number']);
            $query->bindValue(':role', $data['role']);
            $query->bindValue(':userID', $id);
            $query->execute();

            $this->db->dbCon->commit();

        }catch (Exception $e) {
            $this->db->dbCon->rollBack();
            $this->message = $e->getMessage();
        }


    }

    public function updateUser($data, $id) {
        $this->db->dbCon->beginTransaction();

        try {
            $query = $this->db->dbCon->prepare("UPDATE `user` SET 
                                                                    nick_name = :nick_name, 
                                                                    first_name = :first_name,
                                                                    last_name = :last_name,
                                                                    email = :email,
                                                                    phone_number = :phone_number
                                                                    WHERE userID = :userID");

            $query->bindValue(':nick_name', $data['nick_name']);
            $query->bindValue(':first_name', $data['first_name']);
            $query->bindValue(':last_name', $data['last_name']);
            $query->bindValue(':email', $data['email']);
            $query->bindValue(':phone_number', $data['phone_number']);
            $query->bindValue(':userID', $id);
            $query->execute();

            $this->db->dbCon->commit();

        }catch (Exception $e) {
            $this->db->dbCon->rollBack();
            $this->message = $e->getMessage();
            echo $this->message;
        }


    }
}