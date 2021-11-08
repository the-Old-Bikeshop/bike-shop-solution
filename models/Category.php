<?php

class Category extends BasisSQL
{

    public $message = "";


    public function createCategories($data) {

        try {
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
            $query->execute();

        }catch (Exception $e) {
            $this->message = $e->getMessage();
        } finally {
        }


    }


    public function updateCategory($data, $id) {

        try {
            $query=$this->db->dbCon->prepare("UPDATE `category` SET 
                               `description` = :description,
                               `short_description` = :short_description,
                               `name` = :name
                                WHERE `categoryID` = $id");

            $query->bindValue(':description', $data['description']);
            $query->bindValue(':short_description', $data['short_description']);
            $query->bindValue(':name', $data['name']);
            $query->execute();

        }catch (Exception $e) {
            $this->message = $e->getMessage();
        } finally {
        }


    }


}

