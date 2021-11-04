<?php

class ProductImage extends
    BasisSQL
{

    public $message;


    public function createProductImage($productID, $imageID) {
        try {

            $query = $this->db->dbCon->prepare("INSERT INTO `product_has_images`(productID, imageID) 
                                                                        VALUES (:productID, :imageID)");
            $query->bindValue(':productID', $productID);
            $query->bindValue(':imageID', $imageID);

            $query->execute();
            $this->message = "image added to procuct";

        }catch (Exception $e) {
            $this->message = $e->getMessage();
        }
    }

}