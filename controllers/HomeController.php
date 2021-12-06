<?php

class HomeController extends ViewController {
    private $home;

    public function __construct() {
        $this->home = new Home();
    }

   public function getProductsWithLimit() {
      return $this->home->fetchAllLimit('simple_product_with_image', 5);
    }

    public function getAllProducts() {
       return $this->home->fetchAll('simple_product_with_image');
    }

   public function getPostsWithLimit() {
       return $this->home->fetchAllLimit('post', 10);
    }

}

?>
<!---------------------------------------------->
<!--use it at the top of the HomeView-->
<?php
//$home = new HomeController();
//$posts = $home->getPostsWithLimit();
//$products = $home->getProductsWithLimit();
//
//
//?>

<!-------------------------------------------------->
