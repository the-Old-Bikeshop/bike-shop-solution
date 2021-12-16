<?php

class Order extends
    BasisSQL
{



    public function createOrder($data) {

        $this->db->dbCon->beginTransaction();

        try {
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
            $_SESSION['active_orderID'] = $this->db->dbCon->lastInsertId();
            var_dump($_SESSION['active_orderID']);
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

    public function fetchUserOrders() {
        $query = $this->db->dbCon->prepare("SELECT * FROM `order_view` WHERE `email` = :email");
        $query->bindValue(':email', $_SESSION['email']);
        $query->execute();
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function fetchSimpleOrderForUser() {
        $query = $this->db->dbCon->prepare("SELECT * FROM `order` WHERE `userID` = :userID ORDER BY `created_at` DESC ");
        $query->bindValue(':userID', $_SESSION['userID']);
        $query->execute();
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    public function fetchOrderProductList($orderID) {
        $query = $this->db->dbCon->prepare("SELECT * FROM `order_view` WHERE `orderID` = :orderID");
        $query->bindValue(':orderID', $orderID);
        $query->execute();
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        return $result;

    }
}