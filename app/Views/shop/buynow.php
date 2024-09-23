<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href=" <?= base_url('assets/css/buynow.css') ?>">
    <link rel="stylesheet" href=" <?= base_url('assets/css/navbar.css') ?>">
    <link rel="stylesheet" href=" <?= base_url('assets/css/footer.css') ?>">
    <link rel="shortcut icon" href="<?= base_url('assets/img/logo.png') ?>" type="image/x-icon">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <title>INM Admin</title>
    <script defer src="<?= base_url('assets/js/script.js') ?>"></script>
</head>
<body>
<!-- this includes header.php file on every website that has this code -->
    <?php 
        echo view("includes/header.php");
    ?>

<!-- Main Section  -->
    <section class="content">

        <div class="container">
      
        </div>
        <div class="details shadow">
          <div class="details__item">
      
            <div class="item__image">
              <img class="earphone" src=" <?= base_url('assets/img/about.jpg') ?>" alt="">
            </div>
            <div class="item__details">
              <div class="item__title">
                Earphone
              </div>
              <div class="item__price">
                ₱ 10,000
              </div>
              <div class="item__quantity">
                Quantity: 1
              </div>
              <div class="item__description">
      
              </div>
            </div>
          </div>
        </div>
      
        <div class="discount"></div>
        
        <div class="container">
          <div class="payment">
            <div class="payment__title">
              Payment Method
            </div>
            <div class="payment-types">
              <button onclick="filterItems('cod')">Cash on Delivery</button>
              <button onclick="filterItems('gcash')">Gcash</button>
              <button onclick="filterItems('paypal')">Paypal</button>
              <button onclick="filterItems('bank')">Online Banking</button>
            </div>
          </div>
        </div>
    
            <div class="card-block">
              <div class="card cod">
                <h3>Cash on Delivery</h3>
              </div>
            
                  <div class="card gcash">  
                      <input class="checkbox" type="checkbox">
                      <img src=" <?= base_url('assets/img/payment/gcash.png') ?>"alt="">
                  </div>
        
                  <div class="card paypal">
                    <input type="checkbox">
                    <img src="<?= base_url('assets/img/payment/paypal.png') ?>"alt="">
                  </div>
        
                  <div class="card bank">
                    <input type="checkbox">
                    <img src="<?= base_url('assets/img/payment/banktransfer.png') ?>" alt="">
                  </div>
            </div>
      
      
            <div class="payment-done">
              <a href="<?= base_url('/donePurchase') ?>" class="btn action__submit">Place your Order
                <i class="icon icon-arrow-right-circle"></i>
              </a>
              <a href="<?= base_url('/shop') ?>" class="btn btnn">Go Back to Shop</a>
            </div>
      </section>

<!-- this includes header.php file on every website that has this code -->
    <?php 
        echo view("includes/footer.php");
    ?>
</body>
</html>