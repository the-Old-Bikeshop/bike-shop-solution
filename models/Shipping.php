<?php

class Shipping extends
    BasisSQL
{

    public function createShipping($data) {

        try {

            $query=$this->db->dbCon->prepare("INSERT INTO `shipping` (
                                                                    description,
                                                                    name) 
                                                                   VALUES (
                                                                           :description, 
                                                                           :name )"
                                                                            );

            $query->bindValue(':description', $data['description']);
            $query->bindValue(':name', $data['name']);
            $query->execute();

        }catch(Exception $e ) {
            $this->message = $e->getMessage();
        }

    }

    public function updateShipping($data, $id) {
        try {

            $query=$this->db->dbCon->prepare("UPDATE `shipping` SET 
                               `description` = :description,
                               `name` = :name
                                WHERE `shippingID` = :id");

            $query->bindValue(':description', $data['description']);
            $query->bindValue(':name', $data['name']);
            $query->bindValue(':id', $id);
            $query->execute();

        }catch(Exception $e ) {
            $this->message = $e->getMessage();
        }

    }



}