<?php

class Comment extends
    BasisSQL
{

    public function createComment($data) {
        try {
            $query = $this->db->dbCon->prepare("INSERT INTO `comment` (title, content, userID, postID) 
                                                                            VALUES(:title, :content, :userID, :postID) ");

            $query->bindValue(':title', $data['title']);
            $query->bindValue(':content', $data['content']);
            $query->bindValue(':userID', $data['userID']);
            $query->bindValue(':postID', $data['postID']);
            $query->execute();

        }catch (Exception $e) {
            $this->message = $e->getMessage();
        }
    }
    public function updateComment ($data, $id) {
        try {

            $query = $this->db->dbCon->prepare("UPDATE `comment` SET `title` = :title, `content` = :content, `userID` = :userID, `postID` = :postID 
                                                                            WHERE `commentID` = :commentID ");


            $query->bindValue(':title', $data['title']);
            $query->bindValue(':content', $data['content']);
            $query->bindValue(':userID', $data['userID']);
            $query->bindValue(':postID', $data['postID']);
            $query->bindValue(':commentID', $id);
            $query->execute();

        }catch (Exception $e) {
            $this->message = $e->getMessage();
        }
    }

}