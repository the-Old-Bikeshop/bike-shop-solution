<?php

class Category
{

    private $db;
    public $message = "";


    public function __construct()
    {
        $this->db = new DBcon();
    }

    public function createCategories($data) {

        $query=$this->db->dbCon->prepare("INSERT INTO `category` (
                               description,
                               short_description,
                               name
                            ) 
                               VALUES (
                                       :description,
                                       :short_description,
                                       :name 
                               )" );

        $query->bindValue(':description', $data['description']);
        $query->bindValue(':short_description', $data['short_description']);
        $query->bindValue(':name', $data['name']);


        if($query->execute()) {
            $this->message = "Category added to the database";
        } else{
            $this->message = "Something went wrong";
        }

    }




    public function updateCategory($data, $id) {
        $query=$this->db->dbCon->prepare("UPDATE `category` SET 
                               `description` = :description,
                               `short_description` = :short_description,
                               `name` = :name
                                WHERE `categoryID` = $id");

        $query->bindValue(':description', $data['description']);
        $query->bindValue(':short_description', $data['short_description']);
        $query->bindValue(':name', $data['name']);


        if($query->execute()) {
            $this->message = "Category updated";
        } else{
            $this->message = "Something went wrong";
        }

    }

    public function fetchAllCategories() {

        $query = $this->db->dbCon->prepare("SELECT * FROM `category`");
        if($query->execute()) {
            $result = $query->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        } else {
            return "ERROR: The database could not be reached";
        }

    }

    public function fetchOneCategory($id) {

        $query = $this->db->dbCon->prepare("SELECT * FROM `category` WHERE `categoryID` = $id ");
        if($query->execute()) {
            $result = $query->fetch(PDO::FETCH_ASSOC);
            return $result;
        } else {
            return "ERROR: The database could not be reached";
        }
    }



    public function deleteCategory($id) {

        $query = $this->db->dbCon->prepare("DELETE FROM `category` WHERE `categoryID` = $id");

        if($query->execute()) {
            $this->message="deleted";

        }else {
            $this->message="something went wrong";
        }

    }



}