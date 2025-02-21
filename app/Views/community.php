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

    <div class="community-container">
        <div class="review-container">
            <div class="img-block">
                <img src="assets/img/logo.png" alt="">
            </div>

            <div class="reviews">
                <div class="review-block">
                    <div class="user-profile">
                        <img src="assets/img/logo.png" alt="">
                        <p>Username</p>
                    </div>
    
                    <div class="user-review">
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Placeat praesentium quasi fuga ipsa. Odit, dolorem enim. At voluptas iure quas minima impedit incidunt iste, amet quisquam voluptatem animi voluptate itaque!</p>
                    </div>
                </div>

                <div class="review-block">
                    <div class="user-profile">
                        <img src="assets/img/logo.png" alt="">
                        <p>Username</p>
                    </div>
    
                    <div class="user-review">
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Placeat praesentium quasi fuga ipsa. Odit, dolorem enim. At voluptas iure quas minima impedit incidunt iste, amet quisquam voluptatem animi voluptate itaque!</p>
                    </div>
                </div>

                <div class="review-block">
                    <div class="user-profile">
                        <img src="assets/img/logo.png" alt="">
                        <p>Username</p>
                    </div>
    
                    <div class="user-review">
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Placeat praesentium quasi fuga ipsa. Odit, dolorem enim. At voluptas iure quas minima impedit incidunt iste, amet quisquam voluptatem animi voluptate itaque!</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- <?php if($commentsPerProduct) : ?>
    <div class="comm-block">
        <div class="picture-block">
            <?php foreach($commentsPerProduct as $index => $cpp) : ?>
                <a href="#reviews" class="comm-picture" data-modal-target="#modal-<?= $index; ?>">
                    <img src="<?= esc($cpp['image_url']) ?>" alt="<?= esc($cpp['product_name']) ?>" />
                    <p><?= esc($cpp['product_name']) ?></p>
                </a>

                <div class="modal" id="modal-<?= $index; ?>">
                    <div class="modal-content">
                        <div class="modal-header">
                            <div class="title">
                                <h2>Reviews for <span style="color: teal;"><?= esc($cpp['product_name']) ?></span></h2>
                            </div>
                            <button data-close-button class="close-button">&times;</button>
                        </div>

                        <div class="modal-body">
                            <?php if (!empty($cpp['comments'])): ?>
                                <?php foreach ($cpp['comments'] as $comment): ?>
                                    <div class="comment-item">
                                        <p><strong><?= esc($comment['firstname']) . ' ' . esc($comment['lastname']) ?></strong> 
                                            <span class="span">(Rating: 
                                                <?php
                                                    switch($comment['rating']) {
                                                        case 1: echo "⭐"; break;
                                                        case 2: echo "⭐⭐"; break;
                                                        case 3: echo "⭐⭐⭐"; break;
                                                        case 4: echo "⭐⭐⭐⭐"; break;
                                                        case 5: echo "⭐⭐⭐⭐⭐"; break;
                                                        default: echo "No rating"; break;
                                                    }
                                                ?>
                                            )</span></p>
                                        <hr>
                                        <p id="text"><?= esc($comment['comment_text']) ?></p>
                                        <p><small style="color: gray;">Commented on <?= date('F j, Y', strtotime($comment['created_at'])) ?></small></p>
                                    </div>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <p style="color: gray; text-align: center; padding: 20px;">No comments available for this product.</p>
                            <?php endif; ?>
                        </div>

                        <div class="modal-footer">
                            <form action="<?= base_url('/community/reviewProduct/'.$cpp['product_id']) ?>" method="post">
                                <div class="rating-container">
                                    <?php
                                    for ($i = 1; $i <= 5; $i++) {
                                        $selectedClass = (isset($cpp['existingReview']) && $cpp['existingReview']['rating'] >= $i) ? 'selected' : '';
                                        echo "<span class='star $selectedClass' data-value='$i'>&#9733;</span>";
                                    }
                                    ?>
                                </div>
                                <p>Rate: <span class="rating-value"><?= isset($cpp['existingReview']) ? $cpp['existingReview']['rating'] : 0; ?></span>/5</p>
                                <input type="text" hidden class="rating-value-input" name="rating-value" value="<?= isset($cpp['existingReview']) ? $cpp['existingReview']['rating'] : ''; ?>">
                                <?php if(!$cpp['existingReview']) : ?>
                                    <textarea name="review" id="review" placeholder="Review this gear"><?= isset($cpp['existingReview']) ? esc($cpp['existingReview']['comment_text']) : ''; ?></textarea>
                                    <button type="submit">Send Review</button>
                                <?php else :?>
                                    <textarea name="review" id="review" placeholder="Review this gear" disabled><?= isset($cpp['existingReview']) ? esc($cpp['existingReview']['comment_text']) : ''; ?></textarea>
                                    <p>Already reviwed this gear</p>
                                <?php endif;?>
                                <?php if($cpp['existingReview']) :?>
                                    <a href="<?= base_url('/community/reviewDelete/'.$cpp['product_id']) ?>">Delete review</a>
                                <?php endif; ?>
                            </form>
                        </div>                             
                    </div>
                </div> 
            <?php endforeach; ?>
            <div id="overlay"></div>
        </div>
    </div>
<?php else : ?>
    <div class="comm-block">
        <div class="noProducts">
            <h5 style="color: gray; text-align: center; padding: 20px;">NO PRODUCTS AVAILABLE</h5>
        </div>
    </div>
    <?php endif; ?> -->
</div>
<!-- @END SECTION products -->


<!-- @PHP CODE FOOTER - this includes footer.php file on every website that has this code -->
<?php echo view("includes/footer.php"); ?> 
<!-- @PHP CODE END FOOTER  -->
<!-- @SCRIPTS -->
</body>
</html>