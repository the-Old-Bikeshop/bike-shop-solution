<?php

class RecommendedProducts extends
    BasisSQL
{

    public function fetchRecommendedProducts($productID) {
        $this->db->dbCon->beginTransaction();
        try {

//            get list of product categories

            $productQuery = $this->db->dbCon->prepare("SELECT DISTINCT categoryID FROM `product_has_category` WHERE productID = :productID");
            $productQuery->bindValue(':productID',$productID );
            $productQuery->execute();
            $categoryIDList = $productQuery->fetchAll(PDO::FETCH_ASSOC);


//            turn categoryID list in string

            $categoryIDstr = implode("','", array_column($categoryIDList, 'categoryID'));


//            query for the other productIds that have the same categories

            $catQuery = $this->db->dbCon->prepare("SELECT DISTINCT `productID` FROM `product_has_category` 
                    WHERE productID IN ('".$categoryIDstr."')");
            $catQuery->execute();
            $productIDlist = $catQuery->fetchAll(PDO::FETCH_ASSOC);

//            turn productID list in string

            $productIDsrt = implode("','", array_column($productIDlist, 'productID'));


//            fetch product form simple_product_with_image that match the id list

            $query = $this->db->dbCon->prepare("SELECT DISTINCT * FROM `simple_product_with_image` 
                    WHERE `productID` IN ('".$productIDsrt."')");

            $query->execute();
            $result = $query->fetchAll(PDO::FETCH_ASSOC);

            $this->db->dbCon->commit();
            return $result;

        }catch (Exception $e) {
            $this->db->dbCon->rollBack();
            $this->message = $e;

        }
    }

}