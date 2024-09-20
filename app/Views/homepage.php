<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href=" <?= base_url('assets/css/style.css') ?>">
    <link rel="stylesheet" href=" <?= base_url('assets/css/navbar.css') ?>">
    <link rel="stylesheet" href=" <?= base_url('assets/css/footer.css') ?>">
    <link rel="shortcut icon" href="<?= base_url('assets/img/logo.png') ?>" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <title>INM Audio</title>
    <script defer src="<?= base_url('assets/js/script.js') ?>"></script>
</head>

<body>
    <?php if(session()->get('welcome-user')): ?>
        <span style="color: green; font-family: 'Courier New'; padding-inline: 45%; padding-block: 3px;  background-color: #d9ffd2 ">Welcome <?= esc(session()->get('username')) ?></span>
    <?php endif;?>
<!-- ## -------------------------------------------------------------------------------------------------------------------------------------------------------------- ## -->
<!-- ## -------------------------------------------------------------------------------------------------------------------------------------------------------------- ## -->
<!-- this includes header.php file on every website that has this code -->
    <?php 
        echo view("others/header.php");
        echo view('others/header_text');
    ?>
<!-- ## -------------------------------------------------------------------------------------------------------------------------------------------------------------- ## -->
<!-- ## -------------------------------------------------------------------------------------------------------------------------------------------------------------- ## -->
    <!-- about section -->
    <div class="about">
        
        <div class="about-title">
            <h2>About</h2>
        </div>
        <div class="about-body">
            <div class="about-question">
                <h2>What is IEM</h2>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quis consectetur modi id deserunt voluptatibus obcaecati repellat assumenda eligendi sapiente, voluptas culpa tempore enim vel explicabo, ex molestiae suscipit aliquam nam harum. Perferendis porro repellat delectus recusandae! Natus ad labore quidem molestias, pariatur nihil! Eius tenetur quisquam deleniti asperiores iusto quaerat quis deserunt itaque illo architecto maiores explicabo odit quae reprehenderit, perferendis non, incidunt unde magni quos obcaecati. Atque facere, amet error sint voluptatem, corrupti labore quis, dolorum porro adipisci illum? Totam aut atque vero quae vitae ex unde consequatur blanditiis cupiditate minus, ad cum ratione, sapiente quisquam ipsa quo molestiae?</p>
            </div>
            <div class="about-img">
                <img src="img/nav.png <?= base_url('assets/img/') ?>" alt="">
            </div>
        </div>
    </div>
<!-- ## -------------------------------------------------------------------------------------------------------------------------------------------------------------- ## -->
<!-- ## -------------------------------------------------------------------------------------------------------------------------------------------------------------- ## -->
<!-- product slider section -->
    <div class="product">
        <div class="product-title">
            <h2>Our Product</h2>
        </div>

        <div class="card">
            <div id="image-track" data-mouse-down-at="0" data-prev-percentage="0">
                <img class="image" src="<?= base_url('assets/img/inm1.jpg') ?>" draggable="false" />
                <img class="image" src="<?= base_url('assets/img/inm2.jpg ') ?>" draggable="false" />
                <img class="image" src="<?= base_url('assets/img/inm3.jpg ') ?>" draggable="false" />
                <img class="image" src="<?= base_url('assets/img/pearl.jpg') ?>" draggable="false" />
                <img class="image" src="<?= base_url('assets/img/google-dino.jpg') ?>" draggable="false" />
                <img class="image" src="<?= base_url('assets/img/qdc.jpg') ?>" draggable="false" />
            </div>
        </div>
    </div>
<!-- ## -------------------------------------------------------------------------------------------------------------------------------------------------------------- ## -->
<!-- ## -------------------------------------------------------------------------------------------------------------------------------------------------------------- ## -->
<!-- favorite gears in display -->
    <div class="fav-gear">
        <div class="fav-title">
            <h2>INM Favorite Gear Created</h2>
        </div>
        <div class="card-container">
            <div class="card">
                <img src=" <?= base_url('assets/img/couple.jpg') ?>" alt="">
                <div class="card-content">
                    <div class="meta">Created <br> June 29, 2022 • 1 min</div>
                    <h1>ES X WW</h1>
                    <p>Your Sound, Your Style: Custom IEM Earphones for a Perfect Fit <br> and Unmatched Audio Quality.</p>
                </div>
            </div>

            <div class="card">
                <img src=" <?= base_url('assets/img/couple.jpg') ?>" alt="">
                <div class="card-content">
                    <div class="meta">Created <br> June 29, 2022 • 1 min</div>
                    <h1>ES X WW</h1>
                    <p>Your Sound, Your Style: Custom IEM Earphones for a Perfect Fit <br> and Unmatched Audio Quality.</p>
                </div>
            </div>

            <div class="card">
                <img src=" <?= base_url('assets/img/couple.jpg') ?>" alt="">
                <div class="card-content">
                    <div class="meta">Created <br> June 29, 2022 • 1 min</div>
                    <h1>ES X WW</h1>
                    <p>Your Sound, Your Style: Custom IEM Earphones for a Perfect Fit <br> and Unmatched Audio Quality.</p>
                </div>
            </div>

            <div class="card">
                <img src="<?= base_url('assets/img/couple.jpg') ?>" alt="">
                <div class="card-content">
                    <div class="meta">Created <br> June 29, 2022 • 1 min</div>
                    <h1>ES X WW</h1>
                    <p>Your Sound, Your Style: Custom IEM Earphones for a Perfect Fit <br> and Unmatched Audio Quality.</p>
                </div>
            </div>
        </div>
    </div>
<!-- ## -------------------------------------------------------------------------------------------------------------------------------------------------------------- ## -->
<!-- ## -------------------------------------------------------------------------------------------------------------------------------------------------------------- ## -->
<!-- this includes footer.php file on every website that has this code -->
    <?php 
        echo view("others/footer.php");
    ?> 
<!-- ## -------------------------------------------------------------------------------------------------------------------------------------------------------------- ## -->
<!-- ## -------------------------------------------------------------------------------------------------------------------------------------------------------------- ## -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>