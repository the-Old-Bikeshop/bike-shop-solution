<?php
spl_autoload_register(function ($class_name) {

    // Define an array of directories in the order of their priority to iterate through.
    $dirs = array(
        'models/',
        'controllers/',
        'controllers/admin/',
    );

    // Looping through each directory to load all the class files. It will only require a file once.
    // If it finds the same class in a directory later on, IT WILL IGNORE IT! Because of that require once!
    foreach ($dirs as $dir) {
        if (file_exists($dir . $class_name . '.php')) {
            require_once($dir . $class_name . '.php');
            return;
        }
    }
});

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