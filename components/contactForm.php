<?php
$ses = new SessionHandle();
$ses->setToken();
$email = new ContactController();
$email->SendEmail();

?>
<div class="contact-form-wrapper">
    <div class="contact-form-banner-container">
        <div class="contact-form-banner-header-wrapper">
            <h1 class="contact-form-banner-heading">Find us!</h1>
            <p class="contact-form-banner-text">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Sapiente iusto necessitatibus alias eveniet deserunt Lorem ipsum dolor, sit amet consectetur adipisicing elit. Magni laboriosam debitis maxime fuga dolores esse!</p>
        </div>
        <div class="contact-banners-wrapper">
            <div class="contact-banner-item">
                <div class="contact-banner-item-icon">
                    <i class="las la-at"></i>
                </div>
                <h2 class="contact-banner-item-heading">owlbikehsop@gmail.com</h2>
            </div>
            <div class="contact-banner-item">
                <div class="contact-banner-item-icon">
                    <i class="las la-phone"></i>
                </div>
                <h2 class="contact-banner-item-heading">+45983123876</h2>
            </div>
            <div class="contact-banner-item">
                <div class="contact-banner-item-icon">
                    <i class="las la-map-marker"></i>
                </div>
                <h2 class="contact-banner-item-heading">Gl Vardevej 78, 6700 Esbjerg</h2>
            </div>
        </div>
    </div>
    <div class="contact-form-container">
        <div class="contact-form-banner-header-wrapper">
            <h1 class="contact-form-banner-heading">Contact Form</h1>
            <div class="contact-page__form col-12">
                <div class=" col-12">
                    <?php foreach ($email->getMessage() as $message):?>
                    <h5 class="contact-page__message"> <?php echo $message ?> </h5>
                    <?php endforeach; ?>
                </div>
                <div class="col-12">
                    <?php foreach ($email->getError() as $error):?>
                        <h5 class="contact-page__error"> <?php echo $error ?> </h5>
                    <?php endforeach; ?>
                </div>
                <form action="" method="post" class="col-12 contact-form">
                    <div class="form-row row">
                        <div class="col-12  mb-3" >
                            <label for="email">Email</label>
                            <input id="email" type="email" name="email" class="form-control" required>
                        </div>
                        <div class="col-12 mb-3" >
                            <label for="title">Title</label>
                            <input id="title" type="text" name="title" class="form-control">
                        </div>
                        <div class="col-12 mb-3" >
                            <label for="message">Message</label>
                            <textarea id="message" name="message" class="form-control" rows="10" required></textarea>
                        </div>
                        <input type="hidden" name="token" value="<?php echo $ses->getToken(); ?>">
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