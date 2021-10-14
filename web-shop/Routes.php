<?php 

Route::set('about-us', function() {
    ContactController::CreateView('AboutUs');
});

Route::set('contact-us', function() {
    ContactController::CreateView('ContactUs');
});

?>