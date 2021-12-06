<?php

class Product extends BasisSQL
{
    public $last_id;
    public $productIDlist;

    public function fetchFilterProducts() {

        try {
            $this->db->dbCon->beginTransaction();

                if(isset($_POST['category'])){
                    $category_str = implode("','", $_POST['category']);
                    $catQuery = "SELECT DISTINCT `productID` FROM `product_has_category` 
                WHERE categoryID IN ('".$category_str."')";

                    $cat_st = $this->db->dbCon->prepare($catQuery);
                    $cat_st->execute();

                    $this->productIDlist = $cat_st->fetchAll();
                    $productIDsrt = implode("','", array_column($this->productIDlist, 'productID'));

                    $query = "SELECT * FROM `product` 
                WHERE `productID` IN ('".$productIDsrt."')";
                    $statement = $this->db->dbCon->prepare($query);

                    $statement->execute();
                    $result = $statement->fetchAll();
                    $total_Rows = $statement->rowCount();

                    $this->db->dbCon->commit();

                    if($total_Rows > 0) {
                        return $result;


                    }else {
                        return 'no result found';
                    }


                }else {
                    $this->fetchAll('product');
                }

            }catch (Exception $e) {
            $this->db->dbCon->rollBack();
                $this->message = $e;

        }

    }


    public function createProduct($data) {
        $this->db->dbCon->beginTransaction();
        try{

            $query = $this->db->dbCon->prepare("INSERT INTO `product` (
                                                            name, 
                                                            description, 
                                                            short_description,
                                                            weight,
                                                            price,
                                                            model_name,
                                                            stock,
                                                            length,
                                                            color,
                                                            bike_specificationsID,
                                                            brandID,
                                                            created_by
                                                            ) 
                                                                VALUES (
                                                                :name, 
                                                                :description, 
                                                                :short_description,
                                                                :weight,
                                                                :price,
                                                                :model_name,
                                                                :stock,
                                                                :length,
                                                                :color,
                                                                :bike_specificationsID,
                                                                :brandID,
                                                                :created_by)");


            $query->bindValue(':name',$data['name']);
            $query->bindValue(':description',$data['description']);
            $query->bindValue(':short_description',$data['short_description']);
            $query->bindValue(':weight',$data['weight']);
            $query->bindValue(':price',$data['price']);
            $query->bindValue(':model_name',$data['model_name']);
            $query->bindValue(':stock',$data['stock']);
            $query->bindValue(':length',$data['length']);
            $query->bindValue(':color',$data['color']);
            $query->bindValue(':bike_specificationsID',$data['bike_specificationsID']);
            $query->bindValue(':brandID',$data['brandID']);
            $query->bindValue(':created_by',$data['created_by']);

            $query->execute();
            $this->last_id = $this->db->dbCon->lastInsertId();
            $this->db->dbCon->commit();
            return $this->last_id;


        }catch (Exception $e) {

            $this->db->dbCon->rollBack();
            $this->message = $e->getMessage();

        }

    }

    public function fetchImageList($id) {

        try {
            $query = $this->db->dbCon->prepare("SELECT `imageID` FROM `product_has_images` WHERE productID = :id");
            $query->bindValue(':id', $id);
            $query->execute();
            $result = $query->fetchAll(PDO::FETCH_ASSOC);
            return $result;

        } catch(Exception $e) {
            $this->message = $e->getMessage();
        }

    }

    public function updateProduct($data, $id) {
        try {


            $query = $this->db->dbCon->prepare("UPDATE `product` SET
                                                                        name = :name, 
                                                                        description = :description, 
                                                                        short_description = :short_description,
                                                                        weight = :weight,
                                                                        price = :price,
                                                                        model_name = :model_name,
                                                                        stock = :stock,
                                                                        length = :length,
                                                                        color = :color,
                                                                        bike_specificationsID = :bike_specificationsID,
                                                                        brandID = :brandID,
                                                                        created_by = :created_by
                                                                            WHERE productID = :id");

            $query->bindValue(':name',$data['name']);
            $query->bindValue(':description',$data['description']);
            $query->bindValue(':short_description',$data['short_description']);
            $query->bindValue(':weight',$data['weight']);
            $query->bindValue(':price',$data['price']);
            $query->bindValue(':model_name',$data['model_name']);
            $query->bindValue(':stock',$data['stock']);
            $query->bindValue(':length',$data['length']);
            $query->bindValue(':color',$data['color']);
            $query->bindValue(':bike_specificationsID',$data['bike_specificationsID']);
            $query->bindValue(':brandID',$data['brandID']);
            $query->bindValue(':created_by',$data['created_by']);
            $query->bindValue(':id',$id);

            $query->execute();
            $this->db->dbCon->commit();
            $this->last_id = $this->db->dbCon->lastInsertId();
            return $this->last_id;

        }catch (Exception $e) {
            $this->message = $e->getMessage();
        }

    }

}

$product = new Product();
if(isset($_POST['category'])) {
    $product->fetchFilterProducts();
}