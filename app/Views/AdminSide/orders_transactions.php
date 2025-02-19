<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= base_url('Admin/css/orderTransactions.css') ?>">
    <link rel="stylesheet" href="<?= base_url('Admin/css/dashboard1.css') ?>">
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="<?= base_url('Admin/css/notifModal.css') ?>">

    <title>Orders | Transactions</title>
    <style>
        /* SIDE NAV WHEN IN THIS PAGE - below css selectors can be found in the "sideNav.php" file */
        #order_transaction { background-color: #d4ebf844; }
        aside nav ul #order_transaction span { opacity: 1;}
    </style>
</head>
<body>
<!-- 
// * INCLUDE THE SIDE NAVIGATION FILE *
-->
<?php echo view('AdminSide/includes/notifModal') ?>
<?php echo view('AdminSide/includes/sideNav1') ?>


    <section id="content">  
        <nav>
			<i class='bx bx-menu' ></i>
			<!-- <a href="#" class="nav-link">Categories</a> -->
			<form action="#">
				<div class="form-input">
					<!-- <input type="search" placeholder="Search..."> -->
					<button type="submit" class="search-btn"><i class='bx bx-submit' disabled></i></button>
				</div>
			</form>
            <label for="switch-mode">Theme</label>
			<input type="checkbox" id="switch-mode" hidden>
			<label for="switch-mode" class="switch-mode"></label>
            <button class="notification open-modal1">
				<i class='bx bxs-bell' ></i>
				<span class="num">8</span>
			</button>
		</nav>

        <main>
            <div class="head-title">
				<div class="left">
					<h1>Order | Transactions</h1>
					<ul class="breadcrumb">
						<!-- <li>
							<a href="#">Dashboard</a>
						</li>
						<li><i class='bx bx-chevron-right' ></i></li>
						<li>
							<a class="active" href="#">Home</a>
						</li> -->
					</ul>
				</div>
            </div>
