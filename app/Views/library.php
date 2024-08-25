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

        <!-- products - gears and modals when click -->
        <div class="card-container">
            <div class="library-card">
                <img src="<?= base_url('assets/img/p1.png') ?>"alt="">
                <h3>Musical Gear</h3>
                <button data-modal-target="#modal">Others</button>

                <div class="modal" id="modal">
                    <div class="modal-header">
                        <div class="title">Musical</div>
                        <button data-close-button class="close-button">&times;</button>
                    </div>
                    <div class="modal-body">
                        <img src="<?= base_url('assets/img/p1.png') ?>" alt="">
                        <h3>Lorem</h3>
                    </div>  
                </div>
            </div>

            <div class="library-card">
                <img src=" <?= base_url('assets/img/p1.png') ?>"alt="">
                <h3>Musical Gear</h3>
                <button data-modal-target="#modal">Others</button>

                <div class="modal" id="modal">
                    <div class="modal-header">
                        <div class="title">Musical</div>
                        <button data-close-button class="close-button">&times;</button>
                    </div>
                    <div class="modal-body">
                        <img src="<?= base_url('assets/img/p1.png') ?>"alt="">
                        <h3>Lorem</h3>
                    </div>  
                </div>
            </div>

            <div class="library-card">
                <img src="<?= base_url('assets/img/p1.png') ?>"alt="">
                <h3>Musical Gear</h3>
                <button data-modal-target="#modal">Others</button>

                <div class="modal" id="modal">
                    <div class="modal-header">
                        <div class="title">Musical</div>
                        <button data-close-button class="close-button">&times;</button>
                    </div>
                    <div class="modal-body">
                        <img src="<?= base_url('assets/img/p1.png') ?>"alt="">
                        <h3>Lorem</h3>
                    </div>  
                </div>
            </div>

            <div class="library-card">
                <img src=" <?= base_url('assets/img/p1.png') ?>"alt="">
                <h3>Musical Gear</h3>
                <button data-modal-target="#modal">Others</button>

                <div class="modal" id="modal">
                    <div class="modal-header">
                        <div class="title">Musical</div>
                        <button data-close-button class="close-button">&times;</button>
                    </div>
                    <div class="modal-body">
                        <img src="<?= base_url('assets/img/p1.png') ?>"alt="">
                        <h3>Lorem</h3>
                    </div>  
                </div>
            </div>
            <div id="overlay"></div>
        </div>
    </div>

<!-- this includes footer.php file on every website that has this code -->
    <?php 
        echo view("others/footer.php");
    ?> 
</body>

</html>