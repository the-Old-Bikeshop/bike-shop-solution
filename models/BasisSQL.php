<?php
include_once "DBcon.php";

class BasisSQL {

    protected $db;
    public $message = "";


    public function __construct()
    {

        $this->db = new DBcon();


    }

    public function fetchAll($table)
    {
        try{
            $tbl = filter_var($table, FILTER_SANITIZE_STRING);
            $query = $this->db->dbCon->prepare("SELECT * FROM `{$tbl}`");
            $query->execute();
            $result = $query->fetchAll(PDO::FETCH_ASSOC);
            $this->message = "items fetched succesfully";
            return $result;

        }catch (Exception $e) {
            $this->message = $e;
        }
        return $this->message;

    }


    public function fetchOne($table,$col_id, $id)
    {
        try {
            $tbl = filter_var($table, FILTER_SANITIZE_STRING);
            $col = filter_var($col_id, FILTER_SANITIZE_STRING);
            $query = $this->db->dbCon->prepare("SELECT * FROM `{$tbl}` WHERE {$col} = :id");
            $query->bindValue(':id', $id);

            $query->execute();
            $result = $query->fetch(PDO::FETCH_ASSOC);
            return $result;

        }catch (Exception $e) {
            $this->message = $e->getMessage();
        }
        return "something went wrong";
    }

    public function deleteRow($table, $col_id, $id)
    {

        try {
            $tbl = filter_var($table, FILTER_SANITIZE_STRING);
            $col = filter_var($col_id, FILTER_SANITIZE_STRING);
            $query = $this->db->dbCon->prepare("DELETE FROM `{$tbl}` WHERE {$col} = :id");
            $query->bindValue(':id', $id);

            $query->execute();
            $this->message = "Item Deleted";

        }catch (Exception $e) {
            $this->message = $e->getMessage();
        }
        return "something went wrong";

    }

}