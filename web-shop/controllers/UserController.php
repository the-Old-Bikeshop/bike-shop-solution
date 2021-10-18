<?php

// require_once '../models/User.php';

class UserController extends ViewController {

    private $userModel;

    public function __construct()
    {
        $this->userModel = new User;
    }

    public function register() {
        // Process form

        // Sanitize POST data
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        //Init data
        $data = [
            'first_name' => trim($_POST['first_name']),
            'last_name' => trim($_POST['last_name']),
            'email' => trim($_POST['email']),
            'password' => trim($_POST['password']),
            'password_repeated' => trim($_POST['password_repeated'])
        ];

        //Validate inputs
        if(empty($data['usersName']) || empty($data['usersEmail']) || empty($data['usersUid']) || 
        empty($data['usersPwd']) || empty($data['pwdRepeat'])){
           
        }
    }
    
}

// $init = new UserController;

// This keeps track if user sends the request
// if($_SERVER['REQUEST_METHOD'] == 'POST') {
//     switch($_POST['type']) {
//         case 'register';
//             $init->register();
//             break;
//     }
// }