<!-- 				
            <ul class="box-info">
                <li>
                    <i class='bx bxs-calendar-check' ></i>
                    <span class="text">
                        <h3><?php echo ($totalOrders) ? $totalOrders->totalOrders : 0;?></h3>
                        <p>Total Orders</p>
                    </span>
                </li>
                <li>
                    <i class='bx bxs-group' ></i>
                    <span class="text">
                        <h3><?php echo ($totalPlaced) ? $totalPlaced->totalPlacedOrders : 0;?></h3>
                        <p>Placed Orders</p>
                    </span>
                </li>
                <li>
                    <i class='bx bxs-dollar-circle' ></i>
                    <span class="text">
                        <h3><?php echo ($totalCancelled) ? $totalCancelled->totalCancelled : 0;?></h3>
                        <p>Cancelled</p>
                    </span>
                </li>
                <li>
                    <i class='bx bxs-dollar-circle' ></i>
                    <span class="text">
                        <h3><?php echo ($totalComplete) ? $totalComplete->totalComplete : 0;?></h3>
                        <p>Completed</p>
                    </span>
                </li>
                <li>
                    <i class='bx bxs-dollar-circle' ></i>
                    <span class="text">
                        <h3><?php echo ($totalRevenue->totalRevenue > 0) ? "$".$totalRevenue->totalRevenue : "$0";?></h3>
                        <p>Total Revenue</p>
                    </span>
                </li>
            </ul>  -->

            <!-- TABS -->
            <div class="table-orders">
                <div class="container">
                    <h2>Order Details</h2>

                    <div class="tabs">
                        <button onclick="switchTab('table0')">Confirm Orders</button>
                        <button onclick="switchTab('table1')">Orders</button>
                        <button onclick="switchTab('table2')">Completed</button>
                        <!-- <button onclick="switchTab('table4')">Refund | Returns</button> -->
                        <button onclick="switchTab('table5')">Cancelled</button>
                    </div>
    
                    <div id="table0" class="tab-content">
                        <h2>Confirm orders</h2>
                        <table>
                            <thead>
                                <tr>
                                    <th>Placed Order ID</th>
                                    <th>Item</th>
                                    <th>Customer</th>
                                    <th>Base Price</th>
                                    <th>Quantity</th>
                                    <th>Total Price</th>
                                    <th>PaymentMethod</th>
                                    <th>Date placed</th>
                                    <th>...</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if($confirmOrder) : ?>
                                    <?php foreach($confirmOrder as $order) :?>
                                        <tr> 
                                            <td class="th one"><?= $order->placed_order_id ?></td>
                                            <td class="th two">
                                                <img src="<?= $order->image_url ?>" alt="image">
                                                <p><?= $order->product_name ?></p>
                                            </td>
                                            <td class="th three"><?= $order->firstname." ".$order->lastname ?></td>
                                            <th class="th five"><?= $order->price ?></th>
                                            <td class="th five"><?= $order->quantity ?></td>
                                            <td class="th six"><?= $order->total_price ?></td>
                                            <td class="th seven"><?= $order->payment_method ?></td>
                                            <td class="th eight"><?= $order->date_placed ?></td>
                                            <td class="th nine">
                                                <a href="<?= base_url('/admin/order/toConfirm/'.$order->placed_order_id) ?>" class="button2">Confirm order</a>
                                                <a href="<?= base_url('/admin/order/cancelToConfirm/'.$order->placed_order_id) ?>" class="button3">Cancel order</a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else :?>
                                    <tr>
                                        <td colspan="9">No placed orders</td>
                                    </tr>
                                <?php endif;?>
                            </tbody>
                        </table>
                    </div>

                    
                    <!-- comfrimed orders -->
                    <div id="table1" class="tab-content active">
                        <h2>Orders</h2>
                        <table>
                            <thead>
                                <tr>
                                    <th>Order ID</th>
                                    <th>Item</th>
                                    <th>Customer</th>
                                    <th>Base Price</th>
                                    <th>Quantity</th>
                                    <th>Total Price</th>
                                    <th>PaymentMethod</th>
                                    <th>Status</th>
                                    <!-- <th>Delivery Date</th> -->
                                    <th>Date placed</th>
                                    <th>...</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if($orders) :?>
                                    <?php foreach($orders as $order) :?>
                                        <tr>
                                            <td class="th one"><?= $order->order_id ?></td>
                                            <td class="th two">
                                                <img src="<?= $order->image_url ?>" alt="image">
                                                <p><?= $order->product_name ?></p>
                                            </td>
                                            <td class="th three"><?= $order->firstname." ".$order->lastname ?></td>
                                            <td class="th five"><?= $order->price ?></td>
                                            <td class="th six"><?= $order->quantity ?></td>
                                            <td class="th seven"><?= $order->totalPrice ?></td>
                                            <td class="th eight"><?= $order->payment_method ?></td>
                                            <td class="th eight"><?= $order->order_status ?></td>
                                            <td class="th eight"><?= $order->created_at ?></td>
                                            <td class="th nine">
                                                <!-- in view can set or change the date of delivery, set if its complete, or canclled(note: user can cancelled his order) -->
                                                <a href="#" class="button1 view-button" data-target="viewOrder">View</a>
                                                <a href="<?= base_url('/admin/order/complete/'.$order->order_id) ?>" class="button2">complete</a>
                                                <a href="<?= base_url('/admin/order/cancelConfirmOrder/'.$order->order_id) ?>" class="button3">Cancel</a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="9">No confirmed Orders</td>
                                    </tr>
                                <?php endif;?>
                            </tbody>
                        </table>
                    </div>
                
                    <!-- COMPLETED -->
                    <div id="table2" class="tab-content">
                        <h2>Completed</h2>
                        <table>
                            <thead>
                                <tr>
                                    <th>Order ID</th>
                                    <th>Item</th>
                                    <th>Customer</th>
                                    <!-- <th>Delivery Date</th> -->
                                    <th>Base Price</th>
                                    <th>Quantity</th>
                                    <th>Total Price</th>
                                    <th>PaymentMethod</th>
                                    <th>Status</th>
                                    <th>Date Completed</th>
                                    <th>...</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if($complete) :?>
                                    <?php foreach($complete as $completes) :?>
                                        <tr>
                                            <td class="th one"><?= $completes->order_id ?></td>
                                            <td class="th two">
                                                <img src="<?= $completes->image_url ?>" alt="image">
                                                <p><?= $completes->product_name ?></p>
                                            </td>
                                            <td class="th three"><?= $completes->firstname." ".$completes->lastname ?></td>
                                            <td class="th four"><?= $completes->price ?></td>
                                            <td class="th five"><?= $completes->quantity ?></td>
                                            <td class="th six"><?= $completes->totalPrice ?></td>
                                            <td class="th seven"><?= $completes->payment_method ?></td>
                                            <td class="th eigth"><?= $completes->order_status ?></td>
                                            <td class="th"><?= $completes->date_completed ?></td>
                                            <td class="th nine">
                                                <a href="<?= base_url('/admin/order/deleteComplete/'.$completes->order_id) ?>" class="button3">delete</a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="9">No complete Orders</td>
                                    </tr>
                                <?php endif;?>
                            </tbody>
                        </table>
                    </div>


                    <!-- CANCELLED -->
                    <div id="table5" class="tab-content">
                        <h2>Cancelled</h2>
                        <table>
                            <thead>
                                <tr>
                                    <th>Order ID</th>
                                    <th>Item</th>
                                    <th>Customer</th>
                                    <th>Price</th>
                                    <th>Status</th>
                                    <th>PaymentMethod</th>
                                    <th>Quantity</th>
                                    <th>Date Cancelled</th>
                                    <th>...</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if($cancelledOrders) :?>
                                    <?php foreach($cancelledOrders as $cancelled): ?>
                                        <tr>
                                            <td class="th one"><?= $cancelled->order_id ?></td>
                                            <td class="th two">
                                                <img src="<?= $cancelled->image_url ?>" alt="image">
                                                <p><?= $cancelled->product_name ?></p>
                                            </td>
                                            <td class="th three"><?= $cancelled->firstname." ".$cancelled->lastname ?></td>
                                            <td class="th five"><?= $cancelled->totalPrice ?></td>
                                            <td class="th six"><?= $cancelled->order_status ?></td>
                                            <td class="th seven"><?= $cancelled->payment_method ?></td>
                                            <td class="th eigth"><?= $cancelled->quantity ?></td>
                                            <td class="th ten"><?= $cancelled->date_cancelled ?></td>
                                            <td class="th nine">
                                                <a href="<?= base_url('/admin/order/cancelled/'.$cancelled->order_id) ?>"  class="button3">delete</a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="9">No cancelled Orders</td>
                                    </tr>
                                <?php endif;?>
                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </main>
    </section>  


