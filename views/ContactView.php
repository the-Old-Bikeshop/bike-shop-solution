<?php
$ses = new SessionHandle();
$ses->setToken();
$email = new ContactController();
$email->SendEmail();

?>

<?php include_once "./components/customerNavigation.php"?>
<div class="contact-page page_container pt-5 px-3">

    <div class="contact-page__form-container mt-4 row">
        <div class="contact-page__intro px-5 col col-12 col-lg-4">
            <h1 class="heading-one pb-2">Contact Us</h1>
            <p class="heading-one__support-text pb-5">Thank you for showing and interest in our products and works.</p>
            <h2 class="contact-page__form-intro heading-two pt-5">If you want to get in touch with use the contact form
                and we
                will respond as soon as possible</h2>
        </div>

        <div class="contact-page__form col col-12 col-lg-6 offset-lg-1 row">
            <div class="col col-12 col-lg-10">
                <?php foreach ($email->getMessage() as $message):?>
                <h5 class="contact-page__message"> <?php echo $message ?> </h5>
                <?php endforeach; ?>
            </div>
            <div class="col col-12 col-lg-10">
                <?php foreach ($email->getError() as $error):?>
                    <h5 class="contact-page__error"> <?php echo $error ?> </h5>
                <?php endforeach; ?>
            </div>

            <form action="" method="post" class="col col-12 col-lg-10">
                <div class="form-row row">
                    <div class="col-12 col-md-12 mb-3" >
                        <label for="email">Email</label>
                        <input id="email" type="email" name="email" class="form-control" required>
                    </div>
                    <div class="col-12 col-md-12 mb-3" >
                        <label for="title">Title</label>
                        <input id="title" type="text" name="title" class="form-control">
                    </div>
                    <div class="col-12 col-md-12 mb-3" >
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