<?php

class BrakeType extends BasisSQL
{
    protected $name = "";
    protected $condition;
    protected $id ="";
    public $message = "";


    public function __construct($name = "", $condition = 1 ) {
        parent::__construct();
        $this->name = filter_var(trim($name),FILTER_SANITIZE_STRING);
        $this->condition =trim($condition);
    }

    public function createBrakeSystem() {

        try {
            $query = $this->db->dbCon->prepare("INSERT INTO `braking_system` (`name`, `condition`)
                                            VALUES (:name, :condition)");
            $query->bindValue(':name', $this->name);
            $query->bindValue(':condition', $this->condition);
            $query->execute();

        } catch (Exception $e) {
            $this->message = $e->getMessage();
        }

    }

    public function updateBrakeSystem( $name, $condition, $id) {

        try {
            $this->name = filter_var(trim($name),FILTER_SANITIZE_STRING);
            $this->condition =trim($condition);

            $query = $this->db->dbCon->prepare("UPDATE `braking_system` SET 
                                                        `name` = :name , 
                                                        `condition` = :condition
                                                    WHERE braking_systemID = $id");

            $query->bindValue(':name', $this->name);
            $query->bindValue(':condition', $this->condition);
            $query->execute();
        }catch (Exception $e) {
            $this->message = $e->getMessage();
        }

    }

}