<!-- MODALS -->
<div id="viewOrder" class="modal">
    <div class="modal-content">
        <div class="add">
            <span class="close close-gear">&times;</span>
            <h2>Order</h2>  
            <h6>Order ID: 8247</h6>
        </div>  
        
        <div class="content">
            <div class="item">
                <h4>Item Name</h4>
                <img src="" alt="IMAGE">
            </div>
            <div class="quantity">
                <h4>Quantity</h4>
                <p>1</p>
            </div>
            <div class="price">
                <h4>Price</h4>
                <p>1542</p>
            </div>
            <div class="customer">
                <h4>Customer</h4>
                <p>John Doe</p>
            </div>
            <div class="deliver">
                <h4>Deliver Date</h4>
                <p>19-19-1999</p>
            </div>
            <div class="payment_method">
                <h4>Payment Method</h4>
                <p>COD</p>
            </div>
            <div class="actions">
                <a href="" class="button2">complete</a>
                <a href="" class="button3">remove</a>
            </div>
        </div>
    </div>

</div>

<script src="<?= base_url('Admin/js/notifModal.js') ?>"></script>
<script src="<?= base_url('Admin/js/orderTransactions.js') ?>"></script>
<script src="<?= base_url('Admin/js/dashboard1.js') ?>"></script>
</body>
</html>