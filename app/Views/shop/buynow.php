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
<!-- @PHP CODE - this includes header.php file on every website that has this code -->
    <?php echo view("includes/header.php"); ?>
<!-- @PHP CODE -->

<!-- Main Section  -->
    <section class="content">
      <form action="<?= base_url('/orderPlaced') ?>" method="post">
        
         <div class="container">
          <!-- container for all the items in the user cart  -->
          <table style="border: 1px solid black; padding: 20px; width: 940px;">
            <thead></thead>
            <tbody>
              <h1>Checkout</h1>
              <a href="<?= base_url('/cart') ?>"><i class="fa-solid fa-cart-shopping"></i></a>
              <?php $grandTotal = 0; ?>
              <!-- title -->
              <td colspan="6"><h3>Items</h3><hr></td>
              <!-- @PHP CODE -->
              <?php foreach ($cartItems as $item):?>
                <tr>
                  <td><img src="<?= $item['image_url']; ?>" alt="gear" style="width: 120px;">&nbsp;&nbsp;&nbsp;</td>
                  <td><?= $item['product_name']; ?>&nbsp;&nbsp;</td>
                  <td><?= number_format($item['price'], 2); ?>&nbsp;&nbsp;</td>
                  <td><?= $item['quantity']; ?>&nbsp;&nbsp;&nbsp;&nbsp;</td>  
                  <td><?= number_format($item['price'] * $item['quantity'], 2); ?>&nbsp;&nbsp;</td>
                </tr>
              <?php $grandTotal += $item['price'] * $item['quantity']; ?>
              <?php endforeach; ?>
              <!-- @PHP CODE -->
              
              <td colspan="6"><hr></td>
              <tr><td><strong>From: </strong> INM Audio gears</td></tr>
              <tr><td><strong>To:</strong> <?= $loc; ?></td></tr>
              <tr>
                  <td colspan="4"><br><br><strong>Total:</strong></td>
                  <td><br><br><strong><?= number_format($grandTotal, 2); ?></strong></td>
                </tr>
              </tbody>
          </table>
        </div>

        <!-- for discount price -->
        <div class="discount"></div>
        
        <!-- buttons for payment method -->
        <div class="container">
          <div class="payment">
            <div class="payment__title">
              Payment Method
            </div>
            <div class="payment-types">
              <button type="button" onclick="filterItems('cod')">Cash on Delivery</button>
              <button type="button" onclick="filterItems('gcash')">Gcash</button>
              <button type="button" onclick="filterItems('paypal')">Paypal</button>
            </div>
          </div>
        </div>

        <!-- payment method -->
        <div class="card-block" id="payment">
          <!-- COD -->
          <div class="card cod">
            <input class="checkbox" name="paymentMethod" id="cod" type="checkbox" value="cod">
            <h3>Cash on Delivery</h3>
          </div>

          <!-- GCASH -->
          <div class="card gcash">  
              <input class="checkbox" name="paymentMethod" id="gcash"  type="checkbox"  value="gcash">
              <img src=" <?= base_url('assets/img/payment/gcash.png') ?>"alt="gcash">
          </div>

          <!-- PAYPAL -->
          <div class="card paypal">
            <input type="checkbox" name="paymentMethod" id="paypal"  value="paypal">
            <img src="<?= base_url('assets/img/payment/paypal.png') ?>"alt="paypal">
          </div>
          
        </div>


        <!-- @ERROR SUCCESS MESSAGES -->
        <?php if(session()->getFlashdata('error')) :?>
        <div class="error-success-message">
          <span style="color: red;"><?= session()->getFlashdata('error')?></span>
        </div>
        <?php endif; ?>
        <!-- @ERROR SUCCESS MESSAGES -->


        <!-- PLACE ORDER BUTTON AND RETURN BACK TO SHOP -->
        <div class="payment-done">
            <button type="submit" class="btn action__submit"><i class="icon icon-arrow-right-circle"></i>Place your Order</button>
            <a href="<?= base_url('/shop') ?>">go back to shop</a>
        </div>
      </form>        
    </section>
 
<!-- @PHP CODE - this includes header.php file on every website that has this code -->
    <?php echo view("includes/footer.php");?>
<!-- @PHP CODE -->
</body>
</html>