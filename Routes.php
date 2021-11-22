<?php


// Admin routes;

if(isset($_SESSION['user-role']) && ($_SESSION['user-role'] == 2)) {
    RouterController::set('admin', function() {
        DashboardController::CreateView('DashboardView');
    });

    RouterController::set('admin-products', function() {
        ProductsController::CreateView('ProductView');
    });

    RouterController::set('admin-category', function () {
        CategoryController::CreateView('CategoryView');
    });

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

    RouterController::set('admin-image', function () {
        ImageController::CreateView('ImageView');
    });

    RouterController::set('admin-bike-specifications', function () {
        BikeSpecificationController::CreateView('BikeSpecificationsView');
    });

    RouterController::set('admin-shipping', function () {
        ShippingController::CreateView('ShippingView');
    });

    RouterController::set('admin-order', function () {
        OrderController::CreateView('OrderView');
    });

    RouterController::set('admin-user', function() {
        UserController::CreateView('UserView');
    });

    RouterController::set('admin-address', function() {
        AddressController::CreateView('AddressView');
    });

    RouterController::set('admin-post', function() {
        PostController::CreateView('PostView');
    });

    RouterController::set('admin-comment', function() {
        CommentController::CreateView('CommentView');
    });

      RouterController::set('admin-review', function() {
        ReviewController::CreateView('ReviewView');
    });

}


// Customer routes

RouterController::set('', function() {
    HomeController::CreateView('HomeView');
});

RouterController::set('home', function() {
    HomeController::CreateView('HomeView');
});

RouterController::set('products', function() {
    ProductsController::CreateView('ProductsView');
});

RouterController::set('blog', function() {
    BlogController::CreateView('BlogView');
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

RouterController::set('customer-account', function() {
    UserController::CreateView('CustomerAccountView');
});

RouterController::set('basket', function() {
    BasketController::CreateView('BasketView');
});

?>

