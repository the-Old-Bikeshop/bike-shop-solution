<?php

class DriveType
{

    protected $name = "";
    protected $short_description = "";
    protected $description = "";
    protected $id ="";

    public $db;
    public $message = "";

    public function __construct($name = "", $short_description = "", $description = "") {
            $this->db = new DBcon();
            $this->name = filter_var(trim($name),FILTER_SANITIZE_STRING);
            $this->short_description = filter_var(trim($short_description),FILTER_SANITIZE_STRING);
            $this->description = filter_var(trim($description),FILTER_SANITIZE_STRING);
    }

    public function fetchOneDriveType($id) {
        $query = $this->db->dbCon->prepare("SELECT * FROM `drive_type` WHERE drive_typeID = $id");

        if($query->execute()) {
            $result = $query->fetch(PDO::FETCH_ASSOC);
            return $result;
        }
        return "The database could not be reached";
    }

    public function fetchAllDriveTypes() {
        $query = $this->db->dbCon->prepare("SELECT * FROM `drive_type`");
        if($query->execute()) {
            $result = $query->fetchAll();
            return $result;
        }
        return "The database could not be reached";
    }

    public function createBikeDrive() {
        $query = $this->db->dbCon->prepare("INSERT INTO `drive_type` (name, short_description, description)
                                            VALUES (:name, :short_description, :description)");
        $query->bindValue(':name', $this->name);
        $query->bindValue(':short_description', $this->short_description);
        $query->bindValue("description", $this->description);

        if($query->execute()) {
            $this->message = "Product created";
        } else {
            $this->message = "ERROR, product could not be created";
        }

    }

    public function updateBikeDrive( $name, $short_description, $description, $id) {

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

        if($query->execute()) {
            $this->message = "Product updated";
        } else {
            $this->message = "ERROR, product could not be updated";
        }
    }

    public function deleteBikeDrive($id) {
        $query= $this->db->dbCon->prepare("DELETE FROM `drive_type` WHERE drive_typeID = $id");
        if($query->execute()) {
            $this->message = "Product deleted";
        } else {
            $this->message = "ERROR, product could not be deleted";
        }
    }


}