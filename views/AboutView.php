<?php include_once "./components/customerNavigation.php"?>
<div class="about-page-wrapper">
    <div class="about-page-info-wrapper">
        <h1 class="heading-one">About us</h1>
        <p class="about-text">We are team of bike enthusiasts, selling refurbished bikes collected from the streets for cheap</p>
        <div class="footer-banners-wrapper">
            <div class="footer-contact-banner-item">
                <div class="footer-contact-banner-item-icon">
                    <i class="las la-at"></i>
                </div>
                <h2 class="footer-contact-item-heading"><?php echo $info['email']?></h2>
            </div>
            <div class="footer-contact-banner-item">
                <div class="footer-contact-banner-item-icon">
                    <i class="las la-phone"></i>
                </div>
                <h2 class="footer-contact-item-heading"><?php echo $info['phone']?></h2>
            </div>
            <div class="footer-contact-banner-item">
                <div class="footer-contact-banner-item-icon">
                    <i class="las la-map-marker"></i>
                </div>
                <span>
                    <h2 class="footer-contact-item-heading"><?php echo $info['address']?></h2>
                </span>
            </div>
        </div>
    </div>
    <div class="about-page-assurance-wrapper">
        <?php include_once "./components/assuranceBanner.php"?>
    </div>
</div>
<?php include_once "./components/baseFooter.php"?>
