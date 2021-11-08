<?php

class DriveType extends BasisSQL
{

    protected $name = "";
    protected $short_description = "";
    protected $description = "";
    protected $id ="";
    public $message = "";

    public function __construct($name = "", $short_description = "", $description = "") {
        parent::__construct();
        $this->name = filter_var(trim($name),FILTER_SANITIZE_STRING);
        $this->short_description = filter_var(trim($short_description),FILTER_SANITIZE_STRING);
        $this->description = filter_var(trim($description),FILTER_SANITIZE_STRING);
    }


    public function createBikeDrive() {

        try {
            $query = $this->db->dbCon->prepare("INSERT INTO `drive_type` (name, short_description, description)
                                            VALUES (:name, :short_description, :description)");
            $query->bindValue(':name', $this->name);
            $query->bindValue(':short_description', $this->short_description);
            $query->bindValue("description", $this->description);
            $query->execute();

        }catch (Exception $e) {
            $this->message = $e->getMessage();
        } finally {

        }

    }


    public function updateBikeDrive( $name, $short_description, $description, $id) {

        try {
            $this->name = filter_var(trim($name),FILTER_SANITIZE_STRING);
            $this->short_description = filter_var(trim($short_description),FILTER_SANITIZE_STRING);
            $this->description = filter_var(trim($description),FILTER_SANITIZE_STRING);

            $query = $this->db->dbCon->prepare("UPDATE `drive_type` SET 
                                                        `name` = :name , 
                                                        `short_description` = :short_description, 
                                                        `description` = :description
                                                    WHERE drive_typeID = $id");

            $query->bindValue(':name', $this->name);
            $query->bindValue(':short_description', $this->short_description);
            $query->bindValue("description", $this->description);
            $query->execute();

        }catch(Exception $e) {
            $this->message = $e->getMessage();
        }
    }
}