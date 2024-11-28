<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= base_url('Admin/css/orderTransactions.css') ?>">
    <link rel="stylesheet" href="<?= base_url('Admin/css/grid.css') ?>">
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
<?php echo view('AdminSide/includes/sideNav') ?>


<!-- 
// * MAIN CONTENT *
-->
<main>
    <div class="header">
        <h3>Orders | Transactions</h2>
        <div class="searchbar">
            <form action="">
                <input type="search" name="search" id="search" placeholder="search here">
                <button type="submit">Search</button>
            </form>
        </div>
    </div>

    <div class="main">
        <div class="orders-details">
            <div class="box" id="box1">
                <img src="<?= base_url('Admin/img/icons/apps-sort.png') ?>" alt="icon">
                <div class="text">
                    <p>Total Orders</p>
                    <p class="val">0</p>
                </div>
            </div>
            
            <div class="box" id="box2">
                <img src="<?= base_url('Admin/img/icons/order-history.png') ?>" alt="icon">
                <div class="text">
                    <p>Placed orders</p>
                    <p class="val">0</p>
                </div>
            </div>

            <div class="box" id="box3">
                <img src="<?= base_url('Admin/img/icons/shipping-fast.png') ?>" alt="icon">
                <div class="text">
                    <p>Delivered</p>
                    <p class="val">0</p>
                </div>
            </div>

            <div class="box" id="box4">
                <img src="<?= base_url('Admin/img/icons/restock.png') ?>" alt="icon">
                <div class="text">
                    <p>Returns</p>
                    <p class="val">0</p>
                </div>
            </div>

            <div class="box" id="box5">
                <img src="<?= base_url('Admin/img/icons/delete.png') ?>" alt="icon">
                <div class="text">
                    <p>Cancelled</p>
                    <p class="val">0</p>
                </div>
            </div>

            <div class="box" id="box6">
                <img src="<?= base_url('Admin/img/icons/clipboard-check.png') ?>" alt="icon">
                <div class="text">
                    <p>Completed</p>
                    <p class="val">0</p>
                </div>
            </div>

            <div class="box" id="box7">
                <img src="<?= base_url('Admin/img/icons/revenue-alt.png') ?>" alt="icon">  
                <div class="text">
                    <p>Total revenue</p>
                    <p class="val">0</p>
                </div>
            </div>
        </div>


        <!-- TABS -->
        <div class="table-orders">
            <div class="container">
                <h2>Order Details</h2>

                <div class="tabs">
                    <button onclick="switchTab('table1')">Orders</button>
                    <button onclick="switchTab('table2')">Completed</button>
                    <button onclick="switchTab('table4')">Refund | Returns</button>
                    <button onclick="switchTab('table5')">Cancelled</button>
                </div>
    
                <!-- TABS PER BUTTON -->
                 <!-- ALL ORDERS -->
                <div id="table1" class="tab-content active">
                    <h2>Orders</h2>
                    <table>
                        <thead>
                            <tr>
                                <th>Order ID</th>
                                <th>Item</th>
                                <th>Customer</th>
                                <th>Delivery Date</th>
                                <th>Price</th>
                                <th>Status</th>
                                <th>PaymentMethod</th>
                                <th>Quantity</th>
                                <th>...</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="th one">45gfgs34fs</td>
                                <td class="th two">
                                    <img src="<?= base_url('Admin/img/icons/account.png')?>" alt="image">
                                    <p>item name</p>
                                </td>
                                <td class="th three">Elle Smith</td>
                                <td class="th four">12-30-2020</td>
                                <td class="th five">199</td>
                                <td class="th six">ongoing</td>
                                <td class="th seven">gcash</td>
                                <td class="th eight">1</td>
                                <td class="th nine">
                                    <!-- in view can set or change the date of delivery, set if its complete, or canclled(note: user can cancelled his order) -->
                                    <a href="#" class="button1 view-button" data-target="viewOrder">View</a>
                                    <a href="" class="button2">complete</a>
                                    <a href="" class="button3">remove</a>
                                </td>
                            </tr>
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
                                <th>Delivery Date</th>
                                <th>Price</th>
                                <th>Status</th>
                                <th>PaymentMethod</th>
                                <th>Quantity</th>
                                <th>Date Completed</th>
                                <th>...</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="th one">fjks234fk</td>
                                <td class="th two">
                                    <img src="<?= base_url('Admin/img/icons/account.png')?>" alt="image">
                                    <p>item name</p>
                                </td>
                                <td class="th three">John Doe</td>
                                <td class="th four">19-18-1923</td>
                                <td class="th five">23456</td>
                                <td class="th six">complete</td>
                                <td class="th seven">cod</td>
                                <td class="th eigth">3</td>
                                <td class="th">19-20-1923</td>
                                <td class="th nine">
                                    <a href="" class="button3">delete</a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- RETURNS | REFUNDS -->
                <div id="table4" class="tab-content">
                    <h2>Refund | Returns</h2>
                    <table>
                        <thead>
                            <tr>
                                <th>Order ID</th>
                                <th>Item</th>
                                <th>Customer</th>
                                <th>Delivery Date</th>
                                <th>Price</th>
                                <th>Status</th>
                                <th>PaymentMethod</th>
                                <th>Quantity</th>
                                <th>Date Returned</th>
                                <th>...</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="th one">fjks234gdfk</td>
                                <td class="th two">
                                    <img src="<?= base_url('Admin/img/icons/account.png')?>" alt="image">
                                    <p>item name</p>
                                </td>
                                <td class="th three">willy Doe</td>
                                <td class="th four">19-12-1933</td>
                                <td class="th five">2336</td>
                                <td class="th six">Returned</td>
                                <td class="th seven">cod</td>
                                <td class="th eight">3</td>
                                <td class="th ten">19-20-1923</td>
                                <td class="th nine">
                                    <a href=""  class="button3">delete</a>
                                </td>
                            </tr>
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
                                <th>Delivery Date</th>
                                <th>Price</th>
                                <th>Status</th>
                                <th>PaymentMethod</th>
                                <th>Quantity</th>
                                <th>Date Cancelled</th>
                                <th>...</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="th one">fjks234gdfk</td>
                                <td class="th two">
                                    <img src="<?= base_url('Admin/img/icons/account.png')?>" alt="image">
                                    <p>item name</p>
                                </td>
                                <td class="th three">willy Doe</td>
                                <td class="th four">19-12-1933</td>
                                <td class="th five">2336</td>
                                <td class="th six">Returned</td>
                                <td class="th seven">cod</td>
                                <td class="th eigth">3</td>
                                <td class="th ten">19-20-1923</td>
                                <td class="th nine">
                                    <a href=""  class="button3">delete</a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</main>


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
<script src="<?= base_url('Admin/js/orderTransactions.js') ?>"></script>
</body>
</html>