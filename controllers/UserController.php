<?php


class UserController extends ViewController {

     protected $user;
     protected $data;
     private $roleConvert;
     private $userInfo;
     private $update;

     public function __construct()
     {
         $this->user = new User();
         $this->roleConvert = new Convert();
     }

    public function register() {
         //Process form

        // Sanitize POST data
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        //Init data
        $this->setData();

        $password = $this->hashPassword(trim($_POST['password']), 15);

        //Validate inputs
        if(empty($this->data['nick_name']) || empty($this->data['first_name']) || empty($this->data['last_name']) ||
        empty($this->data['email'])) {
            echo "This is empty as programmer after coding in php";
        }

        elseif(!filter_var($this->data['email'], FILTER_VALIDATE_EMAIL)) {
            echo "Shit happened :D, your email is wrong boy :)!";
        }

        elseif(strlen($_POST['password']) < 6) {
            echo "Password too short!";
        } else if($_POST['password'] !== $_POST['password_repeated']) {
            echo "Password doesnt match!";
        }

        //Register User
        $this->user->registerUser($this->data, $password);
    }

    public function hashPassword( $password,  $iteration = 15 ) {
        $iterations = ['cost' => $iteration];
        $hashed_password = password_hash($password, PASSWORD_BCRYPT, $iterations);
        return $hashed_password;
    }

    private function setData() {
        $data = [
            'nick_name' => trim($_POST['nick_name']),
            'first_name' => trim($_POST['first_name']),
            'last_name' => trim($_POST['last_name']),
            'email' => trim($_POST['email']),
            'password_repeated' => trim($_POST['password_repeated']),
            'role' => 1
        ];
        $this->data = $data;

    }

    private function setUpdateData() {
        $data = [
            'nick_name' => trim($_POST['nick_name']),
            'first_name' => trim($_POST['first_name']),
            'last_name' => trim($_POST['last_name']),
            'email' => trim($_POST['email']),
            'role' => trim($_POST['role'])
        ];
        $this->data = $data;

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
            $loggedInUser = $this->user->LogInUser($data['email'], $data['password']);
            $_SESSION['name'] = $loggedInUser->first_name . " " . $loggedInUser->last_name ;
            $_SESSION['user-role'] = $loggedInUser->role;
            $_SESSION['email'] = $loggedInUser->email;
            $_SESSION['userID'] = $loggedInUser->userID;

            if($loggedInUser->role == 2){

                new RedirectHandler("admin");
                // session handler goes here and activates the session
            }elseif ($loggedInUser->role == 1){
                // session handler goes here and activates the session
                new RedirectHandler("landing");

            }
        }
    }

//    This runs in the admin page

    public function setUser()
    {

        if (isset($_POST['submit-new-admin'])) {
            $this->register();
        } elseif (isset($_POST['update'])) {
            $this->update = true;
            $this->userInfo = $this->user->fetchOne('user', 'userID', $_POST['userID']);
        } elseif (isset($_POST['submit-update'])) {
            $this->setUpdateData();
            $this->user->updateUserRole($this->data,
                $_POST['userID']);
        } elseif (isset($_POST['delete'])) {
            $this->user->deleteRow('user', 'userID', $_POST['userID']);
        }
    }

    public function getAllUsers() {
       return  $this->user->fetchAll('user');
    }
    public function getMessage() {
         return $this->user->message;
    }

    /**
     * @return User
     */
    public function getUser(): User
    {
        return $this->user;
    }

    public function getAllRoles() {
        return $this->roleConvert->getUserRoles();
    }

    /**
     * @return Convert
     */
    public function getRoleConvert(): Convert
    {
        return $this->roleConvert;
    }

    /**
     * @return mixed
     */
    public function getUpdate()
    {
        return $this->update;
    }

    /**
     * @return mixed
     */
    public function getUserInfo()
    {
        return $this->userInfo;
    }




}





