<?php

spl_autoload_register(function($class_name) {

    // Define an array of directories in the order of their priority to iterate through.
    $dirs = array(
        'models/',
        'controllers/',
        'controllers/admin/',
    );

    // Looping through each directory to load all the class files. It will only require a file once.
    // If it finds the same class in a directory later on, IT WILL IGNORE IT! Because of that require once!
    foreach( $dirs as $dir ) {
        if (file_exists($dir . $class_name .'.php')) {
            require_once($dir . $class_name.'.php');
            return;
        }
    }
});





class BikeSpecificationController extends ViewController
{

    private $brake;
    private $drive_type ;
    private $update;
    private $bikeSpecifications;
    private $data;
    private $one_bike;
    private $convert;
    private $wheel;

    public function __construct()
    {

        $this->drive_type = new DriveType();
        $this->brake= new BrakeType();
        $this->update = false;
        $this->bikeSpecifications = new BikeSpecifications();
        $this->convert = new Convert();
        $this->wheel = new WheelSize();
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
            $this->one_bike = $this->bikeSpecifications->fetchOneBikeSpecification($_POST['bike_specificationsID']);
        }elseif(isset($_POST['submit-update'])){
            $this->bikeSpecifications = new BikeSpecifications();
            $this->setData();
            $this->bikeSpecifications->updatebikeSpecifications($this->data, $_POST['bike_specificationsID'] );
        }elseif(isset($_POST['delete'])) {
            $this->bikeSpecifications = new BikeSpecifications();
            $this->bikeSpecifications->deletebikeSpecifications($_POST['bike_specificationsID']);
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
     * @return BrakeType
     */
    public function getBrake(): BrakeType
    {
        return $this->brake;
    }

    /**
     * @return DriveType
     */
    public function getDriveType(): DriveType
    {
        return $this->drive_type;
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

    /**
     * @return WheelSize
     */
    public function getWheel(): WheelSize
    {
        return $this->wheel;
    }

}