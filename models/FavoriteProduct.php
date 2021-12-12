<?php

class FavoriteProduct extends
    BasisSQL
{

    public function createFavorite($data) {
        try {
            $this->db->dbCon->beginTransaction();



            $get = $this->db->dbCon->prepare("SELECT productID FROM `favourite_products` WHERE userID = :userID AND productID = :productID ");
            $get->bindValue(":userID", $data['userID']);
            $get->bindValue(":productID", $data['productID']);

            $query = $this->db->dbCon->prepare("INSERT INTO `favourite_products` (userID, productID)
                                                      VALUES (:userID, :productID)");

            $query->bindValue(":userID", $data['userID']);
            $query->bindValue(":productID", $data['productID']);
            $this->fetchUserFavorits();
            $get->execute();
            if (count($query->fetchAll(PDO::FETCH_ASSOC)) > 0) {
               $this->deleteFavorite($data);
            }else {
                $query->execute();
                $this->fetchUserFavorits();
            }

            $this->db->dbCon->commit();

        }catch (Exception $e) {
            $this->db->dbCon->rollBack();
            $this->message = $e->getMessage();
        }

    }

    public function deleteFavorite($data) {
        try {
            $query = $this->db->dbCon->prepare("DELETE FROM `favourite_products`
                                                      WHERE userID = :userID AND productID = :productID");

            $query->bindValue(":userID", $data['userID']);
            $query->bindValue(":productID", $data['productID']);
            $query->execute();
            $this->fetchUserFavorits();


        }catch (Exception $e) {
            $this->message = $e->getMessage();
        }

    }

    public function fetchUserFavorits() {

            try {
                if(isset($_SESSION['userID'])) {
                    $query = $this->db->dbCon->prepare("SELECT productID FROM `favourite_products` WHERE userID = :userID");
                    $query->bindValue(':userID',$_SESSION['userID'] );

                    $query->execute();
                    $result = $query->fetchAll(PDO::FETCH_ASSOC);
                    $_SESSION['userFavorites'] = $result;
                }

            }catch (Exception $e) {
                $this->message = $e->getMessage();
            }
        }


}