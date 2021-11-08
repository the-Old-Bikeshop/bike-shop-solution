<?php

class WheelSize extends BasisSQL
{

    protected $wheel_ISO;
    protected $tire_ISO;
    protected $wheel_sizeID;

    public $message;

    public function __construct( $wheel_ISO = '', $tire_ISO = '')
    {
        parent::__construct();
        $this->wheel_ISO = $wheel_ISO;
        $this->tire_ISO = $tire_ISO;

    }


    public function createWheelSize() {
        try {
            $query = $this->db->dbCon->prepare("INSERT INTO `wheel_size` (wheel_ISO, tire_ISO) VALUES (:wheel_ISO, :tire_ISO)");
            $query->bindValue(':wheel_ISO', $this->wheel_ISO);
            $query->bindValue(':tire_ISO', $this->tire_ISO);

            $query->execute();


        }catch(Exception $e) {
            $this->message = $e->getMessage();
        }

    }


    public function updateWheelSize($wheel_ISO, $tire_ISO, $id) {

        try {
            $this->wheel_ISO = $wheel_ISO;
            $this->tire_ISO = $tire_ISO;
            $this->wheel_sizeID = $id;
            $query = $this->db->dbCon->prepare("UPDATE `wheel_size` 
                                                        SET wheel_ISO = :wheel_ISO, tire_ISO = :tire_ISO 
                                                        WHERE wheel_sizeID = :wheel_sizeID");
            $query->bindValue(':wheel_ISO', $this->wheel_ISO);
            $query->bindValue(':tire_ISO', $this->tire_ISO);
            $query->bindValue(':wheel_sizeID', $this->wheel_sizeID);


            $query->execute();

        }catch(Exception $e) {
            $this->message = $e->getMessage();
        }
    }

}