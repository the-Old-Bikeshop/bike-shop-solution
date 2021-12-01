<?php

class ContactController extends ViewController {

    private $data;
    private $message = [];
    private $error = [];
    private $email;
    private $title;
    private $mess;



    public function SendEmail() {

        if($_SERVER['REQUEST_METHOD'] == "POST") {
            if(isset($_POST['token']) && !empty($_POST['token'])) {
                if(isset($_POST['send'])) {
                    if(filter_var($_POST['email'] , FILTER_VALIDATE_EMAIL)){
                        if(strlen(trim($_POST['message'])) > 20) {
                            if (hash_equals($_SESSION['token'], $_POST['token'])) {
                                $this->setData();
                                $this->email();
                                unset($_SESSION['token']);
                            }else {
                                die('Token do not match, refers the page and try again');
                            }
                        }else {
                            $this->error[] = "Message must be over 20 characters long";
                        }
                    }else {
                        $this->error[] = "Please enter a valid email address!";
                    }
                }
            }
        }
    }

    private function setData() {
        $_POST = filter_input_array(INPUT_POST,
            FILTER_SANITIZE_STRING);


        $data = [
            'email' => trim(filter_var($_POST['email'] , FILTER_VALIDATE_EMAIL)) ?? "",
            'title' => trim($_POST['title']) ?? "",
            'message' => trim($_POST['message']) ?? ""
        ];
        $this->email = $data['email'];
        $this->title = $data['title'];
        $this->mess = $data['message'];
        $this->data = $data;
        //        print_r($data);
    }

    private function email() {
            mail('alburaul@gmail.com', $this->title, $this->mess, "From: $this->email" );
            $this->message[] = "Thank you for your message";
    }


    /**
     * @return array
     */
    public function getMessage(): array
    {
        return $this->message;
    }

    /**
     * @return array
     */
    public function getError(): array
    {
        return $this->error;
    }




}
?>


