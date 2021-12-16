<?php

class CheckoutController
{

    private $order;
    private $address;
    private $user;
    private $userData;
    private $productsToOrder;
    private $title;
    private $content;

    public function __construct()
    {
        $this->order = new OrderController();
        $this->address = new AddressController();
        $this->user = new User();
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
        }

            $this->setAddress();
            $this->createOrder();
            $this->addProductToOrder();
            $this->email();

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
            'phone_number' => $_POST['phone_number'] ?? ""
        ];
        return $invoiceAddressData;

    }

    private function setDeliveryAddressInfo() {
        $_POST = filter_input_array(INPUT_POST,
            FILTER_SANITIZE_STRING);

        $deliveyAddressData = [
            'street_name' => trim($_POST['delivery_street_name']) ?? trim($_POST['invoice_street_name']) ?? "",
            'address_content' => trim($_POST['delivery_address_content']) ?? trim($_POST['invoice_address_content']) ?? "",
            'address_type' => 2,
            'userID' => trim($_SESSION['userID']),
            'postalCodeID' => trim($_POST['delivery_postalCodeID']) ?? trim($_POST['invoice_postalCodeID']) ?? "",
            'phone_number' => $_POST['phone_number'] ?? ""
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
            'total_price' => $this->setTotalPrice(),
            'userID' => $_SESSION['userID'],
            'shippingID' => trim($_POST['shippingID']) ?? ""
        ];
        return $orderData;
    }

    private function setTotalPrice() {
        $totalPrice = 0;
        foreach ($_SESSION['basket'] as $item) {
            if(isset($item['discount']) && $item['discount'] > 0){
                $totalPrice += (($item['price'] - ($item['price']*($item['discount']/100))) * $item['quantity']);

            } else {
                $totalPrice += ($item['price'] * $item['quantity']);
            }


        }
        return $totalPrice;
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
        foreach ($_SESSION['basket'] as $product) {
            $this->productsToOrder->addProductToOrder([
                'orderID' => $_SESSION['active_orderID'],
                'productID' => $product['productID'],
                'quantity' => $product['quantity']
            ]);

        }
    }

//    send confirmation email to user



    private function email() {

//        var_dump($_POST);
        $name = $_SESSION['last_name'] . " " . $_SESSION['first_name'];
        $order = $_SESSION['active_orderID'];
        $invoiceAddress = $_SESSION['active_invoice_address'];
        $deliveryAddress = $_SESSION['active_delivery_address'];
        $productList = '';
        $to = $_POST['email'];

        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        $headers .= "From: no-reply@raul-octavian.eu" . "\r\n";
        if(isset($_SESSION['basket'])) {
            foreach ($_SESSION['basket'] as $product){
                $name = $product['name'] ?? 'name';
                $quantity = intval($product['quantity'] ) ?? 1;
                $price = intval($product['price']) * intval($product['quantity']);
                    $productList .= "<tr><td> "."\r\n";
                    $productList .= "$name"."\r\n";
                    $productList .= "</td><td> "."\r\n";
                    $productList .= "$quantity"."\r\n";
                    $productList .= "</td><td> "."\r\n";
                    $productList .= "$price "."\r\n";
                    $productList .= "</td></tr> "."\r\n";

            }
        }

        $this->content = "<!DOCTYPE HTML PUBLIC '-//W3C//DTD XHTML 1.0 Transitional //EN'"."\r\n";
        $this->content .= "'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>"."\r\n";
        $this->content .= "<html xmlns='http://www.w3.org/1999/xhtml'"."\r\n";
        $this->content .= " xmlns:v='urn:schemas-microsoft-com:vml'"."\r\n";
        $this->content .= " xmlns:o='urn:schemas-microsoft-com:office:office'>"."\r\n";
        $this->content .= "<head>"."\r\n";
        $this->content .= "<!--[if gte mso 9]>"."\r\n";
        $this->content .= "<xml>"."\r\n";
        $this->content .= "<o:OfficeDocumentSettings>"."\r\n";
        $this->content .= "<o:AllowPNG/>"."\r\n";
        $this->content .= "<o:PixelsPerInch>96</o:PixelsPerInch>"."\r\n";
        $this->content .= "</o:OfficeDocumentSettings>"."\r\n";
        $this->content .= "</xml>"."\r\n";
        $this->content .= "<![endif]-->"."\r\n";
        $this->content .= "<meta http-equiv='Content-Type' content='text/html;"."\r\n";
        $this->content .=  "charset=UTF-8'>"."\r\n";
        $this->content .= "<meta name='viewport' content='width=device-width, initial-scale=1.0'>"."\r\n";
        $this->content .= "<meta name='x-apple-disable-message-reformatting'>"."\r\n";
        $this->content .= " <!--[if !mso]><!--><meta http-equiv='X-UA-Compatible'"."\r\n";
        $this->content .= "content='IE=edge'><!--<![endif]-->"."\r\n";
        $this->content .= "<title></title>"."\r\n";
        $this->content .= "<style type='text/css'>"."\r\n";
        $this->content .= "body {"."\r\n";
        $this->content .= "background: #191414;"."\r\n";
        $this->content .= "color: #F5F5F5;"."\r\n";
        $this->content .= "min-height: 100vh;"."\r\n";
        $this->content .= "padding: 4rem 2rem; }"."\r\n";
        $this->content .= " h1, h2 {"."\r\n";
        $this->content .= "color: #FFFFFF;"."\r\n";
        $this->content .= "text-transform: uppercase;"."\r\n";
        $this->content .= "text-align: center; }"."\r\n";
        $this->content .= "h1  {"."\r\n";
        $this->content .= "color: #33CC99; }"."\r\n";
        $this->content .= "table {"."\r\n";
        $this->content .= " margin: 0 auto;}"."\r\n";
        $this->content .= "td, th {"."\r\n";
        $this->content .= "padding: 3rem 5rem;"."\r\n";
        $this->content .= "border: 1px solid #33CC99;"."\r\n";
        $this->content .= "text-align: center; } </style> </head>"."\r\n";
        $this->content .= "<body><table><tbody><tr><td> "."\r\n";
        $this->content .= "<h1>Hello $name  Thank you for your order</h1> "."\r\n";
        $this->content .= "</td></tr><tr><td> "."\r\n";
        $this->content .= "<h2>payment for order nr $order was confirmed, "."\r\n";
        $this->content .= "it will be dispatched as soon as possible at</h2> "."\r\n";
        $this->content .= "<h3>Delivery address:</h3> "."\r\n";
        $this->content .= "<h3>$deliveryAddress</h3> "."\r\n";
        $this->content .= "<h3>Invoicing Address:</h3> "."\r\n";
        $this->content .= "<h3>$invoiceAddress</h3> "."\r\n";
        $this->content .= "</td></tr></tbody></table><table><tbody> "."\r\n";
        $this->content .= "<tr><td><h2>Order Details</h2></td></tr></tbody></table> "."\r\n";
        $this->content .= "<table><tbody><tr><th>Item</th><th>Quantity</th><th>Price</th></tr> "."\r\n";
        $this->content .= $productList;
        $this->content .= "</tbody></table></body></html>"."\r\n";
        $this->content .= " "."\r\n";



        $this->title = "Confirming order nr: " .$_SESSION['active_orderID'];
       if(mail($to, $this->title, $this->content, $headers )) {
           $_SESSION['basket'] = [];
           $_SESSION['message_sent'] = true;
       };
    }



}