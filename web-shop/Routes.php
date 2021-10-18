<?php 

// Admin routes
RouterController::set('admin-dashboard', function() {
    AdminDashboardController::CreateView('AdminDashboardView');
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