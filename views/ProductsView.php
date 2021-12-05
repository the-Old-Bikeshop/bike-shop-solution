<?php
$product = new ProductsController();
$product->setProduct();
?>


<?php include_once "./components/customerNavigation.php"?>
<div class="products-view-wrapper">
    <div class="products-view-filtering-wrapper">
        <div class="filters-heading-wrapper">
            <div class="filtering-heading-container">
                <div class="filtering-icon">
                    <i class="las la-filter"></i>
                </div>
                <h1 class="filtering-heading">Filters</h1>
            </div>
            <div class="filtering-icon-control-wrapper">
                <i class="las la-angle-down"></i>
            </div>
        </div>
        <div class="filters-wrapper">
            <div class="categories-filter-wrapper">
                <h2 class="filter-wrapper-heading">Categories</h2>
                <div class="filter-view-chips-wrapper">
                    <?php if($product->getAllCategories() !== null): ?>
                        <?php foreach($product->getAllCategories() as $category):?>
                                <label class="filter-chip filter-view-chip" for="<?php echo $category['name']?>"> <?php
                                    echo
                                    $category['name'] ?> </label>
                                <input  class="filter-checkbox-chip" type="checkbox" id="<?php echo $category['name']?>"
                                        name ='category' value="<?php echo $category['categoryID'] ?>">
                          <?php endforeach; ?>
                    <?php endif;?>

                </div>
            </div>
<!--            <div class="wheel-sizes-filter-wrapper">-->
<!--                <h2 class="filter-wrapper-heading">Wheel Sizes</h2>-->
<!--                <div class="filter-view-chips-wrapper">-->
<!--                    <div class="filter-view-chip">-->
<!--                        28''-->
<!--                    </div>-->
<!--                    <div class="filter-view-chip">-->
<!--                        26''-->
<!--                    </div>-->
<!--                    <div class="filter-view-chip">-->
<!--                        24''-->
<!--                    </div>-->
<!--                    <div class="filter-view-chip">-->
<!--                        21''-->
<!--                    </div>-->
<!--                    <div class="filter-view-chip">-->
<!--                        28''-->
<!--                    </div>-->
<!--                    <div class="filter-view-chip">-->
<!--                        28''-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
        </div>
    </div>
    <div class="products-wrapper">
<!--                    <div class="bottom-product-info-wrapper">-->
<!--                        <p class="product-name" id="product-name">--><?php //echo $res['name']?><!--</p>-->
<!--                        <p class="product-price" id="product-price">--><?php //echo $res['price']?><!--</p>-->
<!--                    </div>-->
    </div>
<!--    <div class="products-wrapper">-->
<!--    --><?php //foreach ($product->getAllProducts() as $res): ?>
<!--        <div class="product-card">-->
<!--            <a href="" class="product-card-link">-->
<!--                <div class="product-image-banner">-->
<!--                    --><?php //foreach($product->getProducts()->fetchImageList($res['productID']) as $img): ?>
<!---->
<!--                    --><?php //$url = $product->getOneImage($img['imageID']); ?>
<!--                            <img-->
<!--                                src="--><?php //echo $res['URL'] ?? '/bike-shop-solution/public/img/product-placeholder.png' ?><!--"-->
<!--                                alt="--><?php //echo $url['alt'] ?? '' ?><!--"-->
<!--                            >-->
<!--                    --><?php //endforeach; ?>
<!--                </div>-->
<!--                <div class="bottom-product-info-wrapper">-->
<!--                    <p class="product-name" id="product-name">--><?php //echo $res['name']?><!--</p>-->
<!--                    <p class="product-price" id="product-price">--><?php //echo $res['price']?><!--</p>-->
<!--                </div>-->
<!--            </a>-->
<!--        </div>-->
<!--    --><?php //endforeach ?>
<!--    </div>-->
    <?php include_once "./components/contactForm.php"?>
</div>
<?php include_once "./components/baseFooter.php"?>




