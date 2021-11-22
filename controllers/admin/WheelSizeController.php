<?php


class WheelSizeController extends ViewController {

    public $update;
    private $wheel_size;
    private $wheel;

    public function __construct() {
        $this->update = false;
        $this->wheel_size = new WheelSize();

    }

    public function setWheelSize(): void {

        if(isset($_POST['submit-new'])) {
            $this->wheel_size = new WheelSize( filter_var(trim($_POST['wheel_ISO']),FILTER_SANITIZE_STRING), filter_var(trim($_POST['tire_ISO']),FILTER_SANITIZE_STRING));
            $this->wheel_size->createWheelSize();
        }elseif(isset($_POST['update'])) {
            $this->wheel_size = new WheelSize();
            $this->update= true;
            $this->wheel = $this->wheel_size->fetchOne('wheel_size', 'wheel_sizeID', $_POST['wheel_sizeID']);
        }elseif(isset($_POST['submit-update'])){

            $this->wheel_size = new WheelSize();
            $this->wheel_size->updateWheelSize(filter_var(trim($_POST['wheel_ISO']),FILTER_SANITIZE_STRING), filter_var(trim($_POST['tire_ISO']),FILTER_SANITIZE_STRING), $_POST['wheel_sizeID']);
        }elseif(isset($_POST['delete'])) {
            $this->wheel_size = new WheelSize();
            $this->wheel_size->deleteRow('wheel_size', 'wheel_sizeID', $_POST['wheel_sizeID']);
        }
    }

    /**
     * @return WheelSize
     */
    public function getWheelSize(): WheelSize
    {
        return $this->wheel_size;
    }

    /**
     * @return mixed
     */
    public function getWheel()
    {
        return $this->wheel;
    }

    /**
     * @return false
     */
    public function getUpdate(): bool
    {
        return $this->update;
    }

    public function getAllWheelSizes() {
        return $this->wheel_size-> fetchAll('wheel_size');
    }
}