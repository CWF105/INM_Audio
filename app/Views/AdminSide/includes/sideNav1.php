<!-- SIDEBAR -->
<section id="sidebar">
    <a href="#" class="brand">
        <!-- <img src="<?= base_url("admin/img/icons/logo.png") ?>" alt="" style="width: 50px;"> -->
        <span class="text" style="margin-left: 20px;">INM Admin Panel</span>
    </a>
    <ul class="side-menu top">
        <li class="active">
            <a href="<?= base_url('/admin/dashboard') ?>">
                <i class='bx bxs-dashboard' ></i>
                <span class="text">Dashboard</span>
            </a>
        </li>
        <li>
            <a href="<?= base_url('/admin/orders_transactions') ?>" id="order_transaction">
                <i class='bx bxs-doughnut-chart' ></i>
                <span class="text">Orders | Transactions</span>
            </a>
        </li>
        <li>
            <a href="<?= base_url('/admin/customers') ?>" id="customers">
                <i class='bx bxs-group' ></i>
                <span class="text">Users</span>
            </a>
        </li>
        <li>
            <a href="<?= base_url('/admin/management') ?>" id="logout">
                <i class='bx bxs-shopping-bag-alt' ></i>
                <span class="text">Management</span>
            </a>
        </li>
    </ul>
    <ul class="side-menu">
        <li>
            <a href="<?= base_url('/admin/account') ?>" id="account">
                <i class='bx bxs-cog' ></i>
                <span class="text">Account</span>
            </a>
        </li>
        <li>
            <a href="<?= base_url('/admin/registerA') ?>" id="registerA">
                <i class='bx bxs-group' ></i>
                <span class="text">Register</span>
            </a>
        </li>
        <li>
            <a href="<?= base_url('/admin/loggingOut') ?>" id="logout" class="logout">
                <i class='bx bxs-log-out-circle' ></i>
                <span class="text">Logout</span>
            </a>
        </li>
    </ul>
</section>
<!-- SIDEBAR -->