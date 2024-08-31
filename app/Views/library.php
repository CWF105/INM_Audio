<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href=" <?= base_url('assets/css/library.css') ?>">
    <link rel="stylesheet" href=" <?= base_url('assets/css/navbar.css') ?>">
    <link rel="stylesheet" href=" <?= base_url('assets/css/footer.css') ?>">
    <link rel="shortcut icon" href="<?= base_url('assets/img/logo.png') ?>" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <title>Gear Library</title>
    <script defer src="<?= base_url('assets/js/script1.js') ?>"></script>
</head>

<body>

<!-- this includes header.php file on every website that has this code -->
    <?php 
        echo view("others/header.php");
        echo view('others/header_text');
    ?> 

<!-- library main content -->
    <div class="library">
        <div class="library-title">
            <h2>Gear Libary</h2>
        </div>

        <!-- showcase category and show gears modal if click -->
        <div class="card-container">

            <?php if(!empty($categories)) :?>
                <?php foreach($categories as $category) :?>

                    <div class="library-card">
                        <img src="<?= base_url('assets/img/p1.png'); ?>"alt="no gear background is set">
                        <h3><?= esc($category['category']) ?></h3>
                        <button data-modal-target="#modal">View</button>
        
                        <div class="modal" id="modal">

                            <?php if(!empty($gears)) :?>
                                <?php foreach($gears as $gear) :?>

                                    <div class="modal-header">   
                                        <div class="title"></div>
                                        <button data-close-button class="close-button">&times;</button>
                                    </div>
                
                                    <div class="modal-body">
                                        <img src="" alt="">
                                        <h3></h3>
                                    </div>

                                <?php endforeach;?>
                            <?php else :?>

                                <div class="modal-header">   
                                    <h3 style="color: red;"> No gears under this category.</h3>
                                    <button data-close-button class="close-button">&times;</button>
                                </div>

                            <?php endif;?>  

                        </div>
                    </div>
                    <div id="overlay"></div>

                <?php endforeach;?>
            <?php else :?>

                <div class="library-card">
                    <h3 style="color: red;">No Categories</h3>
                </div>

            <?php endif; ?>
            
        </div>
    </div>

<!-- this includes footer.php file on every website that has this code -->
    <?php 
        echo view("others/footer.php");
    ?> 
</body>

</html>