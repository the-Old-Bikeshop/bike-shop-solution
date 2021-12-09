<?php


class AddressController extends
    ViewController
{

    public $update;
    private $addresses;
    private $address;
    private $data;
    public $message;
    public $addressTypeConverter;

    public function __construct()
    {
        $this->update = false;
        $this->addresses = new Address();
        $this->addressTypeConverter = new Convert();

    }

    public function setAddress(): void
    {

        if (isset($_POST['submit-new'])) {
            $this->setData();
            $this->addresses->createAddress($this->data);
        } elseif (isset($_POST['update'])) {
            $this->update = true;
            $this->address = $this->addresses->fetchOne('address', 'addressID', $_POST['addressID']);
        } elseif (isset($_POST['submit-update'])) {
            $this->setData();
            $this->addresses->updateAddress($this->data, $_POST['addressID']);
        } elseif (isset($_POST['delete'])) {
            $this->addresses->deleteRow('address', 'addressID', $_POST['addressID']);
        }
    }


    /**
     * @param mixed $data
     */
    public function setData(): void {

        $_POST = filter_input_array(INPUT_POST,
            FILTER_SANITIZE_STRING);

        $data = [
            'street_name' => trim($_POST['street_name']) ?? "",
            'address_content' => trim($_POST['address_content']) ?? "",
            'phone_number' => trim($_POST['phone_number']) ?? "",
            'address_type' => trim($_POST['address_type']) ?? "",
            'userID' => trim($_POST['userID']) ?? "",
            'postalCodeID' => trim($_POST['postalCodeID']) ?? "",
        ];
        $this->data = $data;
    }

    /**
     * @param mixed $message
     */
    public function setMessage(): void
    {
        $this->message = $this->addresses->message;
    }


    public function getAddresses()
    {
        return $this->addresses;
    }

    public function fetchAllAddresses() {
        return $this->addresses->fetchAll('address');
    }

    public function fetchAllZipCodes() {
        return $this->addresses->fetchAll('delivery_zip');
    }
    /**
     * @return mixed
     */
    public function getOneAddress()
    {
        return $this->address;
    }

    /**
     * @return false
     */
    public function getUpdate(): bool
    {
        return $this->update;
    }

    public function getMessage() {
        return $this->addresses->message;
    }

    public function getAddressTypes()
    {
        return $this->addressTypeConverter->getAddressTypes();
    }

    /**
     * @return Convert
     */
    public function getAddressTypeConverter(): Convert
    {
        return $this->addressTypeConverter;
    }

    public function getInvoiceAddress() {
        return $this->addresses->getCheckoutInvoiceAddress();
    }

    public function getDeliveryAddress() {
        return $this->addresses->getCheckoutDeliveryAddress();
    }

}