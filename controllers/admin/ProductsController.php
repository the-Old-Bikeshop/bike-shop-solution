<?php

spl_autoload_register(function($class_name) {

    // Define an array of directories in the order of their priority to iterate through.
    $dirs = array(
        'models/',
        'controllers/',
        'controllers/admin/',
    );

    // Looping through each directory to load all the class files. It will only require a file once.
    // If it finds the same class in a directory later on, IT WILL IGNORE IT! Because of that require once!
    foreach( $dirs as $dir ) {
        if (file_exists($dir . $class_name .'.php')) {
            require_once($dir . $class_name.'.php');
            return;
        }
    }
});



class ProductsController extends
    ViewController
{
    private $products;
    private $product;
    private $update;
    private $product_info;
    private $imageController;
    private $image;
    private $imageID;
    private $productID;
    private $productImage;

    public function __construct()
    {
        $this->update = false;
        $this->products = new Product();
        $this->imageController = new ImageController();
        $this->productImage = new ProductImage();
        $this->image = new Image();


    }

    public function setProduct(): void
    {

        if (isset($_POST['submit-new'])) {
            $this->setData();
            $this->imageController->setData();
            $this->image = new Image();
            $this->imageID = $this->image->createImage($this->imageController->getData());
            $this->products = new Product();
            $this->productID = $this->products->createProduct($this->product_info);
            $this->productImage->createProductImage($this->productID, $this->imageID);

        } elseif (isset($_POST['update'])) {
            $this->categories = new Product();
            $this->update = true;
            $this->product = $this->products->fetchOne('product', 'productID', $_POST['productID'] );
        } elseif (isset($_POST['submit-update'])) {
            $this->products = new Product();
            $this->setData();
            $this->products->updateProduct($this->product_info,
                $_POST['productID']);
        } elseif (isset($_POST['delete'])) {
            $this->products = new Product();
            $this->products->deleteRow('product', 'productID', $_POST['productID']);
        } elseif (isset($_POST['addNewImage'])) {
            $this->image = new Image();
            $this->imageController->setData();
            $this->imageID = $this->image->createImage($this->imageController->getData());
            $this->productImage->createProductImage($_POST['productID'], $this->imageID);
        }elseif (isset($_POST['deleteImage'])) {
            $this->productImage->deleteImage($_POST['deleteImageID'], $_POST['deleteProductID']);
        }
    }

    public function setData(): void {

        $_POST = filter_input_array(INPUT_POST,
            FILTER_SANITIZE_STRING);

        $product_info = [
            'name' => trim($_POST['product_name']) ?? "",
            'description' => trim($_POST['description']) ?? "",
            'short_description' => trim($_POST['short_description']) ?? "",
            'weight' => trim($_POST['weight']) ?? "",
            'price' => trim($_POST['price']) ?? "",
            'model_name' => trim($_POST['model_name']) ?? "",
            'stock' => trim($_POST['stock']) ?? "",
            'length' => trim($_POST['length']) ?? "",
            'color' => trim($_POST['color']) ?? "",
            'bike_specificationsID' => trim($_POST['bike_specificationsID']) ?? "",
            'brandID' => trim($_POST['brandID']) ?? "",
            'created_by' => trim($_POST['created_by']) ?? "",
        ];
        $this->product_info = $product_info;
    }

    //CREATE TABLE product (
    //    productID INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    //  `name` VARCHAR(100) NOT NULL,
    //  `description` TEXT,
    //  short_description VARCHAR(255),
    //  `weight` DECIMAL(10, 2),
    //  price DECIMAL(10, 2) NOT NULL,
    //  model_name VARCHAR(255) NOT NULL,
    //  stock INT NOT NULL,
    //  `length` DECIMAL(10, 2),
    //  color VARCHAR(100),
    //  bike_specificationsID INT,
    //  brandID INT,
    //  created_by INT NOT NULL,
    //  FOREIGN KEY (bike_specificationsID) REFERENCES bike_specifications (bike_specificationsID),
    //  FOREIGN KEY (brandID) REFERENCES brand (brandID),
    //  FOREIGN KEY (created_by) REFERENCES `user` (userID)
    //);

    /**
     * @return mixed
     */
    public function getProduct()
    {
        return $this->product;
    }

    /**
     * @return mixed
     */
    public function getUpdate()
    {
        return $this->update;
    }

    /**
     * @return mixed
     */
    public function getProducts()
    {
        return $this->products;
    }

    /**
     * @return Image
     */
    public function getImage(): Image
    {
        return $this->image;
    }

    /**
     * @return ProductImage
     */
    public function getProductImage(): ProductImage
    {
        return $this->productImage;
    }

}