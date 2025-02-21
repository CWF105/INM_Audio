

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

            <div class="search">
                <input type="text" placeholder="Search Gear">
                <button><i class="fa-solid fa-search"></i></button>
            </div>
        </div>

        <div class="bg">
            <div class="category">
                <p>Vanilla Series</p>
            </div>
            
            <div class="card-container">
                <?php if(!empty($categories)) :?>
                    <?php foreach($categories as $index => $category) :?>
                        <!-- container -->
                        <div class="library-card" data-modal-target="#modal-<?= $index; ?>" title="A category for gears, click view to see the gears under this category">
                            <img class="bgimg" src="<?= base_url('assets/img/categoryBG.png'); ?>" alt="no gear background is set" title="A category for gears, click view to see the gears under this category">

                            <div class="info">
                                <h3 title="A category for gears, click view to see the gears under this category"><?= esc($category['category']) ?></h3>
                                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, recusandae eaque, ab quaerat corrupti ex molestiae adipisci quibusdam consequuntur ipsam amet. Nulla eos corrupti, rem omnis officiis repudiandae placeat reprehenderit?</p>
                            </div>
                         </div>
    
                        <!-- @MODAL -->
                        <!-- Modal with unique ID -->
                        <div class="modal" id="modal-<?= $index; ?>">
                            <div class="modal-content">
                                <div class="modal-left">
                                    <!-- Filter gears for the current category -->
                                    <?php 
                                        $gearsForCategory = array_filter($gearsPerCategory, function($gear) use ($category) {
                                            return $gear['category_id'] == $category['category_id'];
                                        });
                                    ?>
                                    <!-- displaying gears per category -->
                                    <?php if (!empty($gearsForCategory)) : ?>
                                        <?php foreach ($gearsForCategory as $gear) : ?>
                                            <div class="img-block">
                                                <a href="<?= esc($gear['image_url']) ?>" title="click the image to view" target="_blank">
                                                    <img title="click to view image" src="<?= esc($gear['image_url']) ?>" height="200px" alt="<?= esc($gear['product_name']) ?>">
                                                </a>
                                            </div>

                                            <div class="onHover">
                                                <div class="details">
                                                    <h2><?= esc($gear['product_name']) ?></h2>
                                                    <p><?= esc($gear['description']) ?></p>
                                                </div>

                                                <a class="shopBtn" href="<?= base_url('/shop#'. $gear['product_id']) ?>">Browse in Shop</a>
                                            </div>
                                        <?php endforeach; ?>
                                    <?php else : ?>
                                        <div class="no-gears">
                                            <p>No gears available for this category.</p>
                                        </div>
                                    <?php endif; ?>
                                </div>

                                <div class="modal-right">

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
    </div> 
<!-- @END SECTION 1 -->


<!-- @PHP CODE FOOTER - this includes footer.php file on every website that has this code -->
    <?php echo view("includes/footer.php"); ?> 
<!-- @PHP CODE END FOOTER -->

<!-- @SCRIPTS -->
<script src="<?= base_url('assets/js/category.js') ?>"></script>

</body>
</html>