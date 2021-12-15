<?php

$product = new ProductsController();
$bask = new BasketController();
$bask->quantityAction();
$price = 0;
$subtotal = 0;
$delivery = 0;

if(isset($_SESSION['basket'])) {
    foreach ($_SESSION['basket'] as $item) {
        $subtotal += (intval($item['price']) - intval(intval($item['price']) * intval($item['discount']) / 100)) * intval($item['quantity']);
    }
}

$price = $subtotal + $delivery;

?>

<div class="basket">
    <?php if(count($_SESSION['basket']) > 0) :  ?>
    <div class="product-container">
        <div class="product-wrapper">
            <!--            loop start here-->
                <?php foreach ($_SESSION['basket'] as $key=>$item): ?>
                <div class="basket-product-wrapper">
                    <div class="basket-product-image-wrapper">
                        <?php $img = $product->getProductWithImage($item['productID']) ?>
                        <img
                            src="<?php echo  $img['URL'] ?>"
                            alt="<?php echo  $img['alt'] ?? $img['URL'] ?>""
                            class="basket-product-image"
                        >
                    </div>
                    <div class="basket-product-info-wrapper">
                        <h2 class="basket-product-name"><?php echo $item['name'] ?></h2>
                        <div class="basket-product-info-quantity-wrapper">
                            <div class="input-group">
                                <input style="height:3rem;" type="number" class="form-control" value="<?php echo $item['quantity'] ?>">
                                <div class="input-group-append">
                                    <form action="" method="POST">
                                        <input type="hidden" name="index" value="<?php echo $key ?>">
                                        <input type="hidden" name="action" value="add">
                                        <button style="height:3rem; width:3rem !important;" class="btn btn-outline-secondary" type="submit">+</button>
                                    </form>
                                    <form action="" method="POST">
                                        <input type="hidden" name="index" value="<?php echo $key ?>">
                                        <input type="hidden" name="action" value="retract">
                                        <button style="height:3rem; width:3rem !important;" class="btn btn-outline-secondary" type="submit">-</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="basket-product-price">
                             <?php echo $item['price'] ?>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
        </div>
    </div>
    <div class="basket-footer-wrapper">
        <div class="delivery">
            Delivery : <?php echo $delivery ?>
        </div>
        <div class="subtotal">
            Subtotal: <?php echo $price - $price*75/100 ?>
        </div>
        <div class="tax">
            Tax: <?php echo $price - $price*25/100 ?>
        </div>
        <div class="totalPrice">
            Total: <?php echo $price; ?>
        </div>
    </div>
    <?php else : ?>
        <h2>Your basket is empty</h2>
    <?php endif; ?>
</div>
