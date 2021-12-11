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
        $this->user  =new User();
        $this->productsToOrder = new OrderHasProducts();

//        test data

        $_SESSION['active_orderID'] = 1244233;

        $_SESSION['basket'] = [
            [
                'name' => 'one',
                'quantity' => 2,
                'price' => 200
            ],

            [
                'name' => 'two',
                'quantity' => 1,
                'price' => 1200
            ]
        ];

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
        $this->email();
        if(!isset($_SESSION['email'])) {
            $this->setUserData();
            $this->user->registerAnonimusUser($this->userData);
            $this->setAddress();
            $this->createOrder();
            $this->addProductToOrder();
            $this->email();

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
                'orderID' => $_SESSION['active-orderID'] ?? 1,
                'productID' => $product['productID'],
                'quantity' => $product['quantity']
            ]);

        }
    }

//    send confirmation email to user



    private function email() {
        $name = $_SESSION['last_name'] . " " . $_SESSION['first_name'];
        $order = $_SESSION['active_orderID'] ?? "test";
        $productList = '';
        if(isset($_SESSION['basket'])) {
            foreach ($_SESSION['basket'] as $product){
                    $productList = ' 
                    <tr>
                        <td>'
                             . $product['name'] ?? 'name'
                       . '</td>
                        <td>' .
                            intval($product['quantity'] ) ?? 1
                       . '</td>
                        <td>' .
                              intval($product['price']) * intval($product['quantity']) ?? '1000'
                       . '</td>
                    </tr>';
            }
        }


        $this->content = "
        <!DOCTYPE HTML PUBLIC '-//W3C//DTD XHTML 1.0 Transitional //EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
        <html xmlns='http://www.w3.org/1999/xhtml' xmlns:v='urn:schemas-microsoft-com:vml' xmlns:o='urn:schemas-microsoft-com:office:office'>
            <head>
            <!--[if gte mso 9]>
            <xml>
              <o:OfficeDocumentSettings>
                <o:AllowPNG/>
                <o:PixelsPerInch>96</o:PixelsPerInch>
              </o:OfficeDocumentSettings>
            </xml>
            <![endif]-->
              <meta http-equiv='Content-Type' content='text/html; charset=UTF-8'>
              <meta name='viewport' content='width=device-width, initial-scale=1.0'>
              <meta name='x-apple-disable-message-reformatting'>
              <!--[if !mso]><!--><meta http-equiv='X-UA-Compatible' content='IE=edge'><!--<![endif]-->
              <title></title>
                <style type='text/css'>
                    body {
                        background: #191414;
                        color: #F5F5F5;
                        min-height: 100vh;
                        padding: 4rem 2rem;
                    }
                    h1, h2 {
                        color: #FFFFFF;
                        text-transform: uppercase;
                        text-align: center;
                    }
                    h1  {
                        color: #33CC99;
        
                    }
                    table {
                        margin: 0 auto;
                    }
                    td, th {
                        padding: 3rem 5rem;
                        border: 1px solid #33CC99;
                        text-align: center;
                    }
        
        
                </style>
            </head>
            <body>
                <table>
                    <tbody>
                        <tr>
                            <td>
        
                                <h1>Hello $name  Thank you for your order</h1>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <h2>payment for order nr $order
                                    was confirmed it will be dispatched as soon as possible</h2>
                            </td>
                        </tr>
        
                    </tbody>
        
                </table>
        
                <table>
                    <tbody>
                    <tr>
                        <td>
                            <h2>
                                Order Details
                            </h2>
                        </td>
                    </tr>
                    </tbody>
        
                </table>
        
                <table>
                    <tbody>
                    <tr>
                        <th>
                           Item
                        </th>
                        <th>
                            Quantity
                        </th>
                        <th>
                            Price
                        </th>
                    </tr>
                   $productList
                    </tbody>
        
        
                </table>
        
            </body>

        </html>
        ";

        $this->title = "Confirming order nr: " .$_SESSION['active-orderID'];
        mail('alburaul@gmail.com', $this->title, $this->content, "From: no-reply@owl.com" );
//        $this->message[] = "Thank you for your message";
    }



}