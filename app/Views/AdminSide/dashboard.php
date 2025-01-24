<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= base_url('Admin/css/dashboard.css') ?>">
    <link rel="stylesheet" href="<?= base_url('Admin/css/grid.css') ?>">
    <title>Dashboard</title>
    <style>
        /* SIDE NAV WHEN IN THIS PAGE - below css selectors can be found in the "sideNav.php" file */
        #dashboard { background-color: #d4ebf844; }
        aside nav ul #dashboard span { opacity: 1;}
    </style>
</head>
<body>
<!-- 
// * INCLUDE THE SIDE NAVIGATION FILE *
-->
<?php echo view('AdminSide/includes/sideNav') ?>


<!-- 
// * MAIN CONTENT *
-->
<main>
    <div class="header">
        <h3>DASHBOARD</h2>
    </div>

    <div class="main">
        <div class="row1">
            <div class="box1">
                <h4>Sales</h4>
                <hr>
                <button class="dropdown-button"><img src="<?= base_url('Admin/img/icons/down-arrow.png') ?>" alt=""></button>
                <p id="sales-display">All the time</p>
                <div class="dropdown">
                    <ul class="dropdown-menu">
                        <li onclick="updateSales('All the time:')">All the time</li>
                        <li onclick="updateSales('Per Year:')">Per Year</li>
                        <li onclick="updateSales('Per Month:')">Per Month</li>
                        <li onclick="updateSales('Per Week:')">Per Week</li>
                    </ul>
                </div>
            </div>

            <div class="box2">
                <h4>Products</h4>
                <hr>
                <div class="product">
                    <div class="one">
                        <p>Items</p>
                        <span><?= $numberItems; ?></span>
                    </div>
                    <div class="one">
                        <p>sold out</p>
                        <span><?php echo ($totalOrders) ? $totalOrders->totalOrders : 0; ?></span>
                    </div>
                </div>
            </div>
        </div>

        <div class="row2">
            <div class="order">
                <h4>Orders</h4>
            </div>
            <div class="order-container">
                <div class="box box1">
                    <h3>Placed</h3>
                    <span>                        
                        <?php echo ($totalPlaced) ? $totalPlaced->totalPlacedOrders : 0;?>
                    </span>
                </div>
                <div class="box box2">
                    <h3>Processing</h3>
                    <span>
                        <?php echo ($totalConfirmed) ? $totalConfirmed->totalConfirmed : 0;?>
                    </span>
                </div>
                <div class="box box3">
                    <h3>Shipped</h3>
                    <span>
                        0
                    </span>
                </div>
                <div class="box box4">
                    <h3>Cancelled</h3>
                    <span>
                        <?php echo ($totalCancelled) ? $totalCancelled->totalCancelled : 0;?>
                    </span>
                </div>
                <!-- <div class="box box5">
                    <h3>Returns</h3>
                    <span>0</span>
                </div> -->
                <div class="box box6">
                    <h3>Complete</h3>
                    <span>
                        <?php echo ($totalComplete) ? $totalComplete->totalComplete : 0;?>
                    </span>
                </div>
            </div>
        </div>
    </div>
</main>

<script src="<?= base_url('Admin/js/dashboard.js') ?>"></script>
</body>
</html>

