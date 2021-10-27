<?php

class Image
{

    private $db;
    private $basic;
    public $message = "";
    public $last_id;


    public function __construct()
    {
        $this->db = new DBcon();
        $this->basic = new BasisSQL();

    }

    public function createImage($data) {


        $query = $this->db->dbCon->prepare("INSERT INTO `image` (name, URL, alt) VALUES (:name, :URL , :alt)");

        $query->bindValue(':name', $data['name']);
        $query->bindValue(':URL', $data['URL']);
        $query->bindValue(':alt', $data['alt']);



        try {
            $this->db->dbCon->beginTransaction();
            $query->execute();
            $this->db->dbCon->commit();
            $this->last_id = $this->db->dbCon->lastInsertId();

        }
        catch (Exception $e) {
            $this->db->dbCon->rollBack();
          $this->message = $e;
        }

    }

     public function fetchAllImages() {

//          $this->basic->fetchAll(`image`);

         $query = $this->db->dbCon->prepare("SELECT * FROM `image`");
//         $query->bindValue(':table', $table);
         try{
             $query->execute();
             $result = $query->fetchAll(PDO::FETCH_ASSOC);
             $this->message = "items fetched succesfully";
             return $result;

         }catch (Exception $e) {
             $this->message = $e;
         }
         return $this->message;

     }

    public function fetchOneImage($id) {

    }

    public function updateImage($id) {

    }


    public function deleteImage($id) {

    }


}