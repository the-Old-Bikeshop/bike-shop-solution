<?php

class BrakeType
{
    protected $name = "";
    protected $condition;

    protected $id ="";

    public $db;
    public $message = "";

    public function __construct($name = "", $condition = 1 ) {
        $this->db = new DBcon();
        $this->name = filter_var(trim($name),FILTER_SANITIZE_STRING);
        $this->condition =trim($condition);
    }

    public function fetchOneBrakeSystem($id) {
        $query = $this->db->dbCon->prepare("SELECT * FROM `braking_system` WHERE braking_systemID = $id");

        if($query->execute()) {
            $result = $query->fetch(PDO::FETCH_ASSOC);
            return $result;
        }
        return "The database could not be reached";
    }

    public function fetchAllBrakeSystems() {
        $query = $this->db->dbCon->prepare("SELECT * FROM `braking_system`");
        if($query->execute()) {
            $result = $query->fetchAll();
            return $result;
        }
        return "The database could not be reached";
    }

    public function createBrakeSystem() {
        $query = $this->db->dbCon->prepare("INSERT INTO `braking_system` (`name`, `condition`)
                                            VALUES (:name, :condition)");
        $query->bindValue(':name', $this->name);
        $query->bindValue(':condition', $this->condition);


        if($query->execute()) {
            $this->message = "Product created";
        } else {
            $this->message = "ERROR, product could not be created";
        }

    }

    public function updateBrakeSystem( $name, $condition, $id) {

        $this->name = filter_var(trim($name),FILTER_SANITIZE_STRING);
        $this->condition =trim($condition);

        $query = $this->db->dbCon->prepare("UPDATE `braking_system` SET 
                                                        `name` = :name , 
                                                        `condition` = :condition
                                                    WHERE drive_typeID = $id");

        $query->bindValue(':name', $this->name);
        $query->bindValue(':condition', $this->condition);

        if($query->execute()) {
            $this->message = "Product updated";
        } else {
            $this->message = "ERROR, product could not be updated";
        }
    }

    public function deleteBrakeSystem($id) {
        $query= $this->db->dbCon->prepare("DELETE FROM `braking_system` WHERE braking_systemID = $id");
        if($query->execute()) {
            $this->message = "Product deleted";
        } else {
            $this->message = "ERROR, product could not be deleted";
        }
    }



}