<!-- CSS FILE -->
<link rel="stylesheet" href="<?= base_url('Admin/css/sideNav.css') ?>">

<!-- SIDE BAR LINKS -->
<aside>
    <nav>
        <div class="logo-title">
            <img src="<?= base_url('Admin/img/icons/logo.png') ?>" alt="INM ADMIN PANEL LOGO">
            <h3>Admin Panel</h3>
        </div>

        <ul>
             <!-- ACCOUNT | SETTINGS -->
             <a href="<?= base_url('/admin/account') ?>" id="account">
                <span><!-- DO NOT REMOVE THIS LINE--></span>
                <img src="<?= base_url('Admin/img/icons/account.png') ?>" alt="[]">
                <li>MyAccount</li>
            </a>

            <!-- DASHBOARD -->
            <a href="<?= base_url('/admin/dashboard') ?>" id="dashboard">
                <span><!-- DO NOT REMOVE THIS LINE--></span>
                <img src="<?= base_url('Admin/img/icons/dashboard.png') ?>" alt="[]">
                <li>Dashboard</li>
            </a>

            <!-- ORDER/TRANSACTIONS -->
            <a href="<?= base_url('/admin/orders_transactions') ?>" id="order_transaction">
                <span><!-- DO NOT REMOVE THIS LINE--></span>
                <img src="<?= base_url('Admin/img/icons/clipboard.png') ?>" alt="[]">
                <li>Orders | Transactions</li>
            </a>

            <!-- CUSTOMERS -->
            <a href="<?= base_url('/admin/customers') ?>" id="customers">
                <span><!-- DO NOT REMOVE THIS LINE--></span>
                <img src="<?= base_url('Admin/img/icons/customer.png') ?>" alt="[]">
                <li>Customers</li>
            </a>

            <!-- MANAGEMENT -->
            <a href="<?= base_url('/admin/management') ?>" id="management">
                <span><!-- DO NOT REMOVE THIS LINE--></span>
                <img src="<?= base_url('Admin/img/icons/data-management.png') ?>" alt="[]">
                <li>Management</li>
            </a>
            <br>
            <hr>

             <!-- LOGOUT -->
             <a href="<?= base_url('/admin/loggingOut') ?>" id="logout">
                <span><!-- DO NOT REMOVE THIS LINE--></span>
                <img src="<?= base_url('Admin/img/icons/logout.png') ?>" alt="[]">
                <li>Logout</li>
            </a>

             <!-- REGISTER ACCOUNT -->
             <a href="<?= base_url('/admin/registerA') ?>" id="registerA">
                <span><!-- DO NOT REMOVE THIS LINE--></span>
                <img src="<?= base_url('Admin/img/icons/user.png') ?>" alt="[]">
                <li>Register Account</li>
            </a>
        </ul>
    </nav>
</aside>