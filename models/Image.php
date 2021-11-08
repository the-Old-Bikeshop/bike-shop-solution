<?php

class Image extends BasisSQL
{


    public $message = "";
    public $last_id;


    public function createImage($data) {
        try {

            $query = $this->db->dbCon->prepare("INSERT INTO `image` (name, URL, alt) VALUES (:name, :URL , :alt)");

            $query->bindValue(':name', $data['name']);
            $query->bindValue(':URL', $data['URL']);
            $query->bindValue(':alt', $data['alt']);
            $this->db->dbCon->beginTransaction();
            $query->execute();

            $this->last_id = $this->db->dbCon->lastInsertId();
            $this->db->dbCon->commit();;
            return $this->last_id;

        }
        catch (Exception $e) {
            $this->db->dbCon->rollBack();
          $this->message = $e->getMessage();
        }

    }

    public function updateImage($data) {

        $query = $this->db->dbCon->prepare("UPDATE `image` SET name = :name, URL = :URL, alt = :alt WHERE imageID = :id");

        $query->bindValue(':name', $data['name']);
        $query->bindValue(':URL', $data['URL']);
        $query->bindValue(':alt', $data['alt']);
        $query->bindValue(':id', $data['imageID']);

        try {
            $this->db->dbCon->beginTransaction();
            $query->execute();
            $this->db->dbCon->commit();
            $this->last_id = $this->db->dbCon->lastInsertId();

        }
        catch (Exception $e) {
            $this->db->dbCon->rollBack();
            $this->message = $e->getMessage();
        }

    }


}