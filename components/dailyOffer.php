<?php

$product = new ProductsController()?>

<div class="suggested-products-wrapper">
    <div class="suggested-products-heading-wrapper">
        <div class="suggested-products-heading-icon">
            <i class="las la-pepper-hot"></i>
        </div>
        <h2 class="suggested-products-heading">Only today:</h2>
    </div>
    <div class="suggested-products-container">
        <?php foreach ($product->getDailyOffer() as $prod):?>

            <div class="recommended-product">
                <a href="/bike-shop-solution/product?id='<?php echo $prod['productID']  ?>'"
                   class="product-card-link d-flex">
                    <div class="product-image">
                        <?php $img = $product->getProductWithImage($prod['productID']) ?>
                            <img
                                src="<?php echo  $img['URL'] ?>"
                                alt="<?php echo  $img['alt'] ?? $img['URL'] ?>"">
                    </div>
                    <div class="bottom-product-info-wrapper row">
                        <p class="product-name col col-12"><?php echo  $prod['name']?></p>
                        <p class="product-name col col-12">Standard price: <?php echo  $prod['price']?></p>
                        <p class="product-price col col-12">Discount <?php echo  $prod['discount']?>%</p>
                        <p class="product-price col col-12">Final price: <?php echo  intval($prod['price']) -
                            intval(intval($prod['price'])* intval($prod['discount'])/100) ?></p>
                    </div>
                </a>
            </div>
        <?php endforeach; ?>
    </div>
</div>
