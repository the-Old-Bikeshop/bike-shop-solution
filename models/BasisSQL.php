<?php

class BasisSQL {

    private $db;
    public $message = "";


    public function __construct()
    {

        $this->db = new DBcon();

    }

    public function fetchAll($table) {

        $query = $this->db->dbCon->prepare("SELECT * FROM {$table}");
        $query->bindValue(':table', $table);
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

}