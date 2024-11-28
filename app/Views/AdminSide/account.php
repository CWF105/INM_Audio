<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= base_url('Admin/css/account.css') ?>">
    <link rel="stylesheet" href="<?= base_url('Admin/css/grid.css') ?>">
    <title>Account | Setting</title>
    <style>
        /* SIDE NAV WHEN IN THIS PAGE */
        #account { background-color: #d4ebf844; }
        aside nav ul #account    span { opacity: 1;}
    </style>
</head>
<body>
<!-- 
// * INCLUDE THE SIDE NAVIGATION FILE *
-->
<?php echo view('AdminSide/includes/sideNav') ?>


<!-- 
// * MAIN CONTENT *
-->
<main>
    <div class="header">
        <h3>ACCOUNT</h2>
        <?php if(session()->getFlashdata('successUpdateProfile')) :?>
            <span style="color: green;">
                <?= session()->getFlashdata('successUpdateProfile'); ?>
            </span>
        <?php endif;?>
        <?php if(session()->getFlashdata('existingUsername')) :?>
            <span style="color: red;">
                <?= session()->getFlashdata('existingUsername'); ?>
            </span>
        <?php endif;?>
        <?php if(session()->getFlashdata('existingEmail')) :?>
            <span style="color: red;">
                <?= session()->getFlashdata('existingEmail'); ?>
            </span>
        <?php endif;?>
        <?php if(session()->getFlashdata('existingBoth')) :?>
            <span style="color: red;">
                <?= session()->getFlashdata('existingBoth'); ?>
            </span>
        <?php endif;?>
        <?php if(session()->getFlashdata('passwordErr')) :?>
            <span style="color: red;">
                <?= session()->getFlashdata('passwordErr'); ?>
            </span>
        <?php endif;?>
    </div>

    <div class="main">
        <form action="<?= base_url('/admin/updateAccount') ?>" method="post" enctype="multipart/form-data">
            <div class="profile-pic">
                <?php if($adminAccount && $adminAccount['profile_pic'] != null) : ?>
                    <img src="data:image/jpeg;base64,<?= base64_encode($adminAccount['profile_pic']) ?>" style="border-radius: 100px;" alt="">
                <?php else: ?>
                    <img src="<?= base_url('Admin/img/icons/account.png') ?>" alt="">
                <?php endif;?>
                <label class="file-input-container">
                    <input type="file" class="file-inputs" id="profile_pic" name="profile_pic" accept="image/*">
                </label>
            </div>

            <div class="info">
                <!-- USERNAME DISPLAY -->
                <div class="label">
                    USERNAME
                    <h3><?= $adminAccount['username']?></h3>
                </div>

                <div class="container">
                    <!-- EMAIL FIELD -->
                    <div class="email one" id="email">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" placeholder="Set Email" value="<?= $adminAccount['email']?>">
                    </div>
    
                    <!-- USERNAME FIELD -->
                    <div class="username one" id="username">
                        <label for="username">Username</label>
                        <input type="text" id="username" name="username" placeholder="Set username" value="<?= $adminAccount['username']?>">
                    </div>
    
                    <!-- PASSWORD FIELD -->
                    <div class="password one" id="password">
                        <label for="cpass">Current Password</label>
                        <input type="password" id="cpass" name="cpass" placeholder="Enter current password">
                        
                        <label for="pass">New Password</label>
                        <input type="password" id="pass" name="pass" placeholder="Set new password">
                    </div>
                </div>

                <button type="submit">Save Changes</button>
            </div>
            
        </form>
        <a href="<?= base_url('/admin/deleteAccount/'. session()->get('admin_id')) ?>">
            <button onclick="return confirm('Are you sure you want to delete this Account?\nyou will be redirected to homepage')" class="btn btn-danger">Delete Account</button>
        </a>
    </div>
</main>

<!-- SCRIPTS - for switching tabs -->
</body>
</html>