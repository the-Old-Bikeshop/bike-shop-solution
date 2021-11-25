<?php

class Brand extends
    BasisSQL
{

    public function createBrand($data) {
        try {
            $query = $this->db->dbCon->prepare('INSERT INTO `brand` (name, description, short_description, website) 
                                                VALUES (:name, :description, :short_description, :website)');

            $query->bindValue(':name', $data['name']);
            $query->bindValue(':description', $data['description']);
            $query->bindValue(':short_description', $data['short_description']);
            $query->bindValue(':website', $data['website']);

            $query->execute();

        }catch (Exception $e) {
            $this->message = $e->getMessage();
        }
    }

    public function updateBrand($data, $id) {
        try {
            $query = $this->db->dbCon->prepare('UPDATE `brand` SET 
                                                            name = :name, 
                                                            description = :description, 
                                                            short_description = :short_description, 
                                                            website = :website 
                                                            WHERE brandID = :brandID');

            $query->bindValue(':name', $data['name']);
            $query->bindValue(':description', $data['description']);
            $query->bindValue(':short_description', $data['short_description']);
            $query->bindValue(':website', $data['website']);
            $query->bindValue(':brandID', $id);

            $query->execute();

        }catch (Exception $e) {
            $this->message = $e->getMessage();
        }
    }

    public function updateImageId($data, $id) {

        try {

            $query = $this->db->dbCon->prepare('UPDATE `brand` SET 
                                                            imageID = :imageID 
                                                            WHERE brandID = :brandID');

            $query->bindValue(':imageID', $data->last_id);
            $query->bindValue(':brandID', $id);

            $query->execute();

        }catch (Exception $e) {
            $this->message = $e->getMessage();
        }

    }



}