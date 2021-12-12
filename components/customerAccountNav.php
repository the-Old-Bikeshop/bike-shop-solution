

<div class="account-nav-items-wrapper">
    <div class="account-nav-header-wrapper">
        <div class="account-nav-logged-in-user-wrapper">
            <div class="account-nav-logged-in-user-icon">
                <i class="las la-user"></i>
            </div>
            <h1 class="account-nav-logged-in-user-text"><?php echo $_SESSION['email'] ?></h1>
        </div>
        <form class="account-nav-form-wrapper" action="" method="POST">
            <input class="btn btn-danger" type="submit" name="logout" value="Sign out">
        </form>

    </div>
    <div class="account-nav-items-container">
        <a class="account-nav-items-link"  href="your-settings">
            <div class="account-nav-item">
                <div class="account-nav-item-icon">
                    <i class="las la-user-cog"></i>
                </div>
            <h1 class="account-nav-item-title">Settings</h1> 
            </div>
        </a>
        <a class="account-nav-items-link"  href="your-basket">
            <div class="account-nav-item">
                <div class="account-nav-item-icon">
                    <i class="las la-shopping-bag"></i>
                </div>
            <h1 class="account-nav-item-title">Basket</h1> 
            </div>
        </a>
        <a class="account-nav-items-link"  href="your-orders">
            <div class="account-nav-item">
                <div class="account-nav-item-icon">
                    <i class="las la-truck"></i>
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
    </div>
</div>