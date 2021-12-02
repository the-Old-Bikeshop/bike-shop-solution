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
                    <div class="filter-view-chip">
                        bikes
                    </div>
                    <div class="filter-view-chip">
                        accessories
                    </div>
                    <div class="filter-view-chip">
                        fixed-gear
                    </div>
                    <div class="filter-view-chip">
                        city bikes
                    </div>
                    <div class="filter-view-chip">
                        affordable
                    </div>
                    <div class="filter-view-chip">
                        custom
                    </div>
                    <div class="filter-view-chip">
                        bikes
                    </div>
                    <div class="filter-view-chip">
                        accessories
                    </div>
                    <div class="filter-view-chip">
                        fixed-gear
                    </div>
                    <div class="filter-view-chip">
                        city bikes
                    </div>
                    <div class="filter-view-chip">
                        affordable
                    </div>
                    <div class="filter-view-chip">
                        custom
                    </div>
                </div>
            </div>
            <div class="wheel-sizes-filter-wrapper">
                <h2 class="filter-wrapper-heading">Wheel Sizes</h2>
                <div class="filter-view-chips-wrapper">
                    <div class="filter-view-chip">
                        28''
                    </div>
                    <div class="filter-view-chip">
                        26''
                    </div>
                    <div class="filter-view-chip">
                        24''
                    </div>
                    <div class="filter-view-chip">
                        21''
                    </div>
                    <div class="filter-view-chip">
                        28''
                    </div>
                    <div class="filter-view-chip">
                        28''
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="products-wrapper">
    <?php foreach ($product->getAllProducts() as $res): ?>
        <div class="product-card">
            <a href="" class="product-card-link">
                <div class="product-image">
                    <!-- product image goes here -->
                </div>
                <div class="bottom-product-info-wrapper">
                    <p class="product-name"><?php echo $res['name']?></p>
                    <p class="product-price"><?php echo $res['price']?></p>
                </div>
            </a>
        </div>
    <?php endforeach ?>
    </div>
    <?php include_once "./components/contactForm.php"?>
</div>
<?php include_once "./components/baseFooter.php"?>




