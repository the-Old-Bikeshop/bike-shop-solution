<?php 

// Admin routes
RouterController::set('admin/login', function() {
    AdminLoginController::CreateView('AdminLoginView');
});

// Customer routes
RouterController::set('landing', function() {
    LandingController::CreateView('LandingView');
});

RouterController::set('about', function() {
    ContactController::CreateView('AboutView');
});

RouterController::set('contact', function() {
    ContactController::CreateView('ContactView');
});

?>