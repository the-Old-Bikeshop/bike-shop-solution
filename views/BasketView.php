<?php include_once "./components/customerNavigation.php"?>
<section class="checkout-section-wrapper">
    <div class="basket-container">
        <div class="basket-header-wrapper">
            <div class="basket-icon-wrapper">
                <i class="las la-shopping-bag"></i>
            </div>
            <h1 class="basket-heading">Your basket!</h1>
        </div>
        <?php include_once 'components/basket.php' ?>
    </div>
    <div class="checkout-form-container">
        <a class="sign-in-call-to-action-checkout" href="sign-in">Sign in</a>
        <div class="basket-header-wrapper">
            <div class="basket-icon-wrapper">
                <i class="las la-cash-register"></i>
            </div>
            <h1 class="checkout-heading">Checkout!</h1>
        </div>
        <?php include_once 'components/checkoutForm.php' ?>
    </div>
</section>
