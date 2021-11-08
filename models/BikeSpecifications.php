<?php

class BikeSpecifications extends BasisSQL
{

    public $message;


    public function createBikeSpecifications($data) {
        try {

            $query = $this->db->dbCon->prepare("INSERT INTO `bike_specifications` (
                                                                           type, 
                                                                           back_basket, 
                                                                           mudguards, 
                                                                           front_basket, 
                                                                           lights, 
                                                                           disk_brakes, 
                                                                           wheel_sizeID,
                                                                           braking_systemID,
                                                                           drive_typeID,
                                                                           created_by)
                                                                            VALUES (
                                                                                    :type, 
                                                                                   :back_basket, 
                                                                                   :mudguards, 
                                                                                   :front_basket, 
                                                                                   :lights, 
                                                                                   :disk_brakes, 
                                                                                   :wheel_sizeID,
                                                                                   :braking_systemID,
                                                                                   :drive_typeID,
                                                                                   :created_by)" );

            $query->bindValue(":type", $data['type']);
            $query->bindValue(":back_basket", $data['back_basket']);
            $query->bindValue(":mudguards", $data['mudguards']);
            $query->bindValue(":front_basket", $data['front_basket']);
            $query->bindValue(":lights", $data['lights']);
            $query->bindValue(":disk_brakes", $data['disk_brakes']);
            $query->bindValue(":wheel_sizeID", $data['wheel_sizeID']);
            $query->bindValue(":braking_systemID", $data['braking_systemID']);
            $query->bindValue(":drive_typeID", $data['drive_typeID']);
            $query->bindValue(":created_by", $data['created_by']);

            $query->execute();

        }catch (Exception $e) {
            $this->message = $e->getMessage();
        }


    }


//    public function fetchAllBikeSpecifications() {
//        $query = $this->db->dbCon->prepare("SELECT * FROM `bike_speks`");
//
//        try {
//            $query->execute();
//            $result = $query->fetchAll(PDO::FETCH_ASSOC);
//            return $result;
//
//
//        }catch (Exception $e) {
//            $this->message = $e->getMessage();
//        }
//        return "failled to reach database";
//
//    }
//    public function fetchOneBikeSpecification($id) {
//
//        $query = $this->db->dbCon->prepare("SELECT * FROM `bike_specifications` WHERE bike_specificationsID = :id");
//         $query->bindValue(':id',$id );
//
//        try {
//            $query->execute();
//            $result = $query->fetch(PDO::FETCH_ASSOC);
//            return $result;
//
//        }catch (Exception $e) {
//            $this->message = $e->getMessage();
//        }
//
//    }

    public function updateBikeSpecifications($data, $id) {





        try {

            $query= $this->db->dbCon->prepare("UPDATE `bike_specifications` 
                                                    SET 
                                                        type = :type, 
                                                        back_basket = :back_basket, 
                                                        mudguards = :mudguards, 
                                                        front_basket = :front_basket, 
                                                        lights = :lights, 
                                                        disk_brakes = :disk_brakes, 
                                                        wheel_sizeID = :wheel_sizeID,
                                                        braking_systemID = :braking_systemID,
                                                        drive_typeID = :drive_typeID,
                                                        created_by = :created_by
                                                    WHERE bike_specificationsID = :id");


            $query->bindValue(":type", $data['type']);
            $query->bindValue(":back_basket", $data['back_basket']);
            $query->bindValue(":mudguards", $data['mudguards']);
            $query->bindValue(":front_basket", $data['front_basket']);
            $query->bindValue(":lights", $data['lights']);
            $query->bindValue(":disk_brakes", $data['disk_brakes']);
            $query->bindValue(":wheel_sizeID", $data['wheel_sizeID']);
            $query->bindValue(":braking_systemID", $data['braking_systemID']);
            $query->bindValue(":drive_typeID", $data['drive_typeID']);
            $query->bindValue(":created_by", $data['created_by']);
            $query->bindValue(':id',$id );

            $query->execute();
            $this->message = "Product updated";

        }catch (Exception $e) {
            $this->message = $e->getMessage();

        }

    }

//    public function deleteBikeSpecifications($id) {
//
//        $query = $this->db->dbCon->prepare("DELETE FROM `bike_specifications` WHERE bike_specificationsID = :id");
//        $query->bindValue(':id',$id );
//
//        try {
//            $query->execute();
//            $result = $query->fetch(PDO::FETCH_ASSOC);
//            return $result;
//
//        }catch (Exception $e) {
//            $this->message = $e->getMessage();
//        }
//    }


}