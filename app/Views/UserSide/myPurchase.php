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
                <button onclick="switchTab('toPay')">To Pay</button>
                <button onclick="switchTab('toShip')">To Ship</button>
                <button onclick="switchTab('toRecieve')">To Receive</button>
                <button onclick="switchTab('toReturn')">To Return/Refund</button>
                <button onclick="switchTab('completed')">Completed</button>
                <button onclick="switchTab('cancelled')">Cancelled</button>
            </div>

            <!-- TO PAY TAB -->
            <div id="toPay" class="tab-content active">
                <h2>To Pay</h2>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Amet, consequuntur?</p>
            </div>

            <!-- TO SHIP TAB -->
            <div id="toShip" class="tab-content">
                <h2>To Ship</h2>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Amet, consequuntur?</p>
            </div>

            <!-- TO RECIEVE TAB -->
            <div id="toRecieve" class="tab-content">
                <h2>To Receives</h2>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Amet, consequuntur?</p>
            </div>

            <!-- TO RETURN TAB -->
            <div id="toReturn" class="tab-content">
                <h2>To Return/Refund</h2>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Amet, consequuntur?</p>
            </div>

            <!-- COMPLETE TAB -->
            <div id="completed" class="tab-content">
                <h2>Completed</h2>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Amet, consequuntur?</p>
            </div>

            <!-- TO CANCELLED TAB -->
            <div id="cancelled" class="tab-content">
                <h2>Cancelled</h2>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Amet, consequuntur?</p>
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