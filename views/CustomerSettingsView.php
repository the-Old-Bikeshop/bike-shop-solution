<?php
$order = new OrderController();
$order->setOrders();
$user = new UserController();
$user->setUser();
$userInfo = $user->getUserInfoCheckout();
$address = new AddressController();
$address->setAddress();
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
            <form  action="" method="post" class="col-12 pl-0 px-5">
                <input class="btn btn-outline button-primary px-3" type="submit"
                       name="edit" value="Edit information">
            </form>

            <div class="contact-page__form user-info__form px-5 col col-12 row">
                <form action="" method="post" class="col col-12 col-lg-10 user-info__form">
                    <div class="form-row row mt-3">
                        <h2 class="heading-two">personal information</h2>
                        <div class="col-12 col-md-12 mb-1" >
                            <label for="email">Email</label>
                            <input id="email" type="email" name="email" class="form-control"

                           value="<?php echo $userInfo['email'] ?? ""; ?>"

                            <?php if(!isset($_POST['edit'])):?>
                                readonly
                                    <?php endif?>
                            >
                        </div>
                        <div class="col-12 col-md-12 mb-1" >
                            <label for="title">First Name</label>
                            <input id="title" type="text" name="first_name" class="form-control"
                                   value="<?php echo $userInfo['first_name'] ?? ""; ?>"
                                   <?php if(!isset($_POST['edit'])):?>
                                readonly
                                    <?php endif?>
                            >

                        </div>
                        <div class="col-12 col-md-12 mb-1" >
                            <label for="title">Last Name</label>
                            <input id="title" type="text" name="last_name" class="form-control"
                                   value="<?php echo $userInfo['last_name'] ?? ""; ?>"
                                   <?php if(!isset($_POST['edit'])):?>
                                readonly
                                    <?php endif?>
                            >
                        </div>
                        <div class="col-12 col-md-12 mb-1" >
                            <label for="title">Nickname</label>
                            <input id="title" type="text" name="nick_name" class="form-control"
                                   value="<?php echo $userInfo['nick_name'] ?? ""; ?>"
                                <?php if(!isset($_POST['edit'])):?>
                                    readonly
                                <?php endif?>
                            >
                        </div>
                        <div class="col-12 col-md-12 mb-1" >
                            <label for="title">Phone</label>
                            <input id="title" type="text" name="phone_number" class="form-control"
                                   value="<?php echo $userInfo['phone_number'] ?? ""; ?>"
                                   <?php if(!isset($_POST['edit'])):?>
                                readonly
                                    <?php endif?>
                            >
                        </div>

                    </div>
                    <div class="form-row row mt-5">
                        <h2 class="heading-two">invoicing address</h2>
                        <div class="form-group col-12 mb-1">
                            <label for="invoice_postalCodeID">Zip Code</label>
                            <select  class="form-control" id="invoice_postalCodeID" name="invoice_postalCodeID"
                                <?php if(!isset($_POST['edit'])):?>
                                    disabled
                                <?php endif?>
                            >
                                <?php if ($address->fetchAllZipCodes() !== null): ?>
                                    <?php foreach ($address->fetchAllZipCodes() as $zipCode) : ?>
                                        <option value = "<?php echo $zipCode['postal_code']?>"
                                            <?php if(($address->getInvoiceAddress()!==null) && $address->fetchAllZipCodes()
                                                !== null && isset($zipCode['postal_code']) && isset
                                                ($address->getInvoiceAddress()['postalCodeID']) &&
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
                        <div class="form-group col-12 mb-1">
                            <label for="invoice_street_name">Street</label>
                            <input type="text" class="form-control" id="invoice_street_name"
                                   name="invoice_street_name"
                                   placeholder="Storegade"
                                   value=" <?php echo $address->getInvoiceAddress()['street_name'] ?? '' ?>"
                                   <?php if(!isset($_POST['edit'])):?>
                                readonly
                                    <?php endif?>

                            >
                        </div>

                        <div class="form-group col-12 mb-1">
                            <label for="invoice_address_content">nr</label>
                            <input type="text" class="form-control" id="invoice_address_content"
                                   name="invoice_address_content"
                                   placeholder="39, 4th"
                                   value=" <?php echo $address->getInvoiceAddress()['address_content'] ?? '' ?>"
                                   <?php if(!isset($_POST['edit'])):?>
                                readonly
                                    <?php endif?>

                            >
                        </div>
                        <div class="col-12 col-md-12 mb-1" >
                            <label for="title">Phone</label>
                            <input id="title" type="text" name="invoice_phone_number" class="form-control"
                                   value="<?php echo $address->getInvoiceAddress()['phone_number'] ?? ""; ?>"
                                   <?php if(!isset($_POST['edit'])):?>
                                readonly
                                    <?php endif?>
                            >
                        </div>
                        <input type="hidden" name="invoice_addressID" value="<?php echo $address->getInvoiceAddress()['addressID'] ?>">

                    </div>

                    <div class="form-row row mt-5">
                        <h2 class="heading-two">Delivery address</h2>
                        <div class="form-group col-12 mb-1">
                            <label for="delivery_postalCodeID">Zip Code</label>
                            <select  class="form-control" id="delivery_postalCodeID" name="delivery_postalCodeID"
                                <?php if(!isset($_POST['edit'])):?>
                                    disabled
                                     <?php endif?>>
                                <?php if ($address->fetchAllZipCodes() !== null): ?>
                                    <?php foreach ($address->fetchAllZipCodes() as $zipCode) : ?>
                                        <option value = "<?php echo $zipCode['postal_code']?>"
                                            <?php if(($address->getDeliveryAddress()!==null) && $address->fetchAllZipCodes()
                                                !== null && isset($zipCode['postal_code']) && isset
                                                ($address->getDeliveryAddress()['postalCodeID']) &&
                                                ($address->getDeliveryAddress()['postalCodeID'] == $zipCode['postal_code'])
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
                        <div class="form-group col-12 mb-1">
                            <label for="delivery_street_name">Street</label>
                            <input type="text" class="form-control" id="delivery_street_name"
                                   name="delivery_street_name"
                                   placeholder="Storegade"
                                   value=" <?php echo $address->getDeliveryAddress()['street_name'] ?? '' ?>"
                                   <?php if(!isset($_POST['edit'])):?>
                                readonly
                                    <?php endif?>

                            >
                        </div>

                        <div class="form-group col-12 mb-1">
                            <label for="delivery_address_content">nr</label>
                            <input type="text" class="form-control" id="delivery_address_content"
                                   name="delivery_address_content"
                                   placeholder="39, 4th"
                                   value=" <?php echo $address->getDeliveryAddress()['address_content'] ?? '' ?>"
                                   <?php if(!isset($_POST['edit'])):?>
                                readonly
                                    <?php endif?>

                            >
                        </div>
                        <div class="col-12 col-md-12 mb-1" >
                            <label for="title">Phone</label>
                            <input id="title" type="text" name="delivery_phone_number" class="form-control"
                                   value="<?php echo $address->getDeliveryAddress()['phone_number'] ?? ""; ?>"
                                   <?php if(!isset($_POST['edit'])):?>
                                readonly
                                    <?php endif?>
                            >
                        </div>
                        <input type="hidden" name="delivery_addressID" value="<?php echo $address->getDeliveryAddress
                        ()['addressID']  ?>">

                    </div>
                    <div class="col-12 pl-0">
                        <input class="btn btn-outline button-primary px-3" type="submit"
                               name="submit-user-update" value="update">
                    </div>
                </form>

            </div>
        </div>


    </div>
</div>
