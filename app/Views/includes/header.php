<header class="nav-header">
    <nav>
        <a href="<?= base_url('/') ?>" class="logo">
            <img src="<?= base_url('assets/img/logo.png') ?>" alt="">
        </a>
        
        <ul class="links">
            <a href="<?= base_url('/') ?>">
                <li>Home</li>
            </a>

            <a href="<?= base_url(relativePath: '/library') ?>">
                <li>Gear Library</li>
            </a>

            <a href="<?= base_url('/community') ?>">
                <li>IEM Community</li>
            </a>

            <a href="<?= base_url('/customize') ?>">
                <li>Customize</li>
            </a>

            <a href="<?= base_url('/shop') ?>">
                <li>Shop</li>
            </a>

            <?php if(session()->get('user_id') && session()->get('username')) :?>
                <div class="dropdown-container">
                    <a href="<?= base_url('/user/setting') ?>" title="Account Settings for <?= session()->get('username') ?>">
                        <li>
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
                                <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0"/>
                                <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1"/>
                            </svg> 
                            <span class="color: 7777;"><?= session()->get('username');?></span>
                        </li>
                    </a>

                    <div class="dropdown-block">
                        <div class="dropdown">
                            <div class="link">
                                <a href="<?= base_url('/user/setting') ?>">My Account</a>
                                <a href="<?= base_url('/cart') ?>">My Cart</a>
                                <a href="<?= base_url('/user/mypurchase') ?>">My Purchase</a>
                                <a href="<?= base_url('/user/myLikes') ?>">My Likes</a>
                                <a href="<?= base_url('/user/logout') ?>">Logout</a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php else :?>
                <a href="<?= base_url('/login') ?>" title="Login or Signup">
                    <li><i class="fa-solid fa-user-plus"></i></li>
                </a>
            <?php endif;?>
        </ul>
        
        <div class="toggle-btn">
            <i class="fa-solid fa-bars"></i>
        </div>
    </nav>

    <div class="responsive-container">
        <div class="responsive-links">
            <a href="<?= base_url('/') ?>">
                <li>Home</li>
            </a>

            <a href="<?= base_url('/library') ?>">
                <li>Gear Library</li>
            </a>

            <a href="<?= base_url('/community') ?>">
                <li>IEM Community</li>
            </a>

            <a href="<?= base_url('/customize') ?>">
                <li>Customize</li>
            </a>

            <a href="<?= base_url('/shop') ?>">
                <li>Shop</li>
            </a>

            <?php if(session()->get('user_id') && session()->get('username')) :?>
                <div class="dropdown-container">
                    <a href="<?= base_url('/user/setting') ?>" title="Account Settings for <?= session()->get('username') ?>">
                        <li>
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
                                <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0"/>
                                <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1"/>
                            </svg> 
                            &nbsp;
                            <span class="color: 7777;"><?= session()->get('username');?></span>
                        </li>
                    </a>

                    <div class="dropdown">
                        <div class="links">
                            <a href="<?= base_url('/user/setting') ?>">My Account</a>
                            <a href="<?= base_url('/cart') ?>">My Cart</a>
                            <a href="<?= base_url('/user/mypurchase') ?>">My purchase</a>
                            <a href="<?= base_url('/user/logout') ?>">Logout</a>
                        </div>
                    </div>
                </div>
            <?php else :?>
                <a href="<?= base_url('/login') ?>" title="Login or Signup">
                    <li><i class="fa-solid fa-user-plus"></i></li>
                </a>
            <?php endif;?>
        </div>
    </div>
</header>