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

class CompanyDetails extends BasisSQL
{

    public $message = "";


    public function createCompanyDetails($data) {




        try {
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
            $query->execute();

        }catch (Exception $e) {
            $this->message = $e->getMessage();
        } finally {
        }

    }


    public function updateCompanyDetails($data, $id) {

        try {
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
            $query->execute();

        }catch (Exception $e) {
            $this->message = $e->getMessage();
        } finally {
        }

    }
}




