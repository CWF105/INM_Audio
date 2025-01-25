<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= base_url('Admin/css/dashboard.css') ?>">
    <link rel="stylesheet" href="<?= base_url('Admin/css/grid.css') ?>">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
                <!-- <h4>Sales</h4>
                <hr>
                <button class="dropdown-button"><img src="<?= base_url('Admin/img/icons/down-arrow.png') ?>" alt=""></button>
                <p id="sales-display">All the time</p>
                <div class="dropdown">
                    <ul class="dropdown-menu" onchange="change()">
                        <li onclick="updateSales('All the time:')">All the time</li>
                        <li onclick="updateSales('Per Year:')">Per Year</li>
                        <li onclick="updateSales('Per Month:')">Per Month</li>
                        <li onclick="updateSales('Per Week:')">Per Week</li>
                    </ul>
                </div> -->
                <div class="chart1 chart">
                </div>

                <div class="chart2 chart">
                </div>
            </div>

            <div class="box2">
                <h4>Products</h4>
                <hr>
                <div class="product">
                    <div class="one">
                        <p>Items</p>
                        <span style="color: <?= ($numberItems > 5) ? "teal": "red";?>;">
                            <strong>
                                <?= $numberItems; ?>
                            </strong> 
                        </span>
                    </div>
                    <div class="one">
                        <p>sold out</p>
                        <span style="color: <?= ($totalOrders->totalOrders > $totalCancelled->totalCancelled) ? "teal": "red";?>;">
                            <strong>
                                <?php echo ($totalOrders) ? $totalOrders->totalOrders : 0; ?>
                            </strong> 
                        </span>
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
                    <span style="color: <?= ((($totalPlaced->totalPlacedOrders / $totalOrders->totalOrders) * 100) > 10) ? "green": "red";?>;">    
                        <strong>
                            <?php echo ($totalPlaced) ? $totalPlaced->totalPlacedOrders : 0;?>
                        </strong>                    
                    </span>
                </div>
                <div class="box box2">
                    <h3>Processing</h3>
                    <span style="color: <?= ((($totalConfirmed->totalConfirmed / $totalOrders->totalOrders) * 100) > 10) ? "green": "red";?>;">
                        <strong>
                            <?php echo ($totalConfirmed) ? $totalConfirmed->totalConfirmed : 0;?>
                        </strong>                    
                    </span>
                </div>
                <div class="box box3">
                    <h3>Shipped</h3>
                    <span>
                        <strong>
                            0
                        </strong> 
                    </span>
                </div>
                <div class="box box4">
                    <h3>Cancelled</h3>
                    <span style="color: <?= ($totalCancelled->totalCancelled > $totalConfirmed->totalConfirmed) ? "red": "green";?>;">
                        <strong>
                            <?php echo ($totalCancelled) ? $totalCancelled->totalCancelled : 0;?>
                        </strong> 
                    </span>
                </div>
                <!-- <div class="box box5">
                    <h3>Returns</h3>
                    <span>0</span>
                </div> -->
                <div class="box box6">
                    <h3>Complete</h3>
                    <span style="color: <?= ($totalComplete->totalComplete > $totalCancelled->totalCancelled &&
                                             $totalComplete->totalComplete > $totalConfirmed->totalConfirmed && 
                                             $totalComplete->totalComplete > $totalPlaced->totalPlacedOrders &&
                                             $totalComplete->totalComplete > $totalOrders->totalOrders) ? "red": "green";?>;">
                        <strong>
                            <?php echo ($totalComplete) ? $totalComplete->totalComplete : 0;?>
                        </strong> 
                    </span>
                </div>
            </div>
        </div>
    </div>
</main>

<script src="<?= base_url('Admin/js/dashboard.js') ?>"></script>

</body>
</html>

