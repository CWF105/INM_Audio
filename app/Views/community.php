<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href=" <?= base_url('assets/css/comm.css') ?>">
    <link rel="stylesheet" href=" <?= base_url('assets/css/navbar.css') ?>">
    <link rel="stylesheet" href=" <?= base_url('assets/css/footer.css') ?>">
    <link rel="shortcut icon" href="<?= base_url('assets/img/logo.png') ?>" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <title>INM Community</title>
    <script defer src="<?= base_url('assets/js/script.js') ?>"></script>
    
</head>
<body>
 <!-- @PHP CODE -->
    <?php 
        # includes the header file that contains navbar
        echo view("includes/header.php");
    ?>
<!-- @END PHP CODE -->



<!-- @SECTION 2 - products -->
<div class="comm-container">
        <div class="comm-title">
            <h2>INM Community</h2>
        </div>
        <div class="comm-block">
            <div class="picture-block">
                <!-- product 1 -->
                <a href="#reviews" class="comm-picture" onclick="toggleComment('comment1')">
                    <img src=" <?= base_url('assets/img/comm1.jpg') ?>" alt="">
                    <p>GEAR 1</p>
                </a>
                <!-- product 2 -->
                <a href="#reviews" class="comm-picture" onclick="toggleComment('comment2')">
                    <img src=" <?= base_url('assets/img/comm2.jpg') ?>"alt="">
                    <p>GEAR 2</p>
                </a>
                <!-- product 3 -->
                <a href="#reviews" class="comm-picture" onclick="toggleComment('comment3')">
                    <img src=" <?= base_url('assets/img/comm3.jpg') ?>" alt="">
                    <p>GEAR 3</p>
                </a>
            </div>
            <div class="picture-block">
                 <!-- product 4 -->
                <a href="#reviews" class="comm-picture" onclick="toggleComment('comment4')">
                    <img src=" <?= base_url('assets/img/comm4.jpg') ?>"alt="">
                    <p>GEAR 4</p>
                </a>
                <!-- product 5 -->
                <a href="#reviews" class="comm-picture" onclick="toggleComment('comment5')">
                    <img src=" <?= base_url('assets/img/comm5.jpg') ?>" alt="">
                    <p>GEAR 5</p>
                </a>
                <!-- product 6 -->
                <a href="#reviews" class="comm-picture" onclick="toggleComment('comment6')">  
                    <img src=" <?= base_url('assets/img/comm6.jpg') ?>"alt="">
                    <p>GEAR 6</p>
                </a>
            </div>
           
        <!-- reviews -->
        </div>
        <div class="reviews" id="reviews">
            <div class="review-title">
                <h2>Reviews</h2>
            </div>
        </div>

        <div class="comm-reviews">
            <div class="comment comment1">
                <div class="card">
                    <div class="user">
                        <img src=" <?= base_url('assets/img/avatar.png') ?>" alt="">
                        <p>User Name</p>
                    </div>

                    <div class="user-comment">
                        <p>jidhahsbdajdfnoajsdbia shduasdyjasdohbcladsjlca sgdkcjsdckasdcjbhdc</p>
                    </div>
                </div>
                <div class="card">
                    <div class="user">
                        <img src="<?= base_url('assets/img/avatar.png') ?>" alt="">
                        <p>User Name</p>
                    </div>

                    <div class="user-comment">
                        <p>jidhahsbdajdfnoajsdbia shduasdyjasdohbcladsjlca sgdkcjsdckasdcjbhdc</p>
                    </div>
                </div>
            </div>

            <div class="comment comment2">
                <div class="card">
                    <div class="user">
                        <img src="<?= base_url('assets/img/avatar.png') ?>" alt="">
                        <p>User Name</p>
                    </div>

                    <div class="user-comment">
                        <p>adoidhadbfnoiajdfnoaj</p>
                    </div>
                </div>
            </div>

            <div class="comment comment3">
                <div class="card">
                    <div class="user">
                        <img src="<?= base_url('assets/img/avatar.png') ?>" alt="">
                        <p>User Name</p>
                    </div>

                    <div class="user-comment">
                        <p>SFASDFSDGSD</p>
                    </div>
                </div>
                <div class="card">
                    <div class="user">
                        <img src="<?= base_url('assets/img/avatar.png') ?>" alt="">
                        <p>User Name</p>
                    </div>

                    <div class="user-comment">
                        <p>SFASDFSDGSD</p>
                    </div>
                </div>
                <div class="card">
                    <div class="user">
                        <img src="<?= base_url('assets/img/avatar.png') ?>" alt="">
                        <p>User Name</p>
                    </div>

                    <div class="user-comment">
                        <p>SFASDFSDGSD</p>
                    </div>
                </div>
            </div>

            <div class="comment comment4">
                <div class="card">
                    <div class="user">
                        <img src="<?= base_url('assets/img/avatar.png') ?>" alt="">
                        <p>User Name</p>
                    </div>

                    <div class="user-comment">
                        <p>jidhahsbdajdfnoajsdbia shduasdyjasdohbcladsjlca sgdkcjsdckasdcjbhdc</p>
                    </div>
                </div>
                <div class="card">
                    <div class="user">
                        <img src="<?= base_url('assets/img/avatar.png') ?>" alt="">
                        <p>User Name</p>
                    </div>

                    <div class="user-comment">
                        <p>jidhahsbdajdfnoajsdbia shduasdyjasdohbcladsjlca sgdkcjsdckasdcjbhdc</p>
                    </div>
                </div>
            </div>

            <div class="comment comment5">
                <div class="card">
                    <div class="user">
                        <img src="<?= base_url('assets/img/avatar.png') ?>" alt="">
                        <p>User Name</p>
                    </div>

                    <div class="user-comment">
                        <p>DFADFA;LFIAHRFJKN KJLIUHB</p>
                    </div>
                </div>
            </div>

            <div class="comment comment6">
                <div class="card">
                    <div class="user">
                        <img src="<?= base_url('assets/img/avatar.png') ?>" alt="">
                        <p>User Name</p>
                    </div>

                    <div class="user-comment">
                        <p>asdasfsdfijrufwayhefuqiwejfqokejfu4r91373</p>
                    </div>
                </div>
                <div class="card">
                    <div class="user">
                        <img src="<?= base_url('assets/img/avatar.png') ?>" alt="">
                        <p>User Name</p>
                    </div>

                    <div class="user-comment">
                        <p>asdasfsdfijrufwayhefuqiwejfqokejfu4r91373</p>
                    </div>
                </div>
                <div class="card">
                    <div class="user">
                        <img src="<?= base_url('assets/img/avatar.png') ?>" alt="">
                        <p>User Name</p>
                    </div>

                    <div class="user-comment">
                        <p>asdasfsdfijrufwayhefuqiwejfqokejfu4r91373</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
<!-- @END SECTION products -->



<!-- @PHP CODE FOOTER - this includes footer.php file on every website that has this code -->
<?php echo view("includes/footer.php"); ?> 
<!-- @PHP CODE END FOOTER  -->


<!-- @SCRIPTS -->

</body>
</html>