<?php


class OrderController extends
    ViewController
{

    private $update;
    private $data;
    private $orders;
    private $order;
    private $convert;
    private $products;
    private $shipping;
    private $orderHasProduct;




    public function __construct()
    {
        $this->update = false;
        $this->convert = new Convert();
        $this->orders = new Order();
        $this->shipping = $this->orders->fetchAll('shipping');
        $this->orderHasProduct = new OrderHasProducts();

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
        } elseif (isset($_POST['addProduct'])) {
            $this->orders = new Order();
            $this->order = $this->orders->fetchOne('order', 'orderID', $_POST['orderID']);
            $this->products = $this->orders->fetchAll('product');
        } elseif(isset($_POST['addProductToOrder'])){
            $this->orderHasProduct->addProductToOrder($this->productData());

        }
    }

    public function productData() {
           $_POST = filter_input_array(INPUT_POST,
            FILTER_SANITIZE_STRING);
           $data =  [
               'orderID' => trim($_POST['orderID']),
               'productID' => trim($_POST['productID']),
               'quantity' => trim($_POST['quantity'])
           ];
           return $data;
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

    /**
     * @return mixed
     */
    public function getProducts()
    {
        return $this->products;
    }

    /**
     * @return array|Exception|false
     */
    public function getShipping()
    {
        return $this->shipping;
    }

    public function getAllOrders() {
        return $this->orders->fetchAll('order_view');
    }

    public function getOrdersForUser() {
        return $this->orders->fetchUserOrders();
    }

    public function fetchSimpleOrderForUser() {
        return $this->orders->fetchSimpleOrderForUser();
    }

    public function fetchOrderProductList($orderID) {
        return $this->orders->fetchOrderProductList($orderID);
    }



}