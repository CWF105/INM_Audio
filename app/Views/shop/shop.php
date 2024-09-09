<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href=" <?= base_url('assets/css/shopp.css') ?>">
    <link rel="stylesheet" href=" <?= base_url('assets/css/navbar.css') ?>">
    <link rel="stylesheet" href=" <?= base_url('assets/css/footer.css') ?>">
    <link rel="shortcut icon" href="<?= base_url('assets/img/logo.png') ?>" type="image/x-icon">

    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <title>INM Shop</title>
    <script defer src="<?= base_url('assets/js/script2.js') ?>"></script>
</head>
<body>
<!-- this includes header.php file on every website that has this code -->
   <?php 
        echo view("others/header.php");
    ?>

<!-- main shop -->
    <div class="shop">
        <div class="shop-title">
            <h2>Shop</h2>
            <div class="ss">
                <form action="" action="post">
                    <input type="search" name="search">
                    <button type="submit">Search</button>
                </form>
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
                    <button data-modal-target="#modal-<?= $index; ?>" class="btn">View</button>
                </div>

            <!-- MODAL -->
            <div class="modal" id="modal-<?= $index; ?>">
                <div class="modal-header">
                    <div class="product-img" title>
                        <img src="<?= esc($gear['image_url']) ?>"alt="<?= esc($gear['product_name']) ?>">
                    </div>

                    <div class="product-details">
                        <p><?= esc($gear['product_name']) ?></p>
                        <h3>₱<?= esc($gear['price']) ?></h3>  

                        <div class="dropdown-container">
                            <label for="size">Size</label>
                            <select id="size" name="size">
                                <option>Select</option>
                                <option>Small</option>
                            </select>
                         </div>

                        <div class="quantity">
                            <h3>Quantity</h3>
                            <input class="number-input" type="number" >
                        </div>

                        <div class="cart-button">
                            <div class="cart">
                                <a href="<?= base_url('/cart') ?>">
                                    <button>Add to Cart</button>
                                </a>
                            </div>

                            <div class="buy">
                                <a href="<?= base_url('/buy') ?>">
                                    <button>Buy Now</button>
                                </a>
                            </div>
                        </div>
                    </div>
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
        echo view("others/footer.php");
    ?>
    
</body>
</html>