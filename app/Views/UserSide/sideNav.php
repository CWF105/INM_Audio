<aside>
    <nav class="sidenav">
        <!-- Profile pic and username/displayed name -->
        <div class="logo-title">
            <?php if($userAccount && $userAccount['profile_pic']) :?>
                <img src="data:image/jpeg;base64,<?= base64_encode($userAccount['profile_pic']) ?>" alt="">
            <?php else :?>
                <img src=" <?=base_url('assets/img/user.png') ?>" alt="Upload picture">
            <?php endif; ?>            
            <h2 title="Username"><?= $userAccount['username']; ?></h2>
        </div>
    <!-- NAVIGATIONS -->
        <ul>
            <!-- My Profile -->
            <a id="myprofile" href="<?= base_url('/user/setting') ?>">
                <i class="fa-solid fa-user"></i>
                <li><span>My Profile</span></li>
            </a>

            <!-- My purchase -->
            <a id="mypurchase" href="<?= base_url('/user/mypurchase') ?>">
                <li><span>My Purchase</span></li>
            </a>

            <!-- My Likes -->
            <a id="mylikes" href="<?= base_url('/user/myLikes') ?>">
                <li><span>My Likes</span></li>
            </a>

            <!-- Logout  -->
            <a id="logout" href="<?= base_url('/user/logout') ?>">
                <li class="logout"><i class="fa-solid fa-arrow-right-from-bracket"></i><h3>Logout</h3></li>
            </a>
        </ul>
    </nav>
</aside>