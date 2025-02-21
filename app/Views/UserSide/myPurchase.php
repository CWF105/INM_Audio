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
</head>

<body>
    <!-- INCLUDE TOP(FIXED/STICKY) NAV -->
    <?php echo view("includes/header.php"); ?>

    <div class="user-purchase user-main-content">
        <!-- INCLUDE SIDE NAV -->
        <?php echo view("UserSide/sideNav"); ?>
        
        <div class="user-content">
            <div class="content-title">
                <h2>My Purchase</h2>
            </div>

            <div class="card-container">
                <!-- Tab buttons -->
                <div class="purchase-tab">
                    <button onclick="switchTab('Placed-Orders')">Placed Orders</button>
                    <button onclick="switchTab('toShip')">To Ship</button>
                    <button onclick="switchTab('toRecieve')">To Receive</button>
                    <button onclick="switchTab('completed')">Completed</button>
                    <button onclick="switchTab('cancelled')">Cancelled</button>
                </div>

                <!-- TO PAY TAB -->
                <div id="Placed-Orders" class="tab-content active">
                    <h2>Placed Order</h2>

                    <?php if(session()->has('success')) :?>
                        <span style="color: darkgreen;"><?= session()->getFlashdata('success') ?></span>
                    <?php endif;?>
                    <div class="tab-body">
                        <?php if($toConfirmOrders) :?>
                            <?php foreach($toConfirmOrders as $orders) :?>
                                <div class="card">
                                    <div class="top-order">
                                        <img src="<?= $orders->image_url ?>" alt="">
                                        <h3><?= $orders->product_name ?></h3>
                                        <p><span>Price:</span> <span><?= $orders->price ?></span></p>
                                        <p><span>Quantity:</span> <span><?= $orders->quantity ?></span></p>
                                        <p><span>Payment Method:</span> <span><?= $orders->payment_method ?></span></p>
                                        <p><span>Total Price:</span> <span><?= $orders->total_price ?></span></p>
                                    </div>

                                    <div class="bot-order">
                                        <p style="color: darkgreen; font-size: 12px;">Waiting for Confirmation</p>
                                        <a href="<?= base_url('/user/cancelOrder/'.$orders->product_id) ?>">Cancel Order</a>
                                    </div>
                                </div>
                            <?php endforeach;?>
                        <?php else:?>
                            <div class="no-order">
                                <p>NO PLACED ORDER</p>
                            </div>
                        <?php endif;?>
                    </div>
                </div>

                <!-- TO SHIP TAB -->
                <div id="toShip" class="tab-content">
                    <h2>To Ship</h2>

                    <div class="tab-body">
                        <?php if($toShip) :?>
                            <?php foreach($toShip as $ship) :?>
                                <div class="card">
                                    <div class="top-order">
                                        <img src="<?= $ship->image_url ?>" alt="">
                                        <h3><?= $ship->product_name ?></h3>
                                        <p><span>Price:</span> <span><?= $ship->price ?></span></p>
                                        <p><span>Quantity:</span> <span><?= $ship->quantity ?></span></p>
                                        <p><span>Total:</span> <span><?= $ship->totalPrice ?></span></p>
                                        <p><span>Payment:</span> <span><?= $ship->payment_method ?></span></p>
                                    </div>
                                    <div class="bot-order">
                                        <p class="notification">Waiting to Delivery</p>
                                    </div>
                                </div>
                            <?php endforeach;?>
                        <?php else:?>
                            <div class="no-order">
                                <p>NO ORDER TO SHIP</p>
                            </div>
                        <?php endif;?>
                    </div>            
                </div>

                <!-- TO RECIEVE TAB -->
                <div id="toRecieve" class="tab-content">
                    <h2>To Received</h2>

                    <div class="tab-body">
                        <div class="no-order">
                            <p>NO ORDER TO RECEIVED</p>
                        </div>
                    </div>
                </div>

                <!-- COMPLETE TAB -->
                <div id="completed" class="tab-content">
                    <h2>Completed</h2> 

                    <div class="tab-body">
                        <?php if($complete) :?>
                            <?php foreach($complete as $completes) :?>
                                <div class="card">
                                    <div class="top-order">
                                        <img src="<?= $completes->image_url ?>" alt="">
                                        <h3><?= $completes->product_name ?></h3>
                                        <p><span>Price:</span> <span><?= $completes->price ?></span></p>
                                        <p><span>Quantity:</span> <span><?= $completes->quantity ?></span></p>
                                        <p><span>Payment:</span> <span><?= $completes->payment_method ?></span></p>
                                        <p><span>Total:</span> <span><?= $completes->totalPrice ?></span></p>
                                    </div>
                                    <div class="bot-order">
                                        <p class="notification">COMPLETED</p>
                                    </div>
                                </div>
                            <?php endforeach;?>
                        <?php else:?>
                            <div class="no-order">
                                <p>NO COMPLETED ORDER</p>
                            </div>
                        <?php endif;?>
                    </div>             
                </div>

                <!-- TO CANCELLED TAB -->
                <div id="cancelled" class="tab-content">
                    <h2>Cancelled</h2>

                    <div class="tab-body">
                        <?php if($cancelledOrders) : ?>
                            <?php foreach($cancelledOrders as $orders) :?>
                                <div class="card">
                                    <div class="top-order">
                                        <img src="<?= $orders->image_url ?>" alt="">
                                        <h3><?= $orders->product_name ?></h3>
                                        <p><span>Base Price:</span> <span><?= $orders->price ?></span></p>
                                        <p><span>Total Price:</span> <span><?= $orders->totalPrice ?></span></p>
                                        <p><span>Quantity:</span> <span><?= $orders->quantity ?></span></p>
                                        <p><span>Payment:</span> <span><?= $orders->payment_method ?></span></p>
                                        <p><span>Date:</span> <span><?= $orders->date_cancelled ?></span></p>
                                    </div>
                                </div>
                            <?php endforeach;?>
                        <?php else :?>
                            <div class="noCancelledOrders">
                                <p>NO CANCELLED ORDER</p>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
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