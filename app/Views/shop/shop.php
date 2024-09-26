<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href=" <?= base_url('assets/css/shopp.css') ?>">
    <link rel="stylesheet" href=" <?= base_url('assets/css/navbar.css') ?>">
    <link rel="stylesheet" href=" <?= base_url('assets/css/footer.css') ?>">
    <link rel="shortcut icon" href="<?= base_url(relativePath: 'assets/img/logo.png') ?>" type="image/x-icon">

    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <title>INM Shop</title>
    <script defer src="<?= base_url('assets/js/script2.js') ?>"></script>
</head>
<body>
<!-- this includes header.php file on every website that has this code -->
   <?php 
        echo view("includes/header.php");
    ?>

<!-- main shop -->
    <div class="shop">
        <div class="shop-title">
            <h2>Shop</h2>
            <div class="ss">
                <a href="<?= base_url('/cart') ?>"><i class="fa-solid fa-cart-shopping"></i></a>
            </div>
        </div>

        <div class="card-container">      
        <?php if(isset($gears) && !empty($gears)) :?>
            <?php foreach($gears as $index => $gear) :?>
                <div class="library-card" id="<?= esc($gear['product_id']) ?>">
                    <img src="<?= esc($gear['image_url']) ?>" alt="">
                    <h3><?= esc($gear['product_name']) ?></h3>
                    <h4>₱<?= esc($gear['price']) ?></h4>
                    <button data-modal-target="#modal-<?= $index; ?>" class="btn">Buy</button>
                </div>  

            <!-- MODAL -->
            <div class="modal" id="modal-<?= $index; ?>">
                <div class="modal-header">
                    <div class="product-img" title>
                        <img src="<?= esc($gear['image_url']) ?>"alt="<?= esc($gear['product_name']) ?>">
                    </div>

                    <form action="<?= base_url('/cart/add/'. $gear['product_id']) ?>" method="post">
                        <input type="hidden" name="price" id="price" value="<?= $gear['price'] ?>">
                        <div class="product-details">
                            <p><?= esc($gear['product_name']) ?></p>
                            <h3>₱<?= esc($gear['price']) ?></h3>
                            <hr>
                            <div class="inputs">                

                                <div class="quantity">
                                    <label for="quantity">Quantity</label>
                                    <input type="number" name="quantity" id="quantity-<?= $index ?>" value="1" min="1" readonly>
                                    <div class="control">
                                        <button type="button" onclick="decreaseValue(<?= $index; ?>)">-</button>
                                        <button type="button" onclick="increaseValue(<?= $index; ?>)">+</button>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <hr>
                            <br>
                            <div class="cart-button">
                                <div class="cart">
                                    <button type="submit">Add to Cart</button>
                                </div>

                                <div class="buy">
                                    <a href="<?= base_url('/buy') ?>">
                                        <button type="button">Buy Now</button>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </form>

                    <button data-close-button class="close-button">&times;</button>
                </div>
            </div>

            <?php endforeach;?>
        <?php else: ?>
            <div class="library-card">
                <h3 style="color: red;">Gears are not available at the mean time</h3>
            </div>
        <?php endif;?>
        </div>
        
        
    <div id="overlay"></div>
    <div class="modal" id="modal">
        
    </div>

    
</div>

<!-- this includes header.php file on every website that has this code -->
    <?php 
        echo view("includes/footer.php");
    ?>
    

    <!-- modal -->
    <!-- newly logged in modal show -->
    <div class="modal fade" id="myModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <center>
                    <span style="color: green; font-size: 24px; padding: 15px;">
                        <?= session()->get('successAddToCart'); ?>
                    </span>
                </center>
                <center>
                    <button type="button" style="font-size: 10px; width: 100px; padding: 10px;" class="btn btn-danger" data-bs-dismiss="modal">
                        Close
                    </button> 
                </center>
            </div>
        </div>
    </div>

<!-- scripts -->
<script>
     <?php if(session()->getFlashdata('successAddToCart')): ?>
        var myModal = new bootstrap.Modal(document.getElementById('myModal'));
        myModal.show();
    <?php endif; ?>

     // Increase quantity for the specific product
     function increaseValue(index) {
        var quantityInput = document.getElementById('quantity-' + index);
        quantityInput.value = parseInt(quantityInput.value) + 1;
    }

    // Decrease quantity for the specific product, but don't go below 1
    function decreaseValue(index) {
        var quantityInput = document.getElementById('quantity-' + index);
        if (quantityInput.value > 1) {
            quantityInput.value = parseInt(quantityInput.value) - 1;
        }
    }
</script>
</body>
</html>