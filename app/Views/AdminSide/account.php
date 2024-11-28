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
    </div>

    <div class="main">
        <form action="" method="post" enctype="multipart/form-data">
            <div class="profile-pic">
                <img src="<?= base_url('Admin/img/icons/account.png') ?>" alt="">
                <label class="file-input-container">
                    <button type="button" class="choose-file-btn">Choose File</button>
                    <span class="file-name">No file selected</span>
                    <input type="file" class="file-input" id="fileInput" name="pfp">
                </label>
            </div>

            <div class="info">
                <!-- USERNAME DISPLAY -->
                <div class="label">
                    <h3>ADMIN USERNAME</h3>
                </div>

                <div class="container">
                    <!-- EMAIL FIELD -->
                    <div class="email one" id="email">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" placeholder="Set Email">
                    </div>
    
                    <!-- USERNAME FIELD -->
                    <div class="username one" id="username">
                        <label for="username">Username</label>
                        <input type="text" id="username" name="username" placeholder="Set username">
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
                <a href="">
                    <button onclick="return confirm('Are you sure you want to delete this Account?\nyou will be redirected to homepage')" class="btn btn-danger">Delete Account</button>
                </a>
            </div>

        </form>
    </div>
</main>


<!-- SCRIPTS - for switching tabs -->
</body>
</html>