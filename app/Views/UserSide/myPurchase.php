<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= base_url('assets/css/UserSide/userPurchase.css') ?>">
    <link rel="stylesheet" href=" <?= base_url('assets/css/navbar.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/UserSide/grid.css') ?>">
    <link rel="shortcut icon" href="<?= base_url('assets/img/logo.png') ?>" type="image/x-icon"> 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <title>My Purchase | History</title>
    <style>
        #mypurchase { background-color: #555; color: white;}
    </style>
</head>
<body>
<!-- INCLUDE TOP(FIXED/STICKY) NAV -->
<?php  echo view("includes/header.php"); ?>

<div class="main">
    <!-- INCLUDE SIDE NAV -->
    <?php echo view("UserSide/sideNav"); ?>
    
    <hr>
    <!-- MAIN CONTENT -->
    <main>
        <div class="card-container">
            <!-- Tab buttons -->
            <div class="tabs">
                <button onclick="switchTab('Placed-Orders')">Placed Orders</button>
                <button onclick="switchTab('toShip')">To Ship</button>
                <button onclick="switchTab('toRecieve')">To Receive</button>
                <!-- <button onclick="switchTab('toReturn')">To Return/Refund</button> -->
                <button onclick="switchTab('completed')">Completed</button>
                <button onclick="switchTab('cancelled')">Cancelled</button>
            </div>

            <!-- TO PAY TAB -->
            <div id="Placed-Orders" class="tab-content active">
                <h2>Placed Orders</h2>
                <?php if(session()->has('success')) :?>
                    <span style="color: darkgreen;"><?= session()->getFlashdata('success') ?></span>
                <?php endif;?>
                <div class="orders">
                    <?php if($toConfirmOrders) :?>
                        <?php foreach($toConfirmOrders as $orders) :?>
                            <div class="withOrders">
                                <img src="<?= $orders->image_url ?>" alt="">
                                <h4><?= $orders->product_name ?></h4>
                                <p>Price: <?= $orders->price ?></p>
                                <p>Quantity: <?= $orders->quantity ?></p>
                                <p>Total: <?= $orders->total_price ?></p>
                                <p>Payment: <?= $orders->payment_method ?></p>
                                <p style="color: darkgreen; font-size: 12px;">waiting for confirmation</p>
                                <br>
                                <a href="<?= base_url('/user/cancelOrder/'.$orders->product_id) ?>">cancel order</a>
                            </div>
                        <?php endforeach;?>
                    <?php else:?>
                        <div class="noOrders">
                            <p>NO ORDERS YET</p>
                        </div>
                    <?php endif;?>
                </div>
            </div>
toShip
            <!-- TO SHIP TAB -->
            <div id="toShip" class="tab-content">
                <h2>To Ship</h2>
                <div class="orders">
                    <?php if($toShip) :?>
                        <?php foreach($toShip as $ship) :?>
                            <div class="withOrders">
                                <img src="<?= $ship->image_url ?>" alt="">
                                <h4><?= $ship->product_name ?></h4>
                                <p>Price: <?= $ship->price ?></p>
                                <p>Quantity: <?= $ship->quantity ?></p>
                                <p>Total: <?= $ship->totalPrice ?></p>
                                <p>Payment: <?= $ship->payment_method ?></p>
                                <p style="color: teal; font-size: 12px;">waiting for delivery</p>
                                <br>
                            </div>
                        <?php endforeach;?>
                    <?php else:?>
                        <div class="noOrders">
                            <p>NO ORDERS MADE YET</p>
                        </div>
                    <?php endif;?>
                </div>            
            </div>

            <!-- TO RECIEVE TAB -->
            <div id="toRecieve" class="tab-content">
                <h2>To Receives</h2>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Amet, consequuntur?</p>
            </div>

            <!-- TO RETURN TAB -->
            <!-- <div id="toReturn" class="tab-content">
                <h2>To Return/Refund</h2>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Amet, consequuntur?</p>
            </div> -->

            <!-- COMPLETE TAB -->
            <div id="completed" class="tab-content">
                <h2>Completed</h2> 
                <div class="orders">
                    <?php if($complete) :?>
                        <?php foreach($complete as $completes) :?>
                            <div class="withOrders">
                                <img src="<?= $completes->image_url ?>" alt="">
                                <h4><?= $completes->product_name ?></h4>
                                <p>Price: <?= $completes->price ?></p>
                                <p>Quantity: <?= $completes->quantity ?></p>
                                <p>Total: <?= $completes->totalPrice ?></p>
                                <p>Payment: <?= $completes->payment_method ?></p>
                                <p style="color: green; font-size: 12px;">complete</p>
                                <br>
                            </div>
                        <?php endforeach;?>
                    <?php else:?>
                        <div class="noOrders">
                            <p>NO COMPLETE ORDERS</p>
                        </div>
                    <?php endif;?>
                </div>             
            </div>

            <!-- TO CANCELLED TAB -->
            <div id="cancelled" class="tab-content">
                <h2>Cancelled</h2>
                <div class="cancelled">
                    <?php if($cancelledOrders) : ?>
                        <?php foreach($cancelledOrders as $orders) :?>
                            <div class="cancelledOrders">
                                <img src="<?= $orders->image_url ?>" alt="">
                                <h4><?= $orders->product_name ?></h4>
                                <p>Base Price: <?= $orders->price ?></p>
                                <p>Total Price: <?= $orders->totalPrice ?></p>
                                <p>Quantity: <?= $orders->quantity ?></p>
                                <p>Payment: <?= $orders->payment_method ?></p>
                                <p>Date: <?= $orders->date_cancelled ?></p>
                            </div>
                        <?php endforeach;?>
                    <?php else :?>
                        <div class="noCancelledOrders">
                            <p>No Cancelled Orders</p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </main>
</div>

<script>
    function switchTab(tabId) {
      document.querySelectorAll('.tab-content').forEach(content => {
        content.classList.remove('active');
      });
      document.getElementById(tabId).classList.add('active');
    }
</script>
</body>
</html>