<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- @ICON -->
    <link rel="shortcut icon" href="<?= base_url('assets/img/logo.png') ?>" type="image/x-icon">
    <!-- @CSS FILES LINKS -->
    <link rel="stylesheet" href=" <?= base_url('assets/css/library.css') ?>">
    <link rel="stylesheet" href=" <?= base_url('assets/css/navbar.css') ?>">
    <link rel="stylesheet" href=" <?= base_url('assets/css/footer.css') ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer"/>
    
    <title>Gear Library</title>
</head>

<body>

<!-- @PHP CODE HEADER - this includes header.php file on every website that has this code -->
    <!-- includes the header file that contains navbar -->
    <?php echo view("includes/header.php"); ?> 
<!-- @END PHP CODE HEADER -->


<!-- @SECTION 1 - library main content -->
    <div class="library">
        <div class="library-title">
            <h2>Gear Libary</h2>
        </div>

        <div class="bg">
            <div class="card-container">
                <?php if(!empty($categories)) :?>
                    <?php foreach($categories as $index => $category) :?>
                        <!-- container -->
                        <div class="library-card" title="A category for gears, click view to see the gears under this category">
                            <img class="bgimg" src="<?= base_url('assets/img/categoryBG.png'); ?>" alt="no gear background is set" title="A category for gears, click view to see the gears under this category">
                            <h3 title="A category for gears, click view to see the gears under this category"><?= esc($category['category']) ?></h3>
                            <button data-modal-target="#modal-<?= $index; ?>">View</button>        
                        </div>
    
                        <!-- @MODAL -->
                        <!-- Modal with unique ID -->
                        <div class="modal" id="modal-<?= $index; ?>">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <div class="title"><h2><?= esc($category['category']) ?></h2></div>
                                    <button data-close-button class="close-button">&times;</button>
                                </div>
                                
                                <div class="modal-body">
                                    <!-- Filter gears for the current category -->
                                    <?php 
                                        $gearsForCategory = array_filter($gearsPerCategory, function($gear) use ($category) {
                                            return $gear['category_id'] == $category['category_id'];
                                        });
                                    ?>
                                    <!-- displaying gears per category -->
                                    <?php if (!empty($gearsForCategory)) : ?>
                                        <?php foreach ($gearsForCategory as $gear) : ?>
                                            <div class="gears">
                                                <div class="con">
                                                    <a href="<?= esc($gear['image_url']) ?>" title="click the image to view" target="_blank">
                                                        <img title="click to view image" src="<?= esc($gear['image_url']) ?>" height="200px" alt="<?= esc($gear['product_name']) ?>">
                                                    </a>
                                                    <a class="shopBtn" href="<?= base_url('/shop#'. $gear['product_id']) ?>">browse in Shop</a>
                                                </div>
                                                
                                                <div class="onHover">
                                                    <h3><?= esc($gear['product_name']) ?></h3>
                                                    <p><?= esc($gear['description']) ?></p><br>
                                                </div>
                                            </div>  
        
                                        <?php endforeach; ?>
                                    <?php else : ?>
                                        <p>No gears available for this category.</p>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div> 
                        <!-- @END MODAL -->
                    <?php endforeach; ?>
                        <div id="overlay"></div>
                <?php else :?>
                    <div class="library-card">
                        <h3 style="color: red;">No Categories</h3>
                    </div>
                <?php endif; ?>
                
            </div>
        </div>
        <!-- showcase category and show gears modal if click -->
    </div> 
<!-- @END SECTION 1 -->


<!-- @PHP CODE FOOTER - this includes footer.php file on every website that has this code -->
    <?php echo view("includes/footer.php"); ?> 
<!-- @PHP CODE END FOOTER -->

<!-- @SCRIPTS -->
<script src="<?= base_url('assets/js/category.js') ?>"></script>

</body>
</html>