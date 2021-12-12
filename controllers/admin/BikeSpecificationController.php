<?php
class BikeSpecificationController extends ViewController
{


    private $update;
    private $bikeSpecifications;
    private $data;
    private $one_bike;
    private $convert;


    public function __construct()
    {
        $this->update = false;
        $this->bikeSpecifications = new BikeSpecifications();
        $this->convert = new Convert();
    }

    public function setBikeSpecifications(): void
    {

        if(isset($_POST['submit-new'])) {

            $this->setData();
            $this->bikeSpecifications = new BikeSpecifications();
            $this->bikeSpecifications->createBikeSpecifications($this->data);
        }elseif(isset($_POST['update'])) {
            $this->bikeSpecifications = new BikeSpecifications();
            $this->update= true;
            $this->one_bike = $this->bikeSpecifications->fetchOne('bike_specifications', 'bike_specificationsID',
                $_POST['bike_specificationsID']);
        }elseif(isset($_POST['submit-update'])){
            $this->bikeSpecifications = new BikeSpecifications();
            $this->setData();
            $this->bikeSpecifications->updatebikeSpecifications($this->data, $_POST['bike_specificationsID'] );
        }elseif(isset($_POST['delete'])) {
            $this->bikeSpecifications = new BikeSpecifications();
            $this->bikeSpecifications->deleteRow('bike_specifications', 'bike_specificationsID',
                $_POST['bike_specificationsID']);
        }
    }

    public function setData(): void
    {
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);


        $data = [
            'type' => trim($_POST['type']) ?? "",
            'back_basket' => intval(trim($_POST['back_basket'])?? ""),
            'mudguards' => intval(trim($_POST['mudguards'])?? ""),
            'front_basket' => intval(trim($_POST['front_basket'])?? ""),
            'lights' => intval(trim($_POST['lights'])?? ""),
            'disk_brakes' => intval(trim($_POST['disk_brakes'])?? ""),
            'wheel_sizeID' => intval(trim($_POST['wheel_sizeID'])?? ""),
            'braking_systemID' => intval(trim($_POST['braking_systemID'])?? ""),
            'drive_typeID' => intval(trim($_POST['drive_typeID'])?? ""),
            'created_by' => intval(trim($_POST['created_by'])?? "")
        ];
        $this->data = $data;
    }

    /**
     * @return BikeSpecifications
     */
    public function getBikeSpecifications(): BikeSpecifications
    {
        return $this->bikeSpecifications;
    }

    /**
     * @return mixed
     */
    public function getOneBike()
    {
        return $this->one_bike;
    }

    /**
     * @return Convert
     */
    public function getConvert(): Convert
    {
        return $this->convert;
    }

    /**
     * @return false
     */
    public function getUpdate(): bool
    {
        return $this->update;
    }



    public function getAllDriveTypes() {
        return $this->bikeSpecifications->fetchAll('drive_type');
    }

    public function getAllBrakingSystem() {
        return $this->bikeSpecifications->fetchAll('braking_system');
    }

    public function getAllWheelSizes() {
        return $this->bikeSpecifications->fetchAll('wheel_size');
    }

    public function getAllBikeSpecifications() {
        return $this->bikeSpecifications->fetchAll('bike_speks');
    }

}