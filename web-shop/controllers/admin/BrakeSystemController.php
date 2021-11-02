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

class BrakeSystemController extends ViewController
{
    public $convert;
    private $update;
    private $brake;
    private $val;

    public function __construct()
    {
        $this->convert = new Convert();
        $this->update = false;
        $this->brake = new BrakeType();
    }

    public function setBrake() {
        if(isset($_POST['submit-new'])) {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $this->brake = new BrakeType($_POST['name'], $_POST['condition']);
            $this->brake->createBrakeSystem();
        }elseif(isset($_POST['update'])) {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $this->brake = new BrakeType();
            $this->update= true;
            $this->val = $this->brake->fetchOneBrakeSystem($_POST['braking_systemID']);
        }elseif(isset($_POST['submit-update'])){
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $this->brake = new BrakeType();
            $this->brake->updateBrakeSystem($_POST['name'], $_POST['condition'], $_POST['braking_systemID'] );
        }elseif(isset($_POST['delete'])) {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $this->brake = new BrakeType();
            $this->brake->deleteBrakeSystem($_POST['braking_systemID']);
        }
    }

    /**
     * @return BrakeType
     */
    public function getBrake(): BrakeType
    {
        return $this->brake;
    }

    /**
     * @return mixed
     */
    public function getVal()
    {
        return $this->val;
    }

    /**
     * @return false
     */
    public function getUpdate(): bool
    {
        return $this->update;
    }

    /**
     * @return Convert
     */
    public function getConvert(): Convert
    {
        return $this->convert;
    }



}