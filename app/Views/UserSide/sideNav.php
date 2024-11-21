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
            <a href="<?= base_url('/user/setting') ?>">
                <li><h3>My Profile</h3></li>
            </a>

            <!-- My purchase -->
            <a href="<?= base_url('/user/mypurchase') ?>">
                <li><h3>My Purchase</h3></li>
            </a>

            <!-- My Likes -->
            <a href="">
                <li><h3>My Likes</h3></li>
            </a>

            <!-- Logout  -->
            <a href="<?= base_url('/user/logout') ?>">
                <li class="logout"><i class="fa-solid fa-arrow-right-from-bracket"></i><h3>Logout</h3></li>
            </a>
        </ul>
    </nav>
</aside>