<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href=" <?= base_url('assets/css/cart.css') ?>">
    <link rel="stylesheet" href=" <?= base_url('assets/css/navbar.css') ?>">
    <link rel="stylesheet" href=" <?= base_url('assets/css/footer.css') ?>">
    <link rel="shortcut icon" href="<?= base_url('assets/img/logo.png') ?>" type="image/x-icon">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <title>Gear Library</title>
    <script defer src="<?= base_url('assets/js/script.js') ?>"></script>
</head>

<body>
<!-- this includes header.php file on every website that has this code -->
    <?php 
        echo view("others/header.php");
    ?>


<!-- Main Content here -->
    <div class="cart">
        <div class="cart-title">
            <h2>Cart</h2>
        </div>

        <div class="cart-table">
            <div class="card-checkout">
                <div class="select">
                    <input type="checkbox">
                    <button class="card-check">Select All (4)</button>
                    <button class="card-check">Delete</button>
                </div>

                <div class="total">
                    <p>Total (0 item):</p>
                    <p>₱10,000</p>
                    <button class="total-checkout">Check Out</button>
                </div>
            </div>

            <div class="thead">
                <div class="head-one">
                    <p></p>
                    <p>Product</p>
                </div>

                <div class="head-two">
                    <p>Unit Price</p>
                    <p>Quantity</p>
                    <p>Total Price</p>
                    <p>Actions</p>
                </div>
            </div>
            
            <div class="table-body">
                <div class="body-one">
                    <input type="checkbox">
                    <img src="" alt="product image">
                    <p>Title ang ilalagay dito</p>
                </div>
                <div class="body-two">
                    <p>₱10,000</p>
                    <p><input type="number"></p>
                    <p>₱10,000</p>
                    <a href="">Delete</a>
                </div>
            </div>

           
        </div>
    </div>

 <!-- this includes header.php file on every website that has this code -->
    <?php 
        echo view("others/footer.php");
    ?>
</body>
</html>