<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href=" <?= base_url('assets/css/shopp.css') ?>">
    <link rel="stylesheet" href=" <?= base_url('assets/css/navbar.css') ?>">
    <link rel="stylesheet" href=" <?= base_url('assets/css/footer.css') ?>">
    <link rel="image/icon" href="<?= base_url('assets/img/logo.png') ?>" type="image/x-icon">

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
            <form action="<?= base_url('/searchGears') ?>" method="get">
                <input type="search" name="search" placeholder="Search Gear">
                <input class="search" type="submit" value="Search">
                <!-- ERROR MESSAGE -->
                <?php if(isset($errorMessage) && !empty($errorMessage)) :?>
                    <span style="color:darkred;"><?= $errorMessage ?></span>
                <?php endif;?>
            </form>
            <?php if(session()->getFlashdata('successAddToCart')) :?>
                <span style="width: 300px; color: green;"><?= session()->getFlashdata('successAddToCart')?></span>
            <?php else :?>
                <span style="width: 450px;"></span>
            <?php endif;?>
            <div class="ss">
                <?php if(session()->has('isLoggedIn')) :?>
                    <a href="<?= base_url('/cart') ?>"><i class="fa-solid fa-cart-shopping"></i></a> <!-- redirect to cart if an account is logged in -->
                <?php else: ?>
                    <a href="<?= base_url('/login') ?>"><i class="fa-solid fa-cart-shopping"></i></a> <!-- redirect to login if an account is not logged in -->
                <?php endif;?>
            </div>
        </div>

        <div class="card-container">      
        <?php if(isset($gears) && !empty($gears)) :?>
            <?php foreach($gears as $index => $gear) :?>
                <div class="library-card" id="<?= esc($gear['product_id']) ?>">
                    <img src="<?= esc($gear['image_url']) ?>" alt="">
                    <h3><?= esc($gear['product_name']) ?></h3>
                    <h4>₱<?= esc($gear['price']) ?></h4>
                    <div class="button">
                        <button data-modal-target="#modal-<?= $index; ?>" class="btn" title="buy or add to cart">Buy</button>
                        <a href="<?= base_url('/bookmark/' . $gear['product_id']) ?>" >
                            <?php 
                            $isBookmarked = false; 
                            if ($isBookmark && !empty($isBookmark)): 
                                foreach ($isBookmark as $bookmark): 
                                    if ($bookmark['product_id'] == $gear['product_id']): 
                                        $isBookmarked = true; 
                                        break; 
                                    endif; 
                                endforeach; 
                            endif; 
                            ?>

                            <?php if ($isBookmarked): ?>
                                <img class="bookmark" src="<?= base_url('assets/img/icons/bookmark.png') ?>" title="saved to likes" alt="saved to likes">
                            <?php else: ?>
                                <img class="bookmark" src="<?= base_url('assets/img/icons/save-instagram.png') ?>" title="save to likes" alt="save to likes">
                            <?php endif; ?>
                        </a>
                    </div>
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
                                    <div class="qlabel">
                                        <label for="quantity">Quantity</label>
                                        <div class="control">
                                            <button type="button" onclick="decreaseValue(<?= $index; ?>)">-</button>
                                            <input type="number" name="quantity" id="quantity-<?= $index ?>" value="1" min="1" readonly>
                                            <button type="button" onclick="increaseValue(<?= $index; ?>)">+</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <hr>
                            <br>
                            <div class="cart-button">
                                <div class="cart">
                                    <button type="submit"><i class="fa-solid fa-cart-shopping"></i>Add to Cart</button>
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
    
<!-- scripts -->
<script>


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