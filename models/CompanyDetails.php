<?php

spl_autoload_register(function($class_name) {

    // Define an array of directories in the order of their priority to iterate through.
    $dirs = array(
        'models/',
        'controllers/',
    );

    // Looping through each directory to load all the class files. It will only require a file once.
    // If it finds the same class in a directory later on, IT WILL IGNORE IT! Because of that require once!
    foreach( $dirs as $dir ) {
        if (file_exists($dir . $class_name . '.php')) {
            require_once( $dir . $class_name . '.php');
            return;
        }
    }
});

class CompanyDetails
{
    private $db;
    public $message = "";


    public function __construct()
    {
        $this->db = new DBcon();
    }

    public function createCompanyDetails($data) {

        //CREATE TABLE `company_details` (
        //company_detailsID INT NOT NULL Primary Key AUTO_INCREMENT,
        //    company_description TEXT,
        //    opening_hours VARCHAR(100),
        //    mission TEXT,
        //    vision TEXT,
        //    STATEMENT TEXT,
        //    phone VARCHAR(20),
        //    address VARCHAR(255),
        //    email VARCHAR(150),
        //    instagram VARCHAR(100)
        //);



        $query=$this->db->dbCon->prepare("INSERT INTO `company_details` (
                               company_description,
                               opening_hours,
                               mission ,
                               vision,
                               statement,
                               phone,
                               address,
                               email,
                               instagram) 
                               VALUES (
                                       :company_description,
                                       :opening_hours,
                                       :mission ,
                                       :vision,
                                       :statement,
                                       :phone,
                                       :address,
                                       :email,
                                       :instagram
                                       
                               )" );

        $query->bindValue(':company_description', $data['company_description']);
        $query->bindValue(':opening_hours', $data['opening_hours']);
        $query->bindValue(':mission', $data['mission']);
        $query->bindValue(':vision', $data['vision']);
        $query->bindValue(':statement', $data['statement']);
        $query->bindValue(':phone', $data['phone']);
        $query->bindValue(':address', $data['address']);
        $query->bindValue(':email', $data['email']);
        $query->bindValue(':instagram', $data['instagram']);


        if($query->execute()) {
            $this->message = "New company details added to the database";
        } else{
            $this->message = "Something went wrong";
        }
    }

    public function fetchOneCompanyDetail($id) {
        $query = $this->db->dbCon->prepare("SELECT * FROM `company_details` WHERE `company_detailsID` = $id ");
        if($query->execute()) {
            $result = $query->fetch(PDO::FETCH_ASSOC);
            return $result;
        } else {
            return "ERROR: The database could not be reached";
        }

    }


    public function fetchAllCompanyDetails() {
        $query = $this->db->dbCon->prepare("SELECT * FROM `company_details`");
        if($query->execute()) {
            $result = $query->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        } else {
            return "ERROR: The database could not be reached";
        }

    }



    public function updateCompanyDetails($data, $id) {

        $query=$this->db->dbCon->prepare("UPDATE `company_details` SET 
                               `company_description` = :company_description,
                               `opening_hours` = :opening_hours,
                               `mission` = :mission,
                               `vision` =  :vision,
                               `statement` = :statement,
                               `phone` = :phone,
                               `address` = :address,
                               `email` = :email,
                               `instagram` = :instagram
                               WHERE company_detailsID = $id" );

        $query->bindValue(':company_description', $data['company_description']);
        $query->bindValue(':opening_hours', $data['opening_hours']);
        $query->bindValue(':mission', $data['mission']);
        $query->bindValue(':vision', $data['vision']);
        $query->bindValue(':statement', $data['statement']);
        $query->bindValue(':phone', $data['phone']);
        $query->bindValue(':address', $data['address']);
        $query->bindValue(':email', $data['email']);
        $query->bindValue(':instagram', $data['instagram']);


        if($query->execute()) {
            $this->message = "New company details updated to the database";
        } else{
            $this->message = "Something went wrong";
        }

    }

    public function deleteCompanyDetails($id) {
            $query = $this->db->dbCon->prepare("DELETE FROM `company_details` WHERE company_detailsID = $id");

            if($query->execute()) {
                $this->message="deleted";

            }else {
                $this->message="something went wrong";
            }
    }


}