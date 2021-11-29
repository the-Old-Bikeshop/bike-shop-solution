<?php

class Review extends
    BasisSQL
{

   public function createReview($data) {
        try{
            $query = $this->db->dbCon->prepare('INSERT INTO `review` 
                                                        (title, content, userID, rating, state) 
                                                        VALUES 
                                                               (:title, :content, :userID, :rating, :state)');

            $query->bindValue(':title', $data['title']);
            $query->bindValue(':content', $data['content']);
            $query->bindValue(':userID', $data['userID']);
            $query->bindValue(':state', $data['state']);
            $query->bindValue(':rating', $data['rating']);

            $query->execute();

        }catch (Exception $e) {
            $this->message = $e->getMessage();
        }
   }

    public function updateReview($data, $id) {
        try{
            $query = $this->db->dbCon->prepare('UPDATE `review` 
                                                        SET
                                                            `title` = :title, 
                                                            `content` = :content, 
                                                            `userID` = :userID, 
                                                            `state` = :state, 
                                                            `rating` = :rating 
                                                        WHERE 
                                                              reviewID = :reviewID');

            $query->bindValue(':title', $data['title']);
            $query->bindValue(':content', $data['content']);
            $query->bindValue(':userID', $data['userID']);
            $query->bindValue(':state', $data['state']);
            $query->bindValue(':rating', $data['rating']);
            $query->bindValue(':reviewID', $id);
            $query->execute();

        }catch (Exception $e) {
            $this->message = $e->getMessage();
        }
    }

}