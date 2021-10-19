<?php


// Admin routes

RouterController::set('admin-brake-system', function() {
    BrakeSystemController::CreateView('BrakeSystemView');
});

RouterController::set('admin-wheel-size', function() {
    WheelSizeController::CreateView('WheelSizeView');
});

RouterController::set('admin-drive-type', function() {
    DriveTypeController::CreateView('DriveTypeView');
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

RouterController::set('sign-up', function() {
    UserController::CreateView('RegisterView');
});

?>

