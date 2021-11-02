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

RouterController::set('admin-company-details', function() {
    CompanyDetailsController::CreateView('CompanyDetailsView');
});

RouterController::set('admin-category', function () {
    CategoryController::CreateView('CategoryView');
});

RouterController::set('admin-image', function () {
    ImageController::CreateView('ImageView');
});

RouterController::set('admin-bike-specifications', function () {
    BikeSpecificationController::CreateView('BikeSpecificationsView');
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

RouterController::set('sign-in', function() {
    UserController::CreateView('LoginView');
});

?>

