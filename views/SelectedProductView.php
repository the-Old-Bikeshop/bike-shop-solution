<?php
$product = new ProductsController();
$product->setProduct();
?>

<?php include_once "./components/customerNavigation.php"?>
<div class="selected-product-page-wrapper">
    <div class="selected-product-base-information">
            <?php $url = $product->getOneProduct('1'); ?>
                                        
                                    <?php echo $url; ?>
        <div class="selected-product-image-wrapper">
            <img class="selected-product-image" src="/bike-shop-solution/public/img/bike.png" alt="">
        </div>
        <div class="selected-product-information-wrapper">
            <div class="selected-product-information-container">
                <h1 class="selected-product-information-heading">Some bike</h1>
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
                        <h1 class="selected-product-specifications-item-value">5.00 kg</h1>
                    </div>
                    <div class="selected-product-specifications-item">
                        <div class="selected-product-specifications-item-label-wrapper">
                            <div class="selected-product-specifications-item-icon">
                                <i class="las la-weight-hanging"></i>
                            </div>
                        </div>
                        <h1 class="selected-product-specifications-item-value">5.00 kg</h1>
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
                    <h1 class="selected-product-price-value">244 DKK</h1>
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
               Lorem ipsum dolor sit, amet consectetur adipisicing elit.
               Minima quae facilis provident consectetur, maxime numquam 
               asperiores odio explicabo ex itaque iure natus quo a sequi 
               magni et excepturi obcaecati tenetur?
            </p>
        </div>
        <div class="selected-product-assurance-wrapper">
            <?php include_once "./components/assuranceBanner.php"?>
        </div>
    </div>
</div>
<?php include_once "./components/baseFooter.php"?>




