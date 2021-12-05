<?php

class ProductHasCategory extends
    BasisSQL
{

    public function fetchCategoryListForProduct($productID) {
        try {
            $query = $this->db->dbCon->prepare("SELECT categoryID FROM product_has_category WHERE productID = :productID ");
            $query->bindValue(':productID', $productID);
            $query->execute();
            $result = $query->fetchAll(PDO::FETCH_ASSOC);
            return $result;

        }catch (Exception $e) {
            $this->message = $e;
        }
    }

    public function addCategoryToProduct($productID, $categoryID) {


        try {

            $query = $this->db->dbCon->prepare("INSERT INTO `product_has_category` (productID,  categoryID)
                                                    VALUES (:productID, :categoryID)");
            $query->bindValue(':productID', $productID);
            $query->bindValue(':categoryID', $categoryID);

            $query->execute();

        }catch (Exception $e) {
            $this->message = $e;
        }
    }

    public function deleteCategoryToProduct($productID, $categoryID) {

        try {

            $query = $this->db->dbCon->prepare("DELETE FROM `product_has_category` WHERE productID = :productID AND categoryID = :categoryID ");
            $query->bindValue(':productID', $productID);
            $query->bindValue(':categoryID', $categoryID);

            $query->execute();

        }catch (Exception $e) {
            $this->message = $e;
        }
    }

}