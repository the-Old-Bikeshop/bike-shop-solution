<?php


// Admin routes

RouterController::set('admin-brake-system', function() {
    BrakeSystemController::CreateView('BrakeSystemView');
});

// Customer routes
RouterController::set('landing', function() {
    LandingController::CreateView('LandingView');
});

RouterController::set('about', function() {
    AboutController::CreateView('AboutView');
});

RouterController::set('contact', function() {
    ContactController::CreateView('ContactView');
});

?>