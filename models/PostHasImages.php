<?php

class PostHasImages extends
    BasisSQL
{
    public function createPostImage($postID, $imageID) {
        try {

            $query = $this->db->dbCon->prepare("INSERT INTO `post_has_images` (postID, imageID) 
                                                                        VALUES (:postID, :imageID)");
            $query->bindValue(':postID', $postID);
            $query->bindValue(':imageID', $imageID);

            $query->execute();

        }catch (Exception $e) {
            $this->message = $e->getMessage();
        }
    }

    public function deleteImage($imageID, $postID) {
        $this->db->dbCon->beginTransaction();
        try {

            $query = $this->db->dbCon->prepare("DELETE FROM `post_has_images` WHERE postID = :postID AND imageID = :imageID");


            $query->bindValue(':postID', $postID);
            $query->bindValue(':imageID', $imageID);
            $query->execute();
            $this->deleteRow('image', 'imageID', $imageID);
            $this->db->dbCon->commit();

        } catch (Exception $e) {
            $this->db->dbCon->rollBack();
            $this->message = $e->getMessage();
        }
    }

}