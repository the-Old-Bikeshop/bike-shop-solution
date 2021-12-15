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
                <div class="basket-product">
                    <div class="basket-product__image">

                        <?php $img = $product->getProductWithImage($item['productID']) ?>
                        <img
                                src="<?php echo  $img['URL'] ?>"
                                alt="<?php echo  $img['alt'] ?? $img['URL'] ?>""
                                width="150"
                                height="150">
                    </div>
                    <div class="basket-product__info">
                        <div class="basket-product-info__name">
                            <h2><?php echo $item['name'] ?></h2>
                        </div>
                        <div class="basket-product-info__math">

                                <div class="basket-product-info__gty">
                                    <label for="quantity">Qty</label>
                                    <input id="quantity" type="number" value="<?php echo $item['quantity'] ?>">
                                </div>

                            <div class="input-group">
                                <input type="text" class="form-control" value="<?php echo $item['quantity'] ?>">
                                <div class="input-group-append">
                                    <form action="" method="POST">
                                        <input type="hidden" name="index" value="<?php echo $key ?>">
                                        <input type="hidden" name="action" value="add">
                                        <button class="btn btn-outline-secondary" type="submit">+</button>
                                    </form>

                                    <form action="" method="POST">
                                        <input type="hidden" name="index" value="<?php echo $key ?>">
                                        <input type="hidden" name="action" value="retract">
                                        <button class="btn btn-outline-secondary" type="submit">-</button>
                                    </form>

                                </div>
                            </div>
                                <div class="basket-product-info__price">
                                    Price: <?php echo $item['price'] ?>
                                </div>



                        </div>

                    </div>
                </div>

                <?php endforeach; ?>


        </div>

    </div>

    <div class="basket-footer">
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
            <?php

            echo $price;
            ?>
        </div>

    </div>
    <?php else : ?>
        <h2>Your basket is empty</h2>

    <?php endif; ?>

</div>
