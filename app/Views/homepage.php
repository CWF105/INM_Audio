<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- @ICON -->
        <link rel="shortcut icon" href="<?= base_url('assets/img/logo.png') ?>" type="image/x-icon">
        <!-- @CSS FILES LINKS -->
        <link rel="stylesheet" href=" <?= base_url('assets/css/style.css') ?>">
        <link rel="stylesheet" href=" <?= base_url('assets/css/navbar.css') ?>">
        <link rel="stylesheet" href=" <?= base_url('assets/css/footer.css') ?>">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer"/>
        
        <title>INM Audio</title>
    </head>

    <body>
        <!-- @PHP CODE  -->
        <?php 
            # includes the header file that contains navbar
            echo view("includes/header.php");      
        ?>
        <!-- @END PHP CODE -->

        <div class="bg">
            <div class="bg2">
                <!-- @PHP CODE  -->
                <?php 
                    # includes the header.introduction file that contains introduction about the website
                    echo view('includes/header_introduction');
                ?>
                <!-- @END PHP CODE -->
            </div>
        </div>

        <!-- @SECTION 2 - about -->
        <div class="about">
            <div class="about-body">
                <div class="about-img">
                    <img src="<?= base_url('assets/img/nav.png') ?>" alt="">
                </div>
                
                <div class="about-question">
                    <div class="about-description">
                        <h3>What is</h3>
                        <h2>IEM AUDIOPHILE</h2>
                        <p>IEM (In-Ear Monitors) are a type of earphones designed for high-quality audio performance, often used by musicians, audio engineers, and audiophiles. Unlike regular earphones, IEMs fit snugly in the ear canal, providing a secure seal that enhances sound isolation and reduces external noise. They are capable of delivering detailed, clear, and balanced sound across a wide frequency range, often with multiple drivers in each earphone to handle different frequencies. IEMs are also known for their ability to offer a customized listening experience, with some models offering swappable cables or adjustable tips for improved comfort and fit. Due to their precise sound reproduction and portability, IEMs are especially popular in live sound environments, professional monitoring, and personal audio use.</p>
                    </div>

                    <a href="<?= base_url(relativePath: '/library') ?>">Gear Library <i class="fa-solid fa-arrow-right"></i></a>
                </div>
            </div>
        </div>
        <!-- @END SECTION ABOUT -->

        <!-- @PRODUCT SECTION - product slider section -->
        <div class="product">
            <div class="product-title">
                <h2>Our Product</h2>
            </div>

            <div class="card">
                <div id="image-track" data-mouse-down-at="0" data-prev-percentage="0">
                    <img class="image" data-modal-target="#modal-1" src="<?= base_url('assets/img/inm1.jpg') ?>" draggable="false" />
                    <img class="image" data-modal-target="#modal-2" src="<?= base_url('assets/img/inm2.jpg ') ?>" draggable="false" />
                    <img class="image" data-modal-target="#modal-3" src="<?= base_url('assets/img/inm3.jpg ') ?>" draggable="false" />
                    <img class="image" data-modal-target="#modal-4" src="<?= base_url('assets/img/pearl.jpg') ?>" draggable="false" />
                    <img class="image" data-modal-target="#modal-5" src="<?= base_url('assets/img/google-dino.jpg') ?>" draggable="false" />
                    <img class="image" data-modal-target="#modal-6" src="<?= base_url('assets/img/qdc.jpg') ?>" draggable="false" />
                </div>

                <div class="details modal" id="modal-1">
                    <div class="img-block">
                        <img class="image" src="<?= base_url('assets/img/inm1.jpg') ?>" draggable="false" />
                    </div>

                    <div class="txt-block">
                        <p class="top">HEART OF TONE</p>

                        <h1>CALYPSO</h1>

                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quia laudantium eaque, cupiditate assumenda expedita ratione, corporis placeat, vero dignissimos sunt ea tenetur voluptates rerum libero quis voluptate quae nostrum beatae!</p>
                    </div>
                </div>

                <div class="details modal" id="modal-2">
                    <div class="img-block">
                        <img class="image" src="<?= base_url('assets/img/inm2.jpg ') ?>" draggable="false" />
                    </div>

                    <div class="txt-block">
                        <p>HEART OF TONE</p>

                        <h1>CALYPSO</h1>

                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quia laudantium eaque, cupiditate assumenda expedita ratione, corporis placeat, vero dignissimos sunt ea tenetur voluptates rerum libero quis voluptate quae nostrum beatae!</p>
                    </div>
                </div>
                <div class="details modal" id="modal-3">
                    <div class="img-block">
                        <img class="image" src="<?= base_url('assets/img/inm3.jpg ') ?>" draggable="false" />
                    </div>

                    <div class="txt-block">
                        <p>HEART OF TONE</p>

                        <h1>CALYPSO</h1>

                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quia laudantium eaque, cupiditate assumenda expedita ratione, corporis placeat, vero dignissimos sunt ea tenetur voluptates rerum libero quis voluptate quae nostrum beatae!</p>
                    </div>
                </div>
                <div class="details modal" id="modal-4">
                    <div class="img-block">
                        <img class="image" src="<?= base_url('assets/img/pearl.jpg') ?>" draggable="false" />
                    </div>

                    <div class="txt-block">
                        <p>HEART OF TONE</p>

                        <h1>CALYPSO</h1>

                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quia laudantium eaque, cupiditate assumenda expedita ratione, corporis placeat, vero dignissimos sunt ea tenetur voluptates rerum libero quis voluptate quae nostrum beatae!</p>
                    </div>
                </div>
                <div class="details modal" id="modal-5">
                    <div class="img-block">
                        <img class="image" src="<?= base_url('assets/img/google-dino.jpg') ?>" draggable="false" />
                    </div>

                    <div class="txt-block">
                        <p>HEART OF TONE</p>

                        <h1>CALYPSO</h1>

                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quia laudantium eaque, cupiditate assumenda expedita ratione, corporis placeat, vero dignissimos sunt ea tenetur voluptates rerum libero quis voluptate quae nostrum beatae!</p>
                    </div>
                </div>
                <div class="details modal" id="modal-6">
                    <div class="img-block">
                        <img class="image" src="<?= base_url('assets/img/qdc.jpg') ?>" draggable="false" />
                    </div>

                    <div class="txt-block">
                        <p>HEART OF TONE</p>

                        <h1>CALYPSO</h1>

                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quia laudantium eaque, cupiditate assumenda expedita ratione, corporis placeat, vero dignissimos sunt ea tenetur voluptates rerum libero quis voluptate quae nostrum beatae!</p>
                    </div>
                </div>
                
                <div id="overlay"></div>
            </div>
        </div>
        <!-- @END SECTION 2 - product slider section -->

        <!-- @SECTION 3 - favorite gears in display -->
        <div class="fav-gear">
            <div class="fav-title">
                <h2>INM Favorite Gear Created</h2>
            </div>
            <div class="card-container">
                <div class="card1">
                    <img src=" <?= base_url('assets/img/couple.jpg') ?>" alt="">
                    <div class="card-content">
                        <div class="meta">Created <br> June 29, 2022</div>
                        <h1>ES X WW</h1>
                        <p>Your Sound, Your Style: Custom IEM Earphones for a Perfect Fit <br> and Unmatched Audio Quality.</p>
                    </div>
                </div>

                <div class="card1">
                    <img src=" <?= base_url('assets/img/fav1.png') ?>" alt="">
                    <div class="card-content">
                        <div class="meta">Created <br> June 29, 2022 </div>
                        <h1>Pearl Sheet</h1>
                        <p>The Custom INM features shells with a mystical pearl-white shimmer, reminiscent of frost-kissed morning dew. </p>
                    </div>
                </div>

                <div class="card1">
                    <img src=" <?= base_url('assets/img/fav2.png') ?>" alt="">
                    <div class="card-content">
                        <div class="meta">Created <br> June 29, 2022</div>
                        <h1>Google Dino</h1>
                        <p>The Custom INM2 Google Dino features a playful homage to the famous Chrome browser offline game, rendered in striking monochromatic style.</p>
                    </div>
                </div>

                <div class="card1">
                    <img src="<?= base_url('assets/img/fav4.png') ?>" alt="">
                    <div class="card-content">
                        <div class="meta">Created <br> June 29, 2022</div>
                        <h1>Universal Vanilla with wooden faceplate</h1>
                        <p>
                        The Universal Vanilla INM3 showcases a luxurious dark tortoiseshell-like finish complemented by striking gold accents.</p>
                    </div>
                </div>
            </div>  
        </div>
        <!-- @END SECTION 3 -->

        <!-- @PHP CODE FOOTER - this includes footer.php file on every website that has this code -->
        <?php echo view("includes/footer.php"); ?> 
        <!-- @PHP CODE END FOOTER  -->

        <!-- OPENS THIS MODAL IF A USER IS LOGGED OUT OR SESSION EXPIRED -->
        <div id="sessionTimeoutModal" class="modal">
            <div class="modal-content">
                <h2>Session Timeout</h2>
                <p><?= session()->getFlashdata('sessionTimeout'); ?></p>
                <button class="close-btn" id="closeModalBtn">Close</button>
            </div>
        </div>

        <!-- @SCRIPTS -->
        <script defer src="<?= base_url('assets/js/script.js') ?>"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
        <script>
            <?php if (session()->getFlashdata('sessionTimeout')): ?>
                document.addEventListener('DOMContentLoaded', function () {
                    const modal = document.getElementById('sessionTimeoutModal');
                    modal.style.display = 'flex';
                });
            <?php endif; ?>
            document.getElementById('closeModalBtn').addEventListener('click', function () {
                const modal = document.getElementById('sessionTimeoutModal');
                modal.style.display = 'none';
            });
        </script>

        <script>
            const openModalButtons = document.querySelectorAll('[data-modal-target]');
            const closeModalButtons = document.querySelectorAll('[data-close-button]');
            const overlay = document.getElementById('overlay');

            // Function to open the modal
            openModalButtons.forEach(button => {
                button.addEventListener('click', () => {
                    const modal = document.querySelector(button.getAttribute('data-modal-target'));
                    openModal(modal);
                });
            });

            // Function to close the modal
            closeModalButtons.forEach(button => {
                button.addEventListener('click', () => {
                    const modal = button.closest('.modal');
                    closeModal(modal);
                });
            });

            // Close the modal when clicking on the overlay
            overlay.addEventListener('click', () => {
                const modals = document.querySelectorAll('.modal.active');
                modals.forEach(modal => {
                    closeModal(modal);
                });
            });

            function openModal(modal) {
                if (modal == null) return;
                modal.classList.add('active');
                overlay.classList.add('active');
            }

            function closeModal(modal) {
                if (modal == null) return;
                modal.classList.remove('active');
                overlay.classList.remove('active');
            }
        </script>
    </body>
</html>