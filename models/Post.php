<?php

class Post extends
    BasisSQL
{


    public function createPost($data) {
        try {
            $query = $this->db->dbCon->prepare('INSERT INTO `post` (title, content, userID, productID) 
                                                VALUES (:title, :content, :userID, :productID)');

            $query->bindValue(':title', $data['title']);
            $query->bindValue(':content', $data['content']);
            $query->bindValue(':userID', $data['userID']);
            $query->bindValue(':productID', $data['productID']);

            $query->execute();

        }catch (Exception $e) {
            $this->message = $e->getMessage();
        }
    }

    public function updatePost($data, $id) {
        try {

        }catch (Exception $e) {
            $this->message = $e->getMessage();
        }
    }

    public function fetchImageList($id) {

        try {
            $query = $this->db->dbCon->prepare("SELECT `imageID` FROM `post_has_images` WHERE postID = :id");
            $query->bindValue(':id', $id);
            $query->execute();
            $result = $query->fetchAll(PDO::FETCH_ASSOC);
            return $result;

        } catch(Exception $e) {
            $this->message = $e->getMessage();
        }

    }


}