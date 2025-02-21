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
</head>

<body>
    <!-- INCLUDE TOP(FIXED/STICKY) NAV -->
    <?php  echo view("includes/header.php"); ?>

    <div class="user-likes user-main-content">
        <!-- INCLUDE SIDE NAV -->
        <?php echo view("UserSide/sideNav"); ?>

        <!-- MAIN CONTENT -->
        <div class="user-content">
            <div class="content-title">
                <h2>My Likes</h2>
            </div>

            <div class="card-container">
                <div class="tab-content active">
                    <div class="tab-body">
                    <?php if (!empty($bookmark)) : ?>
                        <?php foreach ($bookmark as $product) : ?>
                            <div class="card">
                                <div class="top-order">
                                    <a href="<?= base_url('/shop#'. $product['product_id']) ?>" title="click to view in shop">
                                        <img src="<?= esc($product['image_url']) ?>" alt="<?= esc($product['product_name']) ?>" />
                                    </a>
                                    <h3><?= esc($product['product_name']) ?></h3>
                                </div>
                                
                                <div class="bot-order">
                                    <p>₱<?= esc($product['price']) ?></p>
                                    <a href="<?= base_url('/user/bookmark/' . $product['product_id']) ?>" >
                                        <img class="bookmark" src="<?= base_url('assets/img/icons/bookmark.png') ?>" title="saved to likes" alt="saved to likes" style="width: 30px;"> 
                                    </a>
                                </div>
                            </div>
                            <?php endforeach; ?>
                        <?php else : ?>
                            <p>No Bookmark Found</p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>