<?php

 const DB_SERVER = 'localhost';
 const DB_USER = 'root';
 const DB_PASSWORD = 'root';
 const DB_DATABASE = 'bikeshop';

 $dbCon = null;
 $message = '';

    $dbCon = new PDO("mysql:host=" .DB_SERVER ."; dbname=" .DB_DATABASE ."; charset=utf8", DB_USER, DB_PASSWORD);
    $dbCon->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    try {
        $dbCon->beginTransaction();
        $output = '';

        $query = "SELECT DISTINCT * FROM `simple_product_with_image`";


        if(isset($_POST['category'])) {

                $category_str = implode("','", $_POST['category']);
                $catQuery = "SELECT DISTINCT `productID` FROM `product_has_category` 
                    WHERE categoryID IN ('".$category_str."')";

                $cat_st = $dbCon->prepare($catQuery);
                $cat_st->execute();

                $productIDlist = $cat_st->fetchAll(PDO::FETCH_ASSOC);
                $productIDsrt = implode("','", array_column($productIDlist, 'productID'));

                $query = "SELECT DISTINCT * FROM `simple_product_with_image` 
                    WHERE `productID` IN ('".$productIDsrt."')";
                $statement = $dbCon->prepare($query);

                $statement->execute();
                $result = $statement->fetchAll(PDO::FETCH_ASSOC);

                $total_Rows = $statement->rowCount();

//                $dbCon->commit();

                if($total_Rows > 0) {
                    foreach ($result as $row) {
                        $output .='
                         <div class="product-card">
                            <a href="/bike-shop-solution/product?id='.$row['productID'] .'" class="product-card-link">
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
        $stm = $dbCon->prepare($query);
        $stm->execute();
        $result = $stm->fetchAll(PDO::FETCH_ASSOC);
        $dbCon->commit();
        $output="";
        if($stm->rowCount()>0) {
            foreach ($result as $row) {
                $output .='
                         <div class="product-card">
                            <a href="/bike-shop-solution/product?id='.$row['productID'] .'" class="product-card-link">
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
            echo $output;
        }


    }catch (Exception $e) {
        $dbCon->rollBack();
        $message = $e;


}