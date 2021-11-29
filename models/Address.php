<?php


class Address extends
    BasisSQL
{

    public function createAddress($data) {


        try {
            $query = $this->db->dbCon->prepare("INSERT INTO `address` (
                                                                            street_name, 
                                                                            address_content, 
                                                                            phone_number, 
                                                                            address_type, 
                                                                            userID, 
                                                                            postalCodeID )
                                                                            VALUES (
                                                                            :street_name, 
                                                                            :address_content, 
                                                                            :phone_number, 
                                                                            :address_type, 
                                                                            :userID, 
                                                                            :postalCodeID
                                                                            )");

            $query->bindValue(":street_name", $data["street_name"]);
            $query->bindValue(":address_content", $data["address_content"]);
            $query->bindValue(":phone_number", $data["phone_number"]);
            $query->bindValue(":address_type", $data["address_type"]);
            $query->bindValue(":userID", $data["userID"]);
            $query->bindValue(":postalCodeID", $data["postalCodeID"]);
            $query->execute();


        }catch (Exception $e) {
            $this->message = $e->getMessage();
        }
    }

    public function updateAddress($data, $id) {

        try {
         $query = $this->db->dbCon->prepare("UPDATE `address` SET
                `street_name` = :street_name, 
                `address_content` = :address_content, 
                `phone_number` = :phone_number, 
                `address_type` = :address_type, 
                `userID` = :userID, 
                `postalCodeID` = :postalCodeID 
                WHERE addressID = :addressID");

            $query->bindValue(":street_name", $data["street_name"]);
            $query->bindValue(":address_content", $data["address_content"]);
            $query->bindValue(":phone_number", $data["phone_number"]);
            $query->bindValue(":address_type", $data["address_type"]);
            $query->bindValue(":userID", $data["userID"]);
            $query->bindValue(":postalCodeID", $data["postalCodeID"]);
            $query->bindValue(":addressID", $id);

            $query->execute();


        }catch (Exception $e) {
            $this->message = $e->getMessage();
        }
    }


}