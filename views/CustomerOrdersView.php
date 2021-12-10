<?php
$order = new OrderController();
$order->setOrders();

?>

<?php include_once "./components/customerNavigation.php"?>


<div class="page_wrapper">
    <?php include_once "./components/customerAccountNav.php"?>
    <section class="admin_section_wrapper">
        <div class="page_heading_wrapper">
            <h1 class="page_heading">
                Orders
            </h1>
        </div>
        <div class="page_content_wrapper">
            <div class="card bg-light col-12 p-0">
                <table class="table table-sm col-12">
                    <thead class="thead-light">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Created at</th>
                        <th scope="col">status</th>
                        <th scope="col">products name</th>
                        <th scope="col">quantity</th>
                        <th scope="col">total_price</th>
                    </tr>
                    </thead>
                    <tbody class="col-12">
                    <?php foreach ($order->getOrdersForUser() as $res): ?>
                        <tr>
                            <th scope="row"> <?php echo $res["orderID"] ?></th>
                            <td><?php echo $res['created_at']?></td>
                            <td><?php $order->getConvert()->orderStatus($res['status']);?></td>
                            <td><?php echo $res['name']?></td>
                            <td><?php echo $res['quantity']?></td>
                            <td><?php echo $res['total_price']?></td>
                            <td>
                                <form action="" method="post" class="d-inline-block p-0 m-0">
                                    <input type="hidden" hidden name="orderID" value="<?php echo $res['orderID']
                                    ?>">
                                    <input type="submit" name="update" value="update" class="btn btn-outline-secondary btn-sm">
                                </form>
                                <form action="" method="post" class="d-inline-block p-0 m-0">
                                    <input type="hidden" hidden name="orderID" value="<?php echo $res['orderID'] ?>">
                                    <input type="submit" name="addProduct" value="Add product" class="btn
                                    btn-outline-secondary
                                    btn-sm" >
                                </form>
                                <form action="" method="post" class="d-inline-block p-0 m-0">
                                    <input type="hidden" hidden name="orderID" value="<?php echo $res['orderID']
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

    </section>
</div>
