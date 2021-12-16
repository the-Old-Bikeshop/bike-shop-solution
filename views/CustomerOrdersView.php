<?php
$order = new OrderController();
$order->setOrders();

?>

<?php include_once "./components/customerNavigation.php"?>


<div class="page_wrapper ">
    <?php include_once "./components/customerAccountNav.php"?>
    <section class="admin_section_wrapper page_container">
        <div class="page_heading_wrapper">
            <h1 class="page_heading heading-one">
                Orders
            </h1>
        </div>
        <div class="page_content_wrapper">

                <?php foreach ($order->fetchSimpleOrderForUser() as $res): ?>

                    <div class="my-5 order-container py-5 px-3">
                        <h2 class="heading-two">Order Number: <?php echo $res["orderID"] ?>  </h2>
                        <div class="order__top-info my-3">
                            <div>
                                <h3>Date: </h3>
                                <p><?php echo $res['created_at']?></p>
                            </div>

                            <div>
                                <h3>Status: </h3>
                                <p><?php $order->getConvert()->orderStatus($res['status']);?></p>
                            </div>

                            <div>
                                <h3>Total Price: </h3>
                                <p><?php echo $res['total_price']?></p>
                            </div>

                        </div>
                        <div class="order__products">
                            <h3>Products:</h3>
                            <table class="order__products-table ">
                                <tbody>
                                <tr>
                                    <th>Name</th>
                                    <th>Quantity</th>
                                </tr>
                                <?php foreach ($order->fetchOrderProductList($res['orderID']) as $prod): ?>

                                <tr>
                                    <td class="order__products--name"><?php echo $prod['name']?></td>
                                    <td class="order__products--quantity"><?php echo $prod['quantity']?></td>
                                </tr>

                                <?php endforeach ?>

                                </tbody>

                            </table>
                        </div>
                    </div>

                <?php endforeach ?>
        </div>

    </section>
</div>
<?php include_once "./components/baseFooter.php"?>