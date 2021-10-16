<?php 

// Admin routes
RouterController::set('admin-login', function() {
    AdminLoginController::CreateView('AdminLogin');
});

// Customer routes
RouterController::set('landing', function() {
    LandingController::CreateView('LandingView');
});

RouterController::set('about-us', function() {
    ContactController::CreateView('AboutView');
});

RouterController::set('contact-us', function() {
    ContactController::CreateView('ContactView');
});

?>