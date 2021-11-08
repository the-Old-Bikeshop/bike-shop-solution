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

class DriveTypeController extends ViewController {

    public $update;
    private $drive_type;
    private $drive;

    public function __construct()
    {
        $this->update = false;
        $this->drive_type = new DriveType();

    }

    public function setDriveType(): void {

        if(isset($_POST['submit-new'])) {
            $this->drive_type = new DriveType($_POST['name'], $_POST['short_description'], $_POST['description']);
            $this->drive_type->createBikeDrive();
        }elseif(isset($_POST['update'])) {
            $this->drive_type = new DriveType();
            $this->update= true;
            $this->drive = $this->drive_type->fetchOne('drive_type', 'drive_typeID', $_POST['drive_typeID']);
        }elseif(isset($_POST['submit-update'])){
            $this->drive_type = new DriveType();
            $this->drive_type->updateBikeDrive($_POST['name'], $_POST['short_description'], $_POST['description'], $_POST['drive_typeID'] );
        }elseif(isset($_POST['delete'])) {
            $this->drive_type = new DriveType();
            $this->drive_type->deleteRow('drive_type', 'drive_typeID', $_POST['drive_typeID']);
        }
    }

    /**
     * @return DriveType
     */
    public function getDriveType(): DriveType
    {
        return $this->drive_type;
    }

    /**
     * @return mixed
     */
    public function getDrive()
    {
        return $this->drive;
    }

    /**
     * @return false
     */
    public function getUpdate(): bool
    {
        return $this->update;
    }
}