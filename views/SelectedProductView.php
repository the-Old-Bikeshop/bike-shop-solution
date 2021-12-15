<?php
$product = new ProductsController();
$selectedProductID = $_GET['id'];

$basket = new BasketController();
$basket->addToBasket();

//
//$recomended = new RecommendedProducts();
//$recomended_products = $recomended->fetchRecommendedProducts($selectedProductID);
//var_dump($recomended_products);

?>

<?php include_once "./components/customerNavigation.php"?>
<div class="selected-product-page-wrapper">
    <div class="selected-product-base-information">
        <div class="selected-product-image-wrapper">
            <?php $img = $product->getProductWithImage($selectedProductID) ?>
            <img class="selected-product-image"
                 src="<?php echo  $img['URL'] ?>"
                 alt="<?php echo  $img['alt'] ?? $img['URL'] ?>"">
        </div>
        <div class="selected-product-information-wrapper">
            <div class="selected-product-information-container">
                <?php $product = $product->getOneProduct($selectedProductID); ?>
                <h1 class="selected-product-information-heading"><?php echo $product['name'] ?></h1>
                <div class="selected-product-specifications-wrapper">
                    <div class="selected-product-specifications-item">
                        <div class="selected-product-specifications-item-label-wrapper">
                            <div class="selected-product-specifications-item-icon">
                                <i class="las la-weight-hanging"></i>
                            </div>
                        </div>
                        <h1 class="selected-product-specifications-item-value"><?php echo $product['weight'] ?>kg</h1>
                    </div>
                    <div class="selected-product-specifications-item">
                        <div class="selected-product-specifications-item-label-wrapper">
                            <div class="selected-product-specifications-item-icon">
                                <i class="las la-ruler"></i>
                            </div>
                        </div>
                        <h1 class="selected-product-specifications-item-value"><?php echo $product['length']?>cm</h1>
                    </div>
                    <div class="selected-product-specifications-item">
                        <div class="selected-product-specifications-item-label-wrapper">
                            <div class="selected-product-specifications-item-icon">
                                <i class="las la-palette"></i>
                            </div>
                        </div>
                        <h1 class="selected-product-specifications-item-value-color"><?php echo $product['color'] ?></h1>
                    </div>
                    <div class="selected-product-specifications-item">
                        <div class="selected-product-specifications-item-label-wrapper">
                            <div class="selected-product-specifications-item-icon">
                                <i class="las la-bicycle"></i>
                            </div>
                        </div>
                        <h1 class="selected-product-specifications-item-value">28"</h1>
                    </div>
                </div>
            </div>
            <div class="selected-product-action-nav-wrapper">
                <div class="selected-product-price-wrapper">
                    <h1 class="selected-product-price-value"><?php echo $product['price'] ?>DKK</h1>
                </div>
                <div class="selected-product-action-nav-items-wrapper">
                    <form class="selected-product-action-nav-items-form" action="" method="post">
                        <input class="action-nav-item-add-to-basket" value="Add to basket" name="add" type="submit">
                        <input id="productID" type="hidden" value="<?php echo $product['productID'] ?>" name="productID"> 
                        <input id="name" type="hidden" value="<?php echo $product['name'] ?>" name="name">
                        <input id="quantity" type="hidden" value="1" name="quantity">
                        <input id="price" type="hidden" value="<?php echo $product['price'] ?>" name="price">
                        <input id="discount" type="hidden" value="0" name="discount">
                        <div  class="action-nav-item-add-to-favourites">
                            <i class="las la-heart"></i>
                            <input class="action-nav-item-add-to-favourites-input" type="submit">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="selected-product-secondary-information">
        <div class="selected-product-secondary-information-wrapper">
            <h1 class="selected-product-secondary-information-description-label">Description</h1>
            <p class="selected-product-secondary-information-description">
                <?php echo $product['description'] ?>
            </p>
        </div>
    </div>
    <?php include_once "./components/assuranceBanner.php"?>
</div>
<?php include_once "./components/baseFooter.php"?>




