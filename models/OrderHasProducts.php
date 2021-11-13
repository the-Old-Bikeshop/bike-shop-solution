<?php

class OrderHasProducts extends
    BasisSQL
{
    public function addProductToOrder($data) {
        try {
            $query = $this->db->dbCon->prepare("INSERT INTO order_has_products (quantity, orderID, productID) VALUES (:quantity, :orderID, :productID)");
            $query->bindValue(':quantity', $data['quantity']);
            $query->bindValue(':orderID', $data['orderID']);
            $query->bindValue(':productID', $data['productID']);

            $query->execute();

        }catch (Exception $e) {
            $this->message = $e->getMessage();
        }

}

}