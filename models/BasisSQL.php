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
            return $result;

        }catch (Exception $e) {
            $this->message = $e;
        }
        return $this->message;
    }

    public function fetchAllLimit($table, $limit = 24)
    {
        try{
            $tbl = filter_var($table, FILTER_SANITIZE_STRING);
            $tblID = $tbl . "ID";
            $lim = intval($limit);
            $query = $this->db->dbCon->prepare("SELECT * FROM `{$tbl}` ORDER BY {$tblID} DESC LIMIT {$lim}");
            $query->execute();
            $result = $query->fetchAll(PDO::FETCH_ASSOC);
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
    }

    public function deleteRow($table, $col_id, $id)
    {

        try {
            $tbl = filter_var($table, FILTER_SANITIZE_STRING);
            $col = filter_var($col_id, FILTER_SANITIZE_STRING);
            $query = $this->db->dbCon->prepare("DELETE FROM `{$tbl}` WHERE {$col} = :id");
            $query->bindValue(':id', $id);

            $query->execute();

        }catch (Exception $e) {
            $this->message = $e->getMessage();
        }

    }

    public $productIDlist;

    public function fetchFilterProducts() {
        try {
            $this->db->dbCon->beginTransaction();
            $output = '';

            if(!isset($_POST['category'])) {
                $query = "SELECT DISTINCT * FROM `simple_product_with_image`";

                $stm = $this->db->dbCon->prepare($query);
                $stm->execute();
                $result = $stm->fetchAll(PDO::FETCH_ASSOC);
                $this->db->dbCon->commit();
                $output="";
                if($stm->rowCount()>0) {
                    foreach ($result as $row) {
                        $output .='
                     <div class="product-card">
                        <a href="" class="product-card-link">
                            <div class="product-image-banner">
                                <img
                                src="'.$row['URL'].'"
                                alt="'.$row['alt'] .'">
                            </div>
                            <div class="bottom-product-info-wrapper">
                                <p class="product-name" id="product-name">'. $row['name'] .'</p>
                                <p class="product-price" id="product-price">'.$row['price'] . '</p>
                            </div>
                        </a>
                    </div>';
                    }
                }
            }else{

                $category_str = implode("','", $_POST['category']);
                $catQuery = "SELECT DISTINCT `productID` FROM `product_has_category` 
                WHERE categoryID IN ('".$category_str."')";

                $cat_st = $this->db->dbCon->prepare($catQuery);
                $cat_st->execute();

                $this->productIDlist = $cat_st->fetchAll(PDO::FETCH_ASSOC);
                $productIDsrt = implode("','", array_column($this->productIDlist, 'productID'));

                $query = "SELECT DISTINCT * FROM `simple_product_with_image` 
                WHERE `productID` IN ('".$productIDsrt."')";
                $statement = $this->db->dbCon->prepare($query);

                $statement->execute();
                $result = $statement->fetchAll(PDO::FETCH_ASSOC);

                $total_Rows = $statement->rowCount();

                $this->db->dbCon->commit();

                if($total_Rows > 0) {
                    foreach ($result as $row) {
                        $output .='
                     <div class="product-card">
                        <a href="" class="product-card-link">
                            <div class="product-image-banner">
                                <img
                                src="'.$row['URL'].'"
                                alt="'.$row['alt'] .'">
                            </div>
                            <div class="bottom-product-info-wrapper">
                                <p class="product-name" id="product-name">'. $row['name'] .'</p>
                                <p class="product-price" id="product-price">'.$row['price'] . '</p>
                            </div>
                        </a>
                    </div>';

                    }

                }else {
                    return 'no result found';
                }
                echo $output;
            }


        }catch (Exception $e) {
            $this->db->dbCon->rollBack();
            $this->message = $e;

        }

    }

}

$filter = new BasisSQL();
$filter->fetchFilterProducts();


