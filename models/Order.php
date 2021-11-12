<?php

class Order extends
    BasisSQL
{


    //CREATE TABLE `order` (
    //orderID INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    //created_at  TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    //follow_up_date DATE,
    //`status` INT NOT NULL ,
    //payment_status INT NOT NULL,
    //total_price DECIMAL(10,2),
    //userID INT NOT NULL,
    //shippingID INT NOT NULL,
    //FOREIGN KEY (userID) REFERENCES `user` (userID),
    //FOREIGN KEY (shippingID) REFERENCES shipping (shippingID)
    //);

    public function createOrder($data) {

        try {
            $this->db->dbCon->beginTransaction();
            $query = $this->db->dbCon->prepare("INSERT INTO `order` (
                                                                    status,
                                                                    payment_status,
                                                                    total_price,
                                                                    userID,
                                                                    shippingID)
        VALUES(
            :status,
            :payment_status,
            :total_price,
            :userID,
            :shippingID)");

            $query->bindValue(':status', $data['status'] );
            $query->bindValue(':payment_status', $data['payment_status'] );
            $query->bindValue(':total_price', $data['total_price'] );
            $query->bindValue(':userID', $data['userID'] );
            $query->bindValue(':shippingID', $data['shippingID'] );

            $query->execute();

            $this->db->dbCon->commit();

        }catch (Exception $e) {
            $this->db->dbCon->rollBack();
            $this->message = $e->getMessage();
        }

    }
    public function updateOrder($data, $id) {
        try {

            $this->db->dbCon->beginTransaction();
            $query = $this->db->dbCon->prepare("UPDATE `order` SET 
                                                                    status = :status,
                                                                    payment_status = :payment_status,
                                                                    total_price = :total_price,
                                                                    userID = :userID,
                                                                    shippingID = :shippingID
                                                    WHERE orderID = :id");

            $query->bindValue(':status', $data['status'] );
            $query->bindValue(':payment_status', $data['payment_status'] );
            $query->bindValue(':total_price', $data['total_price'] );
            $query->bindValue(':userID', $data['userID'] );
            $query->bindValue(':shippingID', $data['shippingID'] );
            $query->bindValue(':id', $id );

            $query->execute();
            $this->db->dbCon->commit();



        }catch (Exception $e) {
            $this->db->dbCon->rollBack();
            $this->message = $e->getMessage();
        }

    }
}