<?php





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
    private $like;
    private $message;

    public function __construct()
    {
        $this->update = false;
        $this->products = new Product();
        $this->imageController = new ImageController();
        $this->productImage = new ProductImage();
        $this->image = new Image();
        $this->like = new FavoriteProductsController();



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
//        }elseif (isset($_POST['like'])) {
//            if (!isset($_POST['userID'])) {
//                $this->message = 'Login to add product to favorite';
//            }else{
//                $this->like->setData();
//                $this->like->likeAction();
//            }

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
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @return FavoriteProductsController
     */
    public function getLike(): FavoriteProductsController
    {
        return $this->like;
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

    public function getFavProducts() {
        return $this->like->getFavs();
    }

    public function getAllProducts() {
        return $this->products->fetchAll('product');
    }

    public function getOneBikeSpecificationType($id) {
        return $this->products->fetchOne('bike_specifications', 'bike_specificationsID', $id)['type'];
    }

    public function getOneBrandName($id) {
        return $this->products->fetchOne('brand', 'brandID', $id) ['name'];
    }

    public function getOneImage($id) {
        return $this->products->fetchOne('image', 'imageID', $id);
    }

    public function getAllBrands() {
        return $this->products->fetchAll('brand');
    }

    public function getAllBikeSpecifications() {
        return $this->products->fetchAll('bike_speks');
    }

}