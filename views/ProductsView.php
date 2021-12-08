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
                        <div class="chip-container filter-chip">
                            <label class="filter-chip filter-view-chip" for="<?php echo
                            $category['name']?>"> <?php
                                echo
                                $category['name'] ?>
                                <input  class="filter-checkbox-chip" type="checkbox" id="<?php echo $category['name']?>"
                                        name ='category' value="<?php echo $category['categoryID'] ?>">
                            </label>
                        </div>
                        <?php endforeach; ?>
                    <?php endif;?>
                </div>
            </div>
        </div>
    </div>
    <div class="products-wrapper">

    </div>
    <?php include_once "./components/contactForm.php"?>
</div>
<?php include_once "./components/baseFooter.php"?>




