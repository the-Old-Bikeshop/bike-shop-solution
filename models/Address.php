<?php


class Address extends
    BasisSQL
{

    public function createAddress($data) {

        $this->db->dbCon->beginTransaction();


        try {
//            check if exist

            $checkQuery = $this->db->dbCon->prepare("SELECT * FROM `address` WHERE `address_type` = :address_type AND `userID` = :userID ");

            $checkQuery->bindValue(':address_type' ,$data["address_type"] );
            $checkQuery->bindValue(':userID' ,$data["userID"] );

            $checkQuery->execute();
            if ($checkQuery->rowCount() == 0) {

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


                if($query->execute()) {
                   $this->setAddressToSession($data);
                }

            } else {
                $result = $checkQuery->fetch(PDO::FETCH_ASSOC);
                $this->updateAddress($data, $result['addressID']);

            }

            $this->db->dbCon->commit();


        }catch (Exception $e) {
            $this->db->dbCon->rollBack();
            $this->message = $e->getMessage();
            echo $this->message;
        }
    }

    public function updateAddress($data, $id) {

        var_dump($data);

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

            if($query->execute()) {
                $this->setAddressToSession($data);
            }


        }catch (Exception $e) {
            $this->message = $e->getMessage();
        }
    }
    public function getCheckoutInvoiceAddress() {
        $query = $this->db->dbCon->prepare("SELECT * FROM `address` WHERE `address_type` = 1 AND `userID` = :userID");
        $query->bindValue( ':userID', $_SESSION['userID']);
        $query->execute();
        return $query->fetch(PDO::FETCH_ASSOC);
    }
    public function getCheckoutDeliveryAddress() {
        $query = $this->db->dbCon->prepare("SELECT * FROM `address` WHERE `address_type` = 2 AND `userID` = :userID");
        $query->bindValue( ':userID', $_SESSION['userID']);
        $query->execute();
        $row = $query->rowCount();
        $result = [];
        if ($row > 0) {
            $result = $query->fetch(PDO::FETCH_ASSOC);
        } else {
           $result = $this->getCheckoutInvoiceAddress();
        }
        return $result;
    }

    private function setAddressToSession($data) {
            if ($data["address_type"] === 1) {
                $_SESSION['active_invoice_address'] = $data["street_name"] . " " . $data["address_content"] . " " .
                    $data["postalCodeID"];

            } else {
                $_SESSION['active_delivery_address'] = $data["street_name"] . " " . $data["address_content"] . " " .
                    $data["postalCodeID"];
            }

    }


}