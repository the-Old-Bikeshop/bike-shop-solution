<?php
$order = new OrderController();
$order->setOrders();

?>
<!---->
<!--//CREATE TABLE `order` (-->
<!--//orderID INT NOT NULL PRIMARY KEY AUTO_INCREMENT,-->
<!--//created_at  TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,-->
<!--//follow_up_date DATE,-->
<!--//`status` INT NOT NULL ,-->
<!--//payment_status INT NOT NULL,-->
<!--//total_price DECIMAL(10,2),-->
<!--//userID INT NOT NULL,-->
<!--//shippingID INT NOT NULL,-->
<!--//FOREIGN KEY (userID) REFERENCES `user` (userID),-->
<!--//FOREIGN KEY (shippingID) REFERENCES shipping (shippingID)-->
<!--//);-->



<div class="page_wrapper">
    <?php include_once "./components/adminNavigation.php"?>
    <section class="admin_section_wrapper">
        <div class="page_heading_wrapper">
            <h1 class="page_heading">
                Orders
            </h1>
            <button data-toggle="modal" data-target="#exampleModalCenter" style="height: 3rem;" type="button" class="btn btn-dark admin-main-button">
                Create New
            </button>
        </div>
        <div class="page_content_wrapper">
            <div class="card bg-light col-12 p-0">
                <table class="table table-sm col-12">
                    <thead class="thead-light">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Created at</th>
                        <th scope="col">product name</th>
                        <th scope="col">quantity</th>
                        <th scope="col">status</th>
                        <th scope="col">payment_status</th>
                        <th scope="col">total_price</th>
                        <th scope="col">userID</th>
                        <th scope="col">email</th>
                        <th scope="col">shippingID</th>
                        <th scope="col">Controls</th>
                    </tr>
                    </thead>
                    <tbody class="col-12">
                    <?php foreach ($order->getOrders()->fetchAll('order_view') as $res): ?>

                        <tr>
                            <th scope="row"> <?php echo $res["orderID"] ?></th>
                            <td><?php echo $res['created_at']?></td>
                            <td><?php echo $res['name']?></td>
                            <td><?php echo $res['quantity']?></td>
                            <td><?php $order->getConvert()->orderStatus($res['status']);?></td>
                            <td><?php $order->getConvert()->paymentStatus($res['payment_status']); ?></td>
                            <td><?php echo $res['total_price']?></td>
                            <td><?php echo $res['first_name'] . " " . $res['last_name'] ?></td>
                            <td><?php echo $res['email'] ?></td>
                            <td><?php echo $res['shipping']?></td>
                            <td>
                                <form action="" method="post" class="d-inline-block p-0 m-0">
                                    <input type="text" hidden name="orderID" value="<?php echo $res['orderID']
                                    ?>">
                                    <input type="submit" name="update" value="update" class="btn btn-outline-secondary btn-sm">
                                </form>
                                <form action="" method="post" class="d-inline-block p-0 m-0">
                                    <input type="text" hidden name="orderID" value="<?php echo $res['orderID'] ?>">
                                    <input type="submit" name="addProduct" value="Add product" class="btn
                                    btn-outline-secondary
                                    btn-sm" >
                                </form>
                                <form action="" method="post" class="d-inline-block p-0 m-0">
                                    <input type="text" hidden name="orderID" value="<?php echo $res['orderID']
                                    ?>">
                                    <input type="submit" name="delete" value="delete" class="btn btn-outline-danger btn-sm" onclick="return confirm('Delete! are you sure?')" >
                                </form>
                            </td>
                        </tr>
                    <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!--    display message-->

        <h3>
            <?php echo $order->getOrders()->message  ?>
        </h3>



        <!--    the form for creating and updating drive_type starts here-->
        <div class="modal fade <?php echo isset($_POST["update"]) ? 'show' : ' ' ?>" id="exampleModalCenter" tabindex="-1"
             role="dialog"
             aria-labelledby="exampleModalCenterTitle" aria-hidden="true"
            <?php echo isset($_POST["update"]) ? 'style = "display : block; overflow : scroll"' : 'style = "display : none"'?>>
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">
                            <?php echo !$order->getUpdate() ? "Create new" : "Update: " .
                                $order->getOrder()['orderID'];
                            ?>
                        </h5>
                        <form action="" method="post">
                            <button type="submit" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </form>
                    </div>
                    <div class="modal-body">
                        <form action="" method="post" class="col-12" id="form">
                            <div class="form-group col-12 mt-2">
                                <label for="total_price">total price</label>
                                <input type="text" class="form-control" id="total_price" name="total_price"
                                       placeholder="total price"
                                       value=" <?php echo $order->getOrder()['total_price'] ?? '' ?>"
                                >
                            </div>

                            <div class="column-form-item form-group col-12  mt-2">
                                <label for="shippingID" >Shipping method</label>
                                <select class="custom-select" id="shippingID" name="shippingID">
                                    <?php if ($order->getShipping() !== null) {
                                        foreach ($order->getShipping() as $shipping):?>
                                            <option value="<?php echo $shipping['shippingID'] ?? '' ?>"
                                                <?php if(!isset($shipping['shippingID']) && isset($order->getOrder()['oderID'])
                                                    && $shipping['shippingID'] ==
                                                    $order->getOrder()['orderID']):?>
                                                    selected
                                                <?php endif; ?>

                                            ><?php echo $shipping["name"] ?? ""?></option>

                                        <?php endforeach; ?>

                                    <?php }; ?>
                                </select>
                            </div>

                            <div class="column-form-item form-group col-12  mt-2">
                                <label for="status">Order status</label>
                                <select class="custom-select" id="status" name="status">
                                    <?php if ($order->getConvert()->getOrderStatus() !== null) : ?>
                                        <?php foreach ($order->getConvert()->getOrderStatus() as $status):?>
                                            <option value="<?php echo $status; ?>"
                                                <?php if(($order->getOrder()!==null) && $order->getConvert()
                                                        ->getOrderStatus() !== null &&
                                                    ($order->getOrder()['status'] == $status)):?>
                                                    selected
                                                <?php endif; ?>

                                            ><?php $order->getConvert()->orderStatus($status);?></option>

                                        <?php endforeach ;?>

                                    <?php endif ;?>
                                </select>
                            </div>

                            <div class="column-form-item form-group col-12  mt-2">
                                <label for="status" >Payment status</label>
                                <select class="custom-select" id="status" name="payment_status">
                                    <?php if ($order->getConvert()->getPaymentStatus() !== null) : ?>
                                        <?php foreach ($order->getConvert()->getPaymentStatus() as $payment):?>
                                            <option value="<?php echo $payment; ?>"
                                                <?php if(($order->getOrder()!==null) && $order->getConvert()
                                                        ->getPaymentStatus() !== null &&
                                                    ($order->getOrder()['payment_status'] == $payment)):?>
                                                    selected
                                                <?php endif; ?>

                                            ><?php $order->getConvert()->paymentStatus($payment);?></option>

                                        <?php endforeach ;?>

                                    <?php endif ;?>
                                </select>
                            </div>



                            <input type="hidden" name="userID" value="1">
                            <?php if(isset($order->getOrder()['orderID'])): ?>
                                <input type="text" hidden
                                       name = "orderID"
                                       value = "<?php echo $order->getOrder()['orderID'] ?>"
                                >
                            <?php endif; ?>
                            <div class="form-group col-12 mt-2">
                                <input type="submit" class="btn <?php echo !$order->getUpdate() ? 'btn-primary' : 'btn-info' ?>"
                                       name="<?php echo !$order->getUpdate() ? 'submit-new' : 'submit-update' ?>"
                                       value="<?php echo !$order->getUpdate() ? 'Create new' : 'update' ?>"
                                >
                                <input type="submit" class="btn btn-secondary" value="Cancel">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade <?php echo isset($_POST["addProduct"]) ? 'show' : ' ' ?>" id="addProduct"
             tabindex="-1"
             role="dialog"
             aria-labelledby="exampleModalCenterTitle" aria-hidden="true"
            <?php echo isset($_POST["addProduct"]) ? 'style = "display : block; overflow : scroll"' : 'style = "display : none"'?>>
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">
                            <?php echo $_POST['addProduct'] ? "Add or remove products for order nr " . $order->getOrder
                                ()['orderID'] : ""?>
                        </h5>
                        <form action="" method="post" >
                            <button type="submit" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </form>
                    </div>
                    <div class="modal-body">
                        <form class="col-12" action="" method="post" id="form" enctype="multipart/form-data" >
                            <div class="form-group col-12 mt-2">
                                <label for="description">Product</label>
                                <div class="form-group col-12 mt-2">
                                    <label for="name">Product name</label>
                                    <select class="custom-select" id="shippingID" name="productID">
                                        <?php if ($order->getProducts() !== null) {
                                            foreach ($order->getProducts() as $product):?>
                                                <option value="<?php echo $product['productID'] ?? '' ?>"

                                                ><?php echo $product["name"] ?? ""?></option>

                                            <?php endforeach; ?>

                                        <?php }; ?>
                                    </select>
                                </div>
                                <div class="form-group col-12 mt-2">
                                    <label for="quantity">Quantity</label>
                                    <input type="number" class="form-control" id="quantity" name="quantity"
                                           placeholder="quantity"
                                           value="1"
                                    >
                                </div>

                            <?php if(isset($_POST['orderID'])): ?>
                                <input type="text" hidden name = "orderID" value = "<?php echo $_POST['orderID'] ?>">
                            <?php endif; ?>
                            <div class="form-group col-12 mt-2">
                                <input type="submit" class="btn btn-primary"
                                       name="addProductToOrder"
                                       value="add Product">
                                <form action="" method="post">
                                    <input type="submit" class="btn btn-secondary" value="Cancel">
                                </form>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
