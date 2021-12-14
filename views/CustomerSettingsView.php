<?php
$order = new OrderController();
$order->setOrders();
$user = new UserController();
$userInfo = $user->getUserInfoCheckout();
$address = new AddressController();
$invoicingAddress  = $address->getInvoiceAddress();
$deliveryAddress = $address->getDeliveryAddress();

?>

<?php include_once "./components/customerNavigation.php"?>


<div class="page_wrapper">
    <?php include_once "./components/customerAccountNav.php"?>

    <div class="contact-page page_container pt-5 px-3">

        <div class="contact-page__form-container mt-4 row">
            <div class="contact-page__intro px-5 col col-12 ">
                <h1 class="heading-one pb-2">Your Information :</h1>
            </div>

            <div class="contact-page__form px-5 col col-12 row">
                <form action="" method="post" class="col col-12 col-lg-10">
                    <div class="form-row row">
                        <h2 class="heading-two">personal information</h2>
                        <div class="col-12 col-md-12 mb-3" >
                            <label for="email">Email</label>
                            <input id="email" type="email" name="email" class="form-control"
                           value="<?php echo $userInfo['email'] ?? ""; ?>"
                            readonly>
                        </div>
                        <div class="col-12 col-md-12 mb-3" >
                            <label for="title">First Name</label>
                            <input id="title" type="text" name="title" class="form-control"
                                   value="<?php echo $userInfo['first_name'] ?? ""; ?>"
                                   readonly>

                        </div>
                        <div class="col-12 col-md-12 mb-3" >
                            <label for="title">Last Name</label>
                            <input id="title" type="text" name="title" class="form-control"
                                   value="<?php echo $userInfo['last_name'] ?? ""; ?>"
                                   readonly>
                        </div>
                        <div class="col-12 col-md-12 mb-3" >
                            <label for="title">Phone</label>
                            <input id="title" type="text" name="title" class="form-control"
                                   value="<?php echo $userInfo['phone_number'] ?? ""; ?>"
                                   readonly>
                        </div>

                    </div>
                    <div class="form-row row">
                        <h2 class="heading-two">invoicing address</h2>
                        <div class="form-group col-12 mt-3">
                            <label for="invoice_postalCodeID">Zip Code</label>
                            <select  class="form-control" id="invoice_postalCodeID" name="invoice_postalCodeID" disabled>
                                <?php if ($address->fetchAllZipCodes() !== null): ?>
                                    <?php foreach ($address->fetchAllZipCodes() as $zipCode) : ?>
                                        <option value = "<?php echo $zipCode['postal_code']?>"
                                            <?php if(($address->getInvoiceAddress()!==null) && $address->fetchAllZipCodes()
                                                !== null && isset($zipCode) &&
                                                ($address->getInvoiceAddress()['postalCodeID'] == $zipCode['postal_code'])
                                            ):?>
                                                selected
                                            <?php endif; ?>
                                        > <?php
                                            if( $address->fetchAllZipCodes() !== null && isset($zipCode) ) {
                                                echo $zipCode['postal_code'] . ", " . $zipCode['place_name'];
                                            }?>
                                        </option>

                                    <?php endforeach; ?>

                                <?php endif; ?>
                            </select>
                        </div>
                        <div class="form-group col-12 mt-3">
                            <label for="invoice_street_name">Street</label>
                            <input type="text" class="form-control" id="invoice_street_name"
                                   name="invoice_street_name"
                                   placeholder="Storegade"
                                   value=" <?php echo $address->getInvoiceAddress()['street_name'] ?? '' ?>"
                            >
                        </div>

                        <div class="form-group col-12 mt-3">
                            <label for="invoice_address_content">nr</label>
                            <input type="text" class="form-control" id="invoice_address_content"
                                   name="invoice_address_content"
                                   placeholder="39, 4th"
                                   value=" <?php echo $address->getInvoiceAddress()['address_content'] ?? '' ?>"
                            >
                        </div>
                        <div class="col-12 col-md-12 mb-3" >
                            <label for="title">Phone</label>
                            <input id="title" type="text" name="title" class="form-control"
                                   value="<?php echo $userInfo['phone_number'] ?? ""; ?>"
                                   readonly>
                        </div>

                    </div>
                    <div class="col-12 pl-0">
                        <input class="btn btn-outline button-primary px-3" type="submit"
                               name="send" value="Send">
                    </div>
                </form>

            </div>
        </div>


    </div>
</div>
