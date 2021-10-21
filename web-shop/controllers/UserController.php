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

class UserController extends ViewController {

     protected $user;
     protected $data;

     public function __construct()
     {
         $this->user = new User();
     }

    public function register() {
         //Process form

        // Sanitize POST data
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        //Init data
        $data = [
            'nick_name' => trim($_POST['nick_name']),
            'first_name' => trim($_POST['first_name']),
            'last_name' => trim($_POST['last_name']),
            'email' => trim($_POST['email']),
            'password_repeated' => trim($_POST['password_repeated']),
            'role' => trim($_POST['role'])
        ];

        $password = $this->hashPassword(trim($_POST['password']), 15);

        //Validate inputs
        if(empty($data['nick_name']) || empty($data['first_name']) || empty($data['last_name']) || 
        empty($data['email'])) {
            echo "This is empty as programmer after coding in php";
        }

        elseif(!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            echo "Shit happened :D, your email is wrong boy :)!";
        }

        elseif(strlen($_POST['password']) < 6) {
            echo "Password too short!";
        } else if($_POST['password'] !== $_POST['password_repeated']) {
            echo "Password doesnt match!";
        }

        $this->data = $data;

        //Register User
        $this->user->registerUser($this->data, $password);
    }

    public function hashPassword( $password,  $iteration = 15 ) {
        $iterations = ['cost' => $iteration];
        $hashed_password = password_hash($password, PASSWORD_BCRYPT, $iterations);
        return $hashed_password;
    }

    public function login(){
        //Sanitize POST data
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        //Init data
        $data=[
            'email' => trim($_POST['email']),
            'password' => trim($_POST['password'])
        ];

        if(empty($data['email']) || empty($data['password'])){
            // redirect user to login and show message "fill the inputs"
            exit();
        }

        //Check for email
        if($this->user->findUserByEmail($data['email'])){
            //User Found
            $loggedInUser = $this->user->loginUser($data['email'], $data['password']);
            if($loggedInUser){
                //Create session
                // session handler goes here and activates the session
            }else{
                // redirect user to login and show message "password incorrect"
            }
        }else{
              // redirect user to login and show message "no user found"
        }
    }
}





