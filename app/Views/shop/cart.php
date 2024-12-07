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
    <title>Cart</title>
    <script defer src="<?= base_url('assets/js/script.js') ?>"></script>
</head>

<body>
<!-- this includes header.php file on every website that has this code -->
 <!-- @PHP CODE -->
    <?php echo view("includes/header.php");?>
 <!-- @PHP CODE -->

    
<!-- Main Content here -->
    <div class="cart">
        <div class="cart-title">
            <h2>Cart</h2>
        </div>

        <div class="cart-table">
        <form action="<?= base_url('/cart/delete') ?>" method="post">
            <?php if(isset($cart_items) && !empty($cart_items)) : ?>
                <div class="card-checkout">
                    <div class="select">
                        <button type="submit" class="card-check">Delete All</button>
                    </div>

                    <div class="total">
                        <p>Total (<?= esc($totalQuantity) ?> item<?= ($totalQuantity !== 1) ? 's' : '' ?>):</p>
                        <p>₱<?= esc(number_format($totalPrice, 2)) ?></p>
                        <?php if(isset($cart_items)) :?>
                            <a href="<?=base_url('/buy')?>">
                                <button type="button" class="total-checkout">Check Out</button>
                            </a>
                        <?php else :?>
                            <a href="<?=base_url('/checkOutFailed')?>">
                                <button type="button" class="total-checkout" title="cannot checkout, cart is empty">Check Out</button>
                            </a>
                        <?php endif;?>
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
                    <?php foreach($cart_items as $item) :?>
                        <div class="wawa">
                            <div class="body-one">
                                <img src="<?= esc($item['image_url']) ?>" alt="product image">
                                <p><?= $item['product_name'] ?></p>
                            </div>
                            <div class="body-two">
                                <p>₱<?= esc(number_format($item['price'], 2)) ?></p>
                                <p><?= esc($item['quantity']) ?></p>
                                <p>₱<?= esc(number_format($item['price'] * $item['quantity'], 2)) ?></p>
                                <a href="<?= base_url('/cart/delete/'. $item['cart_item_id']) ?>">Delete</a>
                            </div>
                        </div>
                        <hr>
                        <?php endforeach;?>
                    </div>
                <?php else: ?>
                    <div class="card-checkout">
                        <div class="select">
                            <button type="submit" class="card-check">Delete All</button>
                        </div>

                        <div class="total">
                            <p>Total ( 0 items ):</p>
                            <p>₱ 0.00</p>
                            <button type="button" class="total-checkout">Check Out</button>
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
                        <p style="color: #777; text-align: center; font-size: 24px; background-color: #9999; padding: 150px;">Your cart is empty.</p>
                        <a href="<?=base_url('/shop')?>" style="color: teal; padding:20px; text-decoration:none; text-align: center;">Buy now</a>
                    </div>
                <?php endif;?>    

            </form>
        </div>
    </div>


 <!-- this includes header.php file on every website that has this code -->
    <?php 
        echo view("includes/footer.php");
    ?>

</body>
</html>