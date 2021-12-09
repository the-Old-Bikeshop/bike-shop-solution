<?php include_once "./components/customerNavigation.php"?>
<section class="checkout-container">
    <div class="basket-container">
        <?php include_once 'components/basket.php' ?>

    </div>
    <div class="checkout-form">
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
                        Some placeholder content for the first collapse component of this multi-collapse example. This panel is hidden by default but revealed when the user activates the relevant trigger.
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
                        Some placeholder content for the first collapse component of this multi-collapse example. This panel is hidden by default but revealed when the user activates the relevant trigger.
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

    </div>
</section>
