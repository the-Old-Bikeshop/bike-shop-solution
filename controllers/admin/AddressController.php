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
        } elseif (isset($_POST['submit-user-update'])) {
            if(isset($_POST['invoice_addressID']) && ($_POST['invoice_addressID']) !== "") {
                $this->addresses->createAddress($this->setInvoiceAddressUpdateData());
            }
            if(isset($_POST['delivery_addressID']) && ($_POST['delivery_addressID']) !== ""){
                $this->addresses->createAddress($this->setDeliveryAddressUpdateData());
            }
        }

        elseif (isset($_POST['delete'])) {
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

    private function setInvoiceAddressUpdateData() {
        $invoice = [
            'street_name' => trim($_POST['invoice_street_name']) ?? "",
            'address_content' => trim($_POST['invoice_address_content']) ?? "",
            'phone_number' => trim($_POST['invoice_phone_number']) ?? "",
            'address_type' => 1,
            'userID' => $_SESSION['userID'],
            'postalCodeID' => trim($_POST['invoice_postalCodeID']) ?? ""
            ];
        return $invoice;

    }

    private function setDeliveryAddressUpdateData() {
        $delivery = [
            'street_name' => trim($_POST['delivery_street_name']) ?? "",
            'address_content' => trim($_POST['delivery_address_content']) ?? "",
            'phone_number' => trim($_POST['delivery_phone_number']) ?? "",
            'address_type' => 2,
            'userID' => $_SESSION['userID'],
            'postalCodeID' => trim($_POST['delivery_postalCodeID']) ?? ""
        ];
        return $delivery;

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

//    public function getAddressForCheckout() {
//       return $this->addresses->fetchOne('address', 'addressID', $_POST['addressID']);
//    }

    public function getInvoiceAddress() {
        if(isset($_SESSION['userID'])) {
            return $this->addresses->getCheckoutInvoiceAddress();
        }

    }

    public function getDeliveryAddress() {

        if(isset($_SESSION['userID'])) {
            return $this->addresses->getCheckoutDeliveryAddress();
        }
    }

}