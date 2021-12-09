<?php
$address = new AddressController();
$address->setAddress();
$user = new UserController();
$user->setUser();

?>
<div class="checkout">
    <form action="">
        <div class="form-group col-12 mt-2">
            <label for="first_name">first name</label>
            <input type="text" class="form-control" id="first_name" name="first_name"
                   placeholder="John"
                   value=" <?php echo $user->getUserInfoCheckout()['first_name'] ?? '' ?>"
            >
        </div>

        <div class="form-group col-12 mt-2">
            <label for="last_name">last name</label>
            <input type="text" class="form-control" id="last_name" name="last_name"
                   placeholder="Smith"
                   value=" <?php echo $user->getUserInfoCheckout()['last_name'] ?? '' ?>"
            >
        </div>
        <div class="form-group col-12 mt-2">
            <label for="nick_name">nick name</label>
            <input type="text" class="form-control" id="nick_name" name="nick_name"
                   placeholder="username"
                   value=" <?php echo $user->getUserInfoCheckout()['nick_name'] ?? '' ?>"
            >
        </div>

        <div class="form-group col-12 mt-2">
            <label for="email">email</label>
            <input type="email" class="form-control" id="email" name="email"
                   placeholder="email@email.com"
                   value=" <?php echo $user->getUserInfoCheckout()['email'] ?? '' ?>"
            >
        </div>


        <div class="form-group col-12 mt-2">
            <label for="phone_number">phone_number</label>
            <input type="text" class="form-control" id="phone_number" name="phone_number"
                   placeholder="phone"
                   value=" <?php echo $address->getAddressForCheckout()['phone_number'] ?? '' ?>"
            >
        </div>
        <div>
            delivery method
        </div>

        <p>
            <a class="btn " data-bs-toggle="collapse" href="#address" role="button"
               aria-expanded="false" aria-controls="address">address</a>
            <!--            <button class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#multiCollapseExample2" aria-expanded="false" aria-controls="multiCollapseExample2">Toggle second element</button>-->
            <!--            <button class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target=".multi-collapse" aria-expanded="false" aria-controls="multiCollapseExample1 multiCollapseExample2">Toggle both elements</button>-->
        </p>
        <div class="row">
            <div class="col">
                <div class="collapse" id="address">
                    <div class="card card-body">
                        <div class="form-group col-12 mt-2">
                            <label for="postalCodeID">Zip Code</label>
                            <select  class="form-control" id="postalCodeID" name="postalCodeID" >
                                <?php if ($address->fetchAllZipCodes() !== null): ?>
                                    <?php foreach ($address->fetchAllZipCodes() as $zipCode) : ?>
                                        <option value = "<?php echo $zipCode['postal_code']?>"
                                            <?php if(($address->getOneAddress()!==null) && $address->fetchAllZipCodes()
                                                !== null && isset($zipCode) &&
                                                ($address->getOneAddress()['postalCodeID'] == $zipCode['postal_code'])
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
                            <label for="street_name">Street</label>
                            <input type="text" class="form-control" id="street_name" name="street_name"
                                   placeholder="Storegade"
                                   value=" <?php echo $address->getAddressForCheckout()['street_name'] ?? '' ?>"
                            >
                        </div>

                        <div class="form-group col-12 mt-2">
                            <label for="address_content">nr</label>
                            <input type="text" class="form-control" id="address_content" name="address_content"
                                   placeholder="39, 4th"
                                   value=" <?php echo $address->getAddressForCheckout()['address_content'] ?? '' ?>"
                            >
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <p>
            <a class="btn" data-bs-toggle="collapse" href="#deliveryAddress" role="button"
               aria-expanded="false" aria-controls="deliveryAddress">If you have a different delivery address</a>
            <!--            <button class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#multiCollapseExample2" aria-expanded="false" aria-controls="multiCollapseExample2">Toggle second element</button>-->
            <!--            <button class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target=".multi-collapse" aria-expanded="false" aria-controls="multiCollapseExample1 multiCollapseExample2">Toggle both elements</button>-->
        </p>
        <div class="row">
            <div class="col">
                <div class="collapse" id="deliveryAddress">
                    <div class="card card-body">
                        <div class="row">
                            <div class="col">
                                <div class="collapse" id="address">
                                    <div class="card card-body">
                                        <div class="form-group col-12 mt-2">
                                            <label for="postalCodeID">Zip Code</label>
                                            <select  class="form-control" id="postalCodeID" name="postalCodeID" >
                                                <?php if ($address->fetchAllZipCodes() !== null): ?>
                                                    <?php foreach ($address->fetchAllZipCodes() as $zipCode) : ?>
                                                        <option value = "<?php echo $zipCode['postal_code']?>"
                                                            <?php if(($address->getOneAddress()!==null) && $address->fetchAllZipCodes()
                                                                !== null && isset($zipCode) &&
                                                                ($address->getOneAddress()['postalCodeID'] == $zipCode['postal_code'])
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
                                            <label for="street_name">Street</label>
                                            <input type="text" class="form-control" id="street_name" name="street_name"
                                                   placeholder="Storegade"
                                                   value=" <?php echo $address->getAddressForCheckout()['street_name'] ?? '' ?>"
                                            >
                                        </div>

                                        <div class="form-group col-12 mt-2">
                                            <label for="address_content">nr</label>
                                            <input type="text" class="form-control" id="address_content" name="address_content"
                                                   placeholder="39, 4th"
                                                   value=" <?php echo $address->getAddressForCheckout()['address_content'] ?? '' ?>"
                                            >
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <p>
            <a class="btn" data-bs-toggle="collapse" href="#payment" role="button"
               aria-expanded="false" aria-controls="payment">Toggle first element</a>
            <!--            <button class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#multiCollapseExample2" aria-expanded="false" aria-controls="multiCollapseExample2">Toggle second element</button>-->
            <!--            <button class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target=".multi-collapse" aria-expanded="false" aria-controls="multiCollapseExample1 multiCollapseExample2">Toggle both elements</button>-->
        </p>
        <div class="row">
            <div class="col">
                <div class="collapse" id="payment">
                    <div class="card card-body">
                        Some placeholder content for the first collapse component of this multi-collapse example. This panel is hidden by default but revealed when the user activates the relevant trigger.
                    </div>
                </div>
            </div>
        </div>

    </form>
</div>
