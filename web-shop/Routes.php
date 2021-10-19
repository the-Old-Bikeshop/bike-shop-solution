<?php


// Admin routes
<<<<<<< HEAD

RouterController::set('admin-brake-system', function() {
    BrakeSystemController::CreateView('BrakeSystemView');
=======
RouterController::set('admin-dashboard', function() {
    AdminDashboardController::CreateView('AdminDashboardView');
>>>>>>> implementing-mvc-upgrade
});

// Customer routes
RouterController::set('landing', function() {
    LandingController::CreateView('LandingView');
});

RouterController::set('about', function() {
    AboutController::CreateView('AboutView');
});

RouterController::set('sign-up', function() {
    UserController::CreateView('RegisterView');
});

?>