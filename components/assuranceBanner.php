<?php
$business = new HomeController();
$info = $business->getBusinessInfo();
?>

<div class="assurance-banner-wrapper">
    <div class="assurance-banner-item-wrapper">
        <div class="assurance-banner-item-container">
            <div class="assurance-icon-wrapper">
                <i class="las la-shipping-fast"></i>
            </div>
            <h1 class="assurance-banner-heading">Free shipping!</h1>
            <p class="assurance-banner-text">
                <?php echo $info['company_description'] ?>
            </p>
        </div>
    </div>
    <div class="assurance-banner-item-wrapper">
        <div class="assurance-banner-item-container">
            <div class="assurance-icon-wrapper">
                <i class="lab la-pagelines"></i>
            </div>
            <h1 class="assurance-banner-heading">Supporting earth!</h1>
            <p class="assurance-banner-text">
                <?php echo $info['vision'] ?>
            </p>
        </div>
    </div>
    <div class="assurance-banner-item-wrapper">
        <div class="assurance-banner-item-container">
            <div class="assurance-icon-wrapper">
                <i class="las la-history"></i>
            </div>
            <h1 class="assurance-banner-heading">Quality assurance!</h1>
            <p class="assurance-banner-text">
                <?php echo $info['mission'] ?>
            </p>
        </div>
    </div>
    <div class="assurance-banner-item-wrapper">
        <div class="assurance-banner-item-container">
            <div class="assurance-icon-wrapper">
                <i class="las la-recycle"></i>
            </div>
            <h1 class="assurance-banner-heading">Donate your bike!</h1>
            <p class="assurance-banner-text">
                <?php echo $info['business_statement'] ?>
            </p>
        </div>
    </div>
</div>