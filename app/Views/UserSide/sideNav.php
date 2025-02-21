<aside>
    <nav class="sidenav">
        <!-- <div class="logo-title">
            <?php if($userAccount && $userAccount['profile_pic']) :?>
                <img src="data:image/jpeg;base64,<?= base64_encode($userAccount['profile_pic']) ?>" alt="">
            <?php else :?>
                <img src=" <?=base_url('assets/img/user.png') ?>" alt="Upload picture">
            <?php endif; ?>            
            <h2 title="Username"><?= $userAccount['username']; ?></h2>
        </div> -->

        <ul class="links">
            <a id="myprofile" href="<?= base_url('/user/setting') ?>">
                <i class="fa-solid fa-user"></i>
                <p>My Profile</p>
            </a>

            <a id="mypurchase" href="<?= base_url('/user/mypurchase') ?>">
                <i class="fa-solid fa-cart-shopping"></i>
                <p>My Purchase</p>
            </a>

            <a id="mylikes" href="<?= base_url('/user/myLikes') ?>">
                <i class="fa-solid fa-thumbs-up"></i>
                <p>My Likes</p>
            </a>
        </ul>   

        <a id="logout" href="<?= base_url('/user/logout') ?>">
            <i class="fa-solid fa-arrow-right-from-bracket"></i>
            <p>Logout</p>
        </a>
    </nav>
</aside>