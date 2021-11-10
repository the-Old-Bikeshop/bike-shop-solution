<?php

spl_autoload_register(function ($class_name) {

    // Define an array of directories in the order of their priority to iterate through.
    $dirs = array(
        'models/',
        'controllers/',
        'controllers/admin/',
    );

    // Looping through each directory to load all the class files. It will only require a file once.
    // If it finds the same class in a directory later on, IT WILL IGNORE IT! Because of that require once!
    foreach ($dirs as $dir) {
        if (file_exists($dir . $class_name . '.php')) {
            require_once($dir . $class_name . '.php');
            return;
        }
    }
});

class OrderController extends
    ViewController
{

    private $update;
    private $data;
    private $orders;
    private $order;
    private $convert;


//CREATE TABLE `order` (
//orderID INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
//created_at  TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
//follow_up_date DATE,
//`status` INT NOT NULL ,
//payment_status INT NOT NULL,
//total_price DECIMAL(10,2),
//userID INT NOT NULL,
//shippingID INT NOT NULL,
//FOREIGN KEY (userID) REFERENCES `user` (userID),
//FOREIGN KEY (shippingID) REFERENCES shipping (shippingID)
//);

    public function __construct()
    {
        $this->update = false;
        $this->convert = new Convert();
        $this->orders = new Order();

    }

    public function setOrders(): void
    {

        if (isset($_POST['submit-new'])) {
            $this->setData();
            $this->orders = new Order();
            $this->convert = new Convert();
            $this->orders->createOrder($this->data);
        } elseif (isset($_POST['update'])) {
            $this->orders = new Order();

            $this->update = true;
            $this->order = $this->orders->fetchOne('order', 'orderID', $_POST['orderID']);
        } elseif (isset($_POST['submit-update'])) {
            $this->orders = new Order();
            $this->convert = new Convert();
            $this->setData();
            $this->orders->updateOrder($this->data,
                $_POST['orderID']);
        } elseif (isset($_POST['delete'])) {
            $this->orders = new Order();
            $this->orders->deleteRow('order', 'orderID', $_POST['orderID']);
        }
    }

    public function setData(): void {

        $_POST = filter_input_array(INPUT_POST,
            FILTER_SANITIZE_STRING);

        $data = [
            'status' => trim($_POST['status']) ?? "",
            'payment_status' => trim($_POST['payment_status']) ?? "",
            'total_price' => trim($_POST['total_price']) ?? "",
            'userID' => trim($_POST['userID']) ?? "",
            'shippingID' => trim($_POST['shippingID']) ?? "",
        ];
        $this->data = $data;
    }

    /**
     * @return false
     */
    public function getUpdate(): bool
    {
        return $this->update;
    }

    /**
     * @return mixed
     */
    public function getOrder()
    {
        return $this->order;
    }

    /**
     * @return mixed
     */
    public function getOrders()
    {
        return $this->orders;
    }

    /**
     * @return Convert
     */
    public function getConvert(): Convert
    {
        return $this->convert;
    }



}