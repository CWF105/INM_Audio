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
    <title>My Likes</title>
    <style>
        #mylikes { background-color: #555; color: white;}
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
            <h2>MY LIKES</h2>
            <?php if (!empty($bookmark)) : ?>
                <?php foreach ($bookmark as $product) : ?>
                    <fieldset style="width: 210px; padding:5px; display:flex; flex-direction:column; align-items: center; background-color: #9999; margin-bottom:10px;">
                        <div class="bookmarks">
                            <div class="bookmark-item">
                                <a href="<?= base_url('/shop#'. $product['product_id']) ?>" title="click to view in shop">
                                    <img style="width:200px; height:200; border-radius: 5px;" src="<?= esc($product['image_url']) ?>" alt="<?= esc($product['product_name']) ?>" />
                                </a>
                                <h3 style="color:chocolate;"><?= esc($product['product_name']) ?></h3>
                                <p>₱<?= esc($product['price']) ?></p>
                            </div>
                            <a href="<?= base_url('/user/bookmark/' . $product['product_id']) ?>" >
                                <img class="bookmark" src="<?= base_url('assets/img/icons/bookmark.png') ?>" title="saved to likes" alt="saved to likes" style="width: 30px;"> 
                            </a>
                        </div>
                    </fieldset>
                <?php endforeach; ?>
            <?php else : ?>
                <p>No bookmarks found.</p>
            <?php endif; ?>
        </div>
    </main>
</div>
</body>
</html>