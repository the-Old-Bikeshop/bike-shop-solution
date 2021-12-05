<?php $logout = new LogoutController();
$logout->logoutCheck();?>

<div class="account-nav-items-wrapper">
    <div class="account-nav-items-container">
        <a class="account-nav-items-link"  href="your-settings">
            <div class="account-nav-item">
                <div class="account-nav-item-icon">
                    <i class="las la-user-cog"></i>
                </div>
            <h1 class="account-nav-item-title">Settings</h1> 
            </div>
        </a>
        <a class="account-nav-items-link"  href="your-orders">
            <div class="account-nav-item">
                <div class="account-nav-item-icon">
                    <i class="las la-shopping-bag"></i>
                </div>
            <h1 class="account-nav-item-title">Orders</h1> 
            </div>
        </a>
        <a class="account-nav-items-link"  href="your-wishlist">
            <div class="account-nav-item">
                <div class="account-nav-item-icon">
                    <i class="lar la-heart"></i>
                </div>
            <h1 class="account-nav-item-title">Wishlist</h1> 
            </div>
        </a>
        <a class="account-nav-items-link" href="home">
            <div class="account-nav-sign-out">
                <div class="account-nav-sign-out-icon">
                    <i class="las la-sign-out-alt"></i>
                </div>
                <h1 class="account-nav-sign-out-title">Sign out</h1> 
            </div>  
         </a>
    </div>
</div>