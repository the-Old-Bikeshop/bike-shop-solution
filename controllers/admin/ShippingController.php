<?php



class ShippingController extends
    ViewController
{

    public $update;
    private $shippings;
    private $shipping;
    private $data;
    public $message;

    public function __construct()
    {
        $this->update = false;
        $this->shippings = new Shipping();
    }

    public function setShippings(): void
    {

        if (isset($_POST['submit-new'])) {
            $this->setData();
            $this->shippings = new Shipping();
            $this->shippings->createShipping($this->data);
        } elseif (isset($_POST['update'])) {
            $this->shippings = new Shipping();

            $this->update = true;
            $this->shipping = $this->shippings->fetchOne('shipping', 'shippingID', $_POST['shippingID']);
        } elseif (isset($_POST['submit-update'])) {
            $this->shippings = new Shipping();
            $this->setData();
            $this->shippings->updateShipping($this->data,
                $_POST['shippingID']);
        } elseif (isset($_POST['delete'])) {
            $this->shippings = new Shipping();
            $this->shippings->deleteRow('shipping', 'shippingID', $_POST['shippingID']);
        }
    }

    public function setData(): void {

        $_POST = filter_input_array(INPUT_POST,
            FILTER_SANITIZE_STRING);

        $data = [
            'name' => trim($_POST['name']) ?? "",
            'description' => trim($_POST['description']) ?? "",
        ];
        $this->data = $data;
    }

    /**
     * @return mixed
     */
    public function getShipping()
    {
        return $this->shipping;
    }

    /**
     * @return Shipping
     */
    public function getShippings(): Shipping
    {
        return $this->shippings;
    }

    /**
     * @return false
     */
    public function getUpdate(): bool
    {
        return $this->update;
    }

    public function getAllShippings() {
        return $this->shippings->fetchAll('shipping');
    }



}