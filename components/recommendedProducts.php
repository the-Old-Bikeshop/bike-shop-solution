<?php
$product = new ProductsController();
?>

<div class="suggested-products-wrapper">
    <div class="suggested-products-heading-wrapper">
        <div class="suggested-products-heading-icon">
            <i class="las la-pepper-hot"></i>
        </div>
        <h2 class="suggested-products-heading">Because you looked at : <?php echo $product->getOneProduct
            ($_GET['id'])['name'];
            ?></h2>
    </div>
    <div class="suggested-products-container">
        <?php foreach ($product->getRecommendation($_GET['id']) as $prod):?>
            <div class="suggested-product">
                <a href="/bike-shop-solution/product?id='<?php echo $prod['productID']  ?>'"
                   class="product-card-link">
                    <div class="product-image">
                        <img
                                src="<?php echo  $prod['URL'] ?>"
                                alt="<?php echo  $prod['alt'] ?>"">
                    </div>
                    <div class="bottom-product-info-wrapper">
                        <p class="product-name"><?php echo  $prod['name']?></p>
                        <p class="product-price"><?php echo  $prod['price']?></p>
                    </div>
                </a>
            </div>
        <?php endforeach; ?>
    </div>
</div>