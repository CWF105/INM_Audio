<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log In</title>
    <link rel="stylesheet" href="<?= base_url('assets/css/loginStyle.css') ?>">
</head>
<body>
    <div class="container login">
        <div class="image-section">
            <img src="<?= base_url('assets/img/sbg.png') ?>" alt="Image">
        </div>
        <div class="form-section">
            <a href="<?= base_url('/') ?>" class="exit">&times</a>
            <h2>Log In</h2>
            <?php if(session()->getFlashdata('noAccount')) : ?>
                <span style="color: darkred; margin-button:10px;"><?= session()->getFlashdata('noAccount')?></span>
            <?php endif;?>
            <form action="<?= base_url('/account/login') ?>" method="post">
            <?= csrf_field() ?> 

                <label for="username">Username or Email</label>
                <input type="text" id="username" name="username" placeholder="Enter Your Username or Email">

                <label for="pass">Password</label>
                <input type="password" id="pass" name="pass" placeholder="Enter your Password">
                
                <?php if (session()->getFlashdata('error')): ?><p class="error" style="color: red; text-align: center;"><?= session()->getFlashdata('error') ?></p><?php endif; ?>
                <?php if(session()->getFlashdata('accountTerminated')):?><p class="error" style="color: red; text-align: center;"><?= session()->getFlashdata('accountTerminated') ?></p><?php endif;?>
                &nbsp;
                <div class="remembers">
                    <input type="checkbox" name="remember" id="remember" value="1">
                    <label for="remember">Remember me</label>
                </div>

                <!-- to be filled  -->
                 <div class="forgotp">
                     <a href="<?= base_url('/account/forgotPass') ?>" class="forgot-password">Forgot Password?</a>
                     <a href="<?= base_url('/signup') ?>" class="forgot-password">Create account</a>
                 </div>

                <button type="submit">Log In</button>
<!-- 
                <div class="social-icons">
                    <a href="#"><img src="facebook-icon.png" alt="Facebook"></a>
                    <a href="#"><img src="instagram-icon.png" alt="Instagram"></a>
                </div> -->
            </form>
        </div>
    </div>
</body>
</html>