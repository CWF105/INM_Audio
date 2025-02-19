<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link rel="stylesheet" href="<?= base_url('assets/css/signupStyle.css') ?>">
</head>
<body>
    <div class="container">
        <div class="form-section">
            <a href="<?= base_url('/') ?>" class="exit">&times</a>
            <h2>Sign Up</h2>
            <form action="<?= base_url("/account/signup") ?>" method="post">
                <?php $success =  session()->getFlashdata('successRegister'); if(isset($success)) {echo "<span class='success' style='color: green; text-align: center;'>" . $success . "</span>" ;} ?>
                <?= csrf_field() ?> 
                
                <div class="input-group">
                    <div class="input-block">
                        <label for="fname">First Name</label>
                        <input type="text" id="fname" name="fname" placeholder="Enter Your First Name">
                    </div>
                    <div class="input-block">
                        <label for="lname">Last Name</label>
                        <input type="text" id="lname" name="lname" placeholder="Enter Your Last Name">
                    </div>
                </div>
                <div class="input-group">
                    <div class="input-block">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" placeholder="Enter Your Email">
                    </div>
                    <div class="input-block">
                        <label for="pnum">Phone Number</label>
                        <input type="text" id="pnum" name="pnum" placeholder="Enter Your Phone Number">
                    </div>
                </div>
               <div class="input-block">
                   <label for="user">User Name</label>
                   <input type="text" id="user" name="user" placeholder="Enter User Name">
               </div>
                <div class="input-block">
                    <label for="pass">Password</label>
                    <input type="password" id="pass" name="pass" placeholder="Create a Password">
               </div>
                <div class="input-block">
                    <label for="cpass">Password</label>
                    <input type="password" id="cpass" name="cpass" placeholder="confirm Password">
               </div>

                <?php $error = session()->getFlashdata('userError');?><?php if($error) { echo "<span class='error' style='color: red; text-align: center;'>" . $error . "</span>"; }?>

                <button type="submit">Sign Up</button>

                <small>Already have an Account? <a href="<?= base_url('/login') ?>">Log in</a></small>
<!-- 
                <div class="social-icons">
                    <small><a href="#"><img src="facebook-icon.png" alt="Facebook"></a></small>
                    <small><a href="#"><img src="instagram-icon.png" alt="Instagram"></a></small>              
                </div> -->
            </form>
        </div>
        <div class="image-section">
            <img src="<?= base_url('assets/img/sbg.png') ?>" alt="Image">
        </div>
    </div>
</body>
</html>