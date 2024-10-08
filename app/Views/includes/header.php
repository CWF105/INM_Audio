<!-- 
 *  this file is included inside of every webpages that requires navigation through the pages
 *  name: navbar.css
 *  location: public\assets\css\navbar.css
 * -->
<header class="header">
    
        <nav>
            <div class="logo">
                <a href="<?= base_url('/') ?>">
                    <img src="<?= base_url('assets/img/logo.png') ?>" alt="">
                </a>
            </div>
            <ul class="links">
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
                    <a href="<?= base_url('/user/setting') ?>" title="Account Settings for <?= session()->get('username') ?>">
                        <li>
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16"><path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0"/><path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1"/></svg> 
                            &nbsp;
                            <span class="color: 7777;"><?= session()->get('username');?></span>
                        </li>
                    </a>
                <?php else :?>
                    <a href="<?= base_url('/login') ?>" title="Login or Signup">
                        <li><i class="fa-solid fa-user-plus"></i></li>
                    </a>
                <?php endif;?>
            </ul>
        </nav>
</header>
