<?php

class WheelSize
{

    protected $wheel_ISO;
    protected $tire_ISO;
    protected $wheel_sizeID;
    public $db;
    public $message;

    public function __construct( $wheel_ISO = '', $tire_ISO = '')
    {
        $this->db = new DBcon();
        $this->wheel_ISO = $wheel_ISO;
        $this->tire_ISO = $tire_ISO;

    }

    public function fetchAllWheelSizes() {
        $query = $this->db->dbCon->prepare("SELECT * FROM `wheel_size`");
        if ($query->execute()) {
            $result = $query->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        }
        $this->message = $query->errorInfo();;
    }


    public function createWheelSize() {
        $query = $this->db->dbCon->prepare("INSERT INTO `wheel_size` (wheel_ISO, tire_ISO) VALUES (:wheel_ISO, :tire_ISO)");
        $query->bindValue(':wheel_ISO', $this->wheel_ISO);
        $query->bindValue(':tire_ISO', $this->tire_ISO);

        if($query->execute()) {
            $this->message = "New Product created";
        } else {
            $this->message = $query->errorInfo();

        }

    }

    public function fetchOneWheel($id) {
        $query = $this->db->dbCon->prepare("SELECT * FROM `wheel_size` WHERE wheel_sizeID = $id");
        if ($query->execute()) {
            $result = $query->fetch(PDO::FETCH_ASSOC);
            return $result;
        }
        $this->message = $query->errorInfo();
    }

    public function updateWheelSize($wheel_ISO, $tire_ISO, $id) {

        $this->wheel_ISO = $wheel_ISO;
        $this->tire_ISO = $tire_ISO;
        $this->wheel_sizeID = $id;



            $query = $this->db->dbCon->prepare("UPDATE `wheel_size` 
                                                        SET wheel_ISO = :wheel_ISO, tire_ISO = :tire_ISO 
                                                        WHERE wheel_sizeID = :wheel_sizeID");
            $query->bindValue(':wheel_ISO', $this->wheel_ISO);
            $query->bindValue(':tire_ISO', $this->tire_ISO);
            $query->bindValue(':wheel_sizeID', $this->wheel_sizeID);


            if($query->execute()) {
                $this->message = "New Product created";
            } else {
                $this->message = $query->errorInfo();

            }

    }

    public function deleteWheelSize($id) {
        $query = $this->db->dbCon->prepare("DELETE FROM `wheel_size` WHERE wheel_sizeID = $id");
        if ($query->execute()) {
            $this->message ="Product deleted";
        }
        $this->message = "error";

    }



}