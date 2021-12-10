<?php

class CheckoutController
{

    private $order;
    private $address;
    private $user;
    private $userData;
    private $productsToOrder;

    public function __construct()
    {
        $this->order = new OrderController();
        $this->address = new AddressController();
        $this->user  =new User();
        $this->productsToOrder = new OrderHasProducts();

    }

    public function processCheckout() {
        if(isset($_POST['pay'])) {
            $this->createAnonymUser();
        }
    }


//    create anonimus user

   private function setUserData() {
    $_POST = filter_input_array(INPUT_POST,
                    FILTER_SANITIZE_STRING);

    $this->userData = [
        'first_name' => $_POST['first_name'],
        'last_name' => $_POST['last_name'],
        'email' => $_POST['email'],
        'phone_number' => $_POST['phone_number'],
        'role' => 1
    ];

    }

    public function createAnonymUser() {
        if(!isset($_SESSION['email'])) {
            $this->setUserData();
            $this->user->registerAnonimusUser($this->userData);
            $this->setAddress();
            $this->createOrder();
            $this->addProductToOrder();
    }



}

//    check, create or update address

    private function setInvoiceAddressInfo() {
        $_POST = filter_input_array(INPUT_POST,
            FILTER_SANITIZE_STRING);

        $invoiceAddressData = [
            'street_name' => trim($_POST['invoice_street_name']) ?? "",
            'address_content' => trim($_POST['invoice_address_content']) ?? "",
            'address_type' => 1,
            'userID' => trim($_SESSION['userID']) ?? "",
            'postalCodeID' => trim($_POST['invoice_postalCodeID']) ?? "",
            'phone_number' => ""
        ];
        return $invoiceAddressData;

    }

    private function setDeliveryAddressInfo() {
        $_POST = filter_input_array(INPUT_POST,
            FILTER_SANITIZE_STRING);

        $deliveyAddressData = [
            'street_name' => trim($_POST['delivery_street_name']) ?? "",
            'address_content' => trim($_POST['delivery_address_content']) ?? "",
            'address_type' => 2,
            'userID' => trim($_SESSION['userID']) ?? "",
            'postalCodeID' => trim($_POST['delivery_postalCodeID']) ?? "",
            'phone_number' => ""
        ];
        return $deliveyAddressData;

    }

    public function setAddress() {
        $this->address->getAddresses()->createAddress($this->setInvoiceAddressInfo());
        $this->address->getAddresses()->createAddress($this->setDeliveryAddressInfo());
    }



//    create order -- make sure to include total price from basket and set the order and payment status


    public function setOrderData() {

        $_POST = filter_input_array(INPUT_POST,
            FILTER_SANITIZE_STRING);

        $orderData = [
            'status' => 0,
            'payment_status' => 0,
            'total_price' => $_SESSION['total_price'] ?? 0,
            'userID' => $_SESSION['userID'],
            'shippingID' => trim($_POST['shippingID']) ?? ""
        ];
        return $orderData;
    }

    public function createOrder() {
        $this->order->getOrders()->createOrder($this->setOrderData());
    }


//    add products to order

//    public function productData() {
//        $_POST = filter_input_array(INPUT_POST,
//            FILTER_SANITIZE_STRING);
//        $data =  [
//            'orderID' => $_SESSION['active-orderID'],
//            'productID' => $product['productID'],
//            'quantity' => $product['quantity']
//        ];
//        return $data;
//    }

    public function addProductToOrder() {
        foreach ($_SESSION['products'] as $product) {
            $this->productsToOrder->addProductToOrder([
                'orderID' => $_SESSION['active-orderID'],
                'productID' => $product['productID'],
                'quantity' => $product['quantity']
            ]);

        }
    }

//    send confirmation email to user



}