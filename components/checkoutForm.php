<?php
$address = new AddressController();
$address->setAddress();
$user = new UserController();
$user->setUser();
$order = new OrderController();
$checkout = new CheckoutController();
$checkout->processCheckout();

?>
<div class="checkout-form-wrapper">
    <form  class="checkout-form" action="" method="post">
        <div class="row checkout-form-step">
            <div class="checkout-form-control-dropdown">
                <a class="checkout-form-control-dropdown-link" data-bs-toggle="collapse" href="#userInfo" 
                    role="button" aria-controls="address"
                >
                    Your personal details
                    <div class="dropdown-control-icon">
                        <i class="las la-chevron-right"></i>
                    </div>
                </a>
            </div>
            <div class="show" id="userInfo">
                <div class="col-12">
                    <div class="row">
                        <div class="form-group col-12 col-md-6 mt-2">
                            <label for="first_name">first name</label>
                            <input type="text" class="form-control" id="first_name" name="first_name"
                                   placeholder="John"
                                   value="<?php echo $user->getUserInfoCheckout()['first_name'] ?? '' ?>"
                            >
                        </div>
                        <div class="form-group col-12 col-md-6 mt-2">
                            <label for="last_name">last name</label>
                            <input type="text" class="form-control" id="last_name" name="last_name"
                                   placeholder="Smith"
                                   value="<?php echo $user->getUserInfoCheckout()['last_name'] ?? '' ?>"
                            >
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-12 mt-2">
                            <label for="email">email</label>
                            <input type="email" class="form-control" id="email" name="email"
                                   placeholder="email@email.com"
                                   value="<?php echo $user->getUserInfoCheckout()['email'] ?? '' ?>"
                            >
                        </div>
                        <div class="form-group col-12 mt-2">
                            <label for="phone_number">phone_number</label>
                            <input type="text" class="form-control" id="phone_number" name="phone_number"
                                   placeholder="phone"
                                   value="<?php echo $user->getUserInfoCheckout()['phone_number'] ?? '' ?>"
                            >
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="row">
                    <div class="form-group col-12 col-md-6 mt-2">
                        <label for="shippingID">Select shipping method</label>
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
                </div>
            </div>
        </div>

        <div class="row">
            <div class="checkout-form-control-dropdown">
                <a class="checkout-form-control-dropdown-link" data-bs-toggle="collapse" href="#invoiceAddress" 
                   aria-controls="address"
                >
                    Your invoice address
                    <div class="dropdown-control-icon">
                        <i class="las la-chevron-right"></i>
                    </div>
                </a>
            </div>

            <div class="collapse" id="invoiceAddress">
                <div class="col-12">
                    <div class="row">
                        <div class="form-group col-12 mt-2">
                            <label for="invoice_postalCodeID">Zip Code</label>
                            <select  class="form-control" id="invoice_postalCodeID" name="invoice_postalCodeID" >
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
                        <div class="form-group col-12 mt-2">
                            <label for="invoice_street_name">Street</label>
                            <input type="text" class="form-control" id="invoice_street_name"
                                    name="invoice_street_name"
                                    placeholder="Storegade"
                                    value=" <?php echo $address->getInvoiceAddress()['street_name'] ?? '' ?>"
                            >
                        </div>
                        <div class="form-group col-12 mt-2">
                            <label for="invoice_address_content">nr</label>
                            <input type="text" class="form-control" id="invoice_address_content"
                                    name="invoice_address_content"
                                    placeholder="39, 4th"
                                    value=" <?php echo $address->getInvoiceAddress()['address_content'] ?? '' ?>"
                            >
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="checkout-form-control-dropdown">
                <a class="checkout-form-control-dropdown-link" data-bs-toggle="collapse" href="#deliveryAddress" 
                    role="button" aria-controls="address"
                >
                    Your personal details
                    <div class="dropdown-control-icon">
                        <i class="las la-chevron-right"></i>
                    </div>
                </a>
            </div>

                <div class="collapse" id="deliveryAddress">
                    <div class="col-12">
                        <div class="row">
                            <div class="form-group col-12 mt-2">
                                <label for="delivery_postalCodeID">Zip Code</label>
                                <select  class="form-control" id="delivery_postalCodeID" name="delivery_postalCodeID" >
                                    <?php if ($address->fetchAllZipCodes() !== null): ?>
                                        <?php foreach ($address->fetchAllZipCodes() as $zipCode) : ?>
                                            <option value = "<?php echo $zipCode['postal_code']?>"
                                                <?php if(($address->getDeliveryAddress()!==null)
                                                 && $address->fetchAllZipCodes() !== null
                                                    && isset($zipCode)
                                                    && ($address->getDeliveryAddress()['postalCodeID'] == $zipCode['postal_code'])
                                                ):?>
                                                    selected
                                                <?php else: ?>
                                                    <?php if(!isset($shipping['shippingID']) && isset($order->getOrder()['oderID'])
                                                        && $shipping['shippingID'] ==
                                                        $order->getOrder()['orderID']):?>
                                                        selected
                                                    <?php endif; ?>

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
                            <div class="form-group col-12 mt-2">
                                <label for="delivery_street_name">Street</label>
                                <input type="text" class="form-control" id="delivery_street_name"
                                       name="delivery_street_name"
                                       placeholder="Storegade"
                                       value=" <?php echo $address->getDeliveryAddress()['street_name'] ?? $address->getInvoiceAddress()['street_name'] ?? '' ?>"
                                >
                            </div>
                            <div class="form-group col-12 mt-2">
                                <label for="delivery_address_content">nr</label>
                                <input type="text" class="form-control" id="delivery_address_content"
                                       name="delivery_address_content"
                                       placeholder="39, 4th"
                                       value=" <?php echo $address->getDeliveryAddress()['address_content'] ?? $address->getInvoiceAddress()['address_content'] ?? '' ?>"
                                >
                            </div>
                        </div>
                </div>
            </div>
        </div>



<!--        <p>-->
<!--            <a class="btn" data-bs-toggle="collapse" href="#payment" role="button"-->
<!--               aria-expanded="false" aria-controls="payment">Toggle first element</a>-->
<!--                        <button class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#multiCollapseExample2" aria-expanded="false" aria-controls="multiCollapseExample2">Toggle second element</button>-->
<!--                        <button class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target=".multi-collapse" aria-expanded="false" aria-controls="multiCollapseExample1 multiCollapseExample2">Toggle both elements</button>-->
<!--        </p>-->
<!--        <div class="row">-->
<!--            <div class="col">-->
<!--                <div class="collapse" id="payment">-->
<!--                    <div class="card card-body">-->
<!--                        Some placeholder content for the first collapse component of this multi-collapse example. This panel is hidden by default but revealed when the user activates the relevant trigger.-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->
        <div class="row">
            <div class="col-12">
                <input type='submit' class="btn" name="pay" value="proceed to payment">
            </div>
        </div>

    </form>
</div>
