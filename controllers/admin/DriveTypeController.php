<?php


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

    public function getAllDriveTypes() {
        return $this->drive_type->fetchAll('drive_type');
    }
}