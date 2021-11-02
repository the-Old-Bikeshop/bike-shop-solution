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
            $this->wheel = $this->wheel_size->fetchOneWheel($_POST['wheel_sizeID']);
        }elseif(isset($_POST['submit-update'])){

            $this->wheel_size = new WheelSize();
            $this->wheel_size->updateWheelSize(filter_var(trim($_POST['wheel_ISO']),FILTER_SANITIZE_STRING), filter_var(trim($_POST['tire_ISO']),FILTER_SANITIZE_STRING), $_POST['wheel_sizeID']);
        }elseif(isset($_POST['delete'])) {
            $this->wheel_size = new WheelSize();
            $this->wheel_size->deleteWheelSize($_POST['wheel_sizeID']);
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
}