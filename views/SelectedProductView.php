<?php
$product = new ProductsController();
?>

<?php include_once "./components/customerNavigation.php"?>
<div class="selected-product-page-wrapper">
    <div class="selected-product-base-information">
        <div class="selected-product-image-wrapper">
            <img class="selected-product-image" src="/bike-shop-solution/public/img/bike.png" alt="">
        </div>
        <div class="selected-product-information-wrapper">
            <div class="selected-product-information-container">
                <?php $product = $product->getOneProduct('1'); ?>
                <h1 class="selected-product-information-heading"><?php echo $product['name'] ?></h1>
                <h2 class="selected-product-category">fixed-gear</h2>
                <!-- <div class="product-category-chips-container">
                    <div class="product-chip">
                        cheap-transportation
                    </div>
                    <div class="product-chip">
                        city-bike
                    </div>
                    <div class="product-chip">
                        green-world
                    </div>
                </div> -->
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
                    <form class="selected-product-action-nav-items-form" action="">
                        <input class="action-nav-item-add-to-basket" value="Add to basket" type="submit">
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
        <div class="suggested-products-wrapper">
            <div class="suggested-products-heading-wrapper">
                <div class="suggested-products-heading-icon">
                    <i class="las la-pepper-hot"></i>
                </div>
                <h2 class="suggested-products-heading">Woth checking out!</h2>
            </div>
            <div class="suggested-products-container">
                <?php foreach ($home->getProductsWithLimit() as $product):?>
                    <div class="suggested-product">
                        <a href="" class="product-card-link">
                            <div class="product-image">
                                <img
                                        src="<?php echo  $product['URL'] ?>"
                                        alt="<?php echo  $product['alt'] ?>"">
                            </div>
                            <div class="bottom-product-info-wrapper">
                                <p class="product-name"><?php echo  $product['name']?></p>
                                <p class="product-price"><?php echo  $product['price']?></p>
                            </div>
                        </a>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
    <?php include_once "./components/assuranceBanner.php"?>
</div>
<?php include_once "./components/baseFooter.php"?>




