<?php

class Product extends BasisSQL
{
    public $message;
    public $last_id;

    //CREATE TABLE product (
    //    productID INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    //  `name` VARCHAR(100) NOT NULL,
    //  `description` TEXT,
    //  short_description VARCHAR(255),
    //  `weight` DECIMAL(10, 2),
    //  price DECIMAL(10, 2) NOT NULL,
    //  model_name VARCHAR(255) NOT NULL,
    //  stock INT NOT NULL,
    //  `length` DECIMAL(10, 2),
    //  color VARCHAR(100),
    //  bike_specificationsID INT,
    //  brandID INT,
    //  created_by INT NOT NULL,
    //  FOREIGN KEY (bike_specificationsID) REFERENCES bike_specifications (bike_specificationsID),
    //  FOREIGN KEY (brandID) REFERENCES brand (brandID),
    //  FOREIGN KEY (created_by) REFERENCES `user` (userID)
    //);

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