<?php
$home = new HomeController();
?>
<div class="suggested-products-wrapper">
    <div class="suggested-products-heading-wrapper">
        <div class="suggested-products-heading-icon">
            <i class="las la-pepper-hot"></i>
        </div>
        <h2 class="suggested-products-heading">Hot ones, available now!</h2>
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