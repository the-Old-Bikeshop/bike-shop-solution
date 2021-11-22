<?php

class Order extends
    BasisSQL
{



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