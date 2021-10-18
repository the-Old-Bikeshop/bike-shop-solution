<?php

class Login
{
    public $message;
    public function __construct($email, $password)
    {
        $db = new DbCon();
        $email = trim($email);
        $pass = trim($password);
        $query = $db->dbCon->prepare("SELECT userID, email, password_hash FROM `user` WHERE email = '{$email}' LIMIT 1");
        if($query->execute()){
            $found_user = $query->fetchAll();
            if (count($found_user)==1){
                if(password_verify($pass, $found_user[0]['password_hash'])){
                    $_SESSION['userID'] = $found_user[0]['userID'];
                    $_SESSION['email'] = $found_user[0]['email'];
                    $_SESSION['name'] = $found_user[0]['first_name'];

                    $redirect = new Redirect("admin.php");
                } else {
                    // username/password combo was not found in the database
                    $this->message = "Email/password combination incorrect.<br />
					Please make sure your caps lock key is off and try again.";
                }
            }else{
                $this->message = "No such email in the database.<br />
				Please make sure your caps lock key is off and try again.";
            }
        }
    }

}