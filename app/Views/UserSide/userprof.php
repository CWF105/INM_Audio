<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href=" <?= base_url('assets/css/user-prof.css') ?>">
    <link rel="stylesheet" href=" <?= base_url('assets/css/navbar.css') ?>">
    <link rel="stylesheet" href=" <?= base_url('assets/css/footer.css') ?>">
    <link rel="shortcut icon" href="<?= base_url('assets/img/logo.png') ?>" type="image/x-icon"> 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <title>INM Admin</title>
    <script defer src="<?= base_url('assets/js/script.js') ?>"></script>
</head>
<body>
  <!-- @PHP CODE -->
  <?php 
        # includes the header file that contains navbar
        echo view("includes/header.php");
    ?>
<!-- @END PHP CODE -->

    <div class="container">
        
        <div class="sidebar">
            <div class="user-prof">
                <img src=" <?=base_url('assets/img/user.png') ?>" alt="">
                <p>User Name</p>
            </div>
            <div class="side-button">
                <button type="button" onclick="filterItems('account')">My Account</button>
                <button type="button" onclick="filterItems('purchase')">My Purchase</button>
                <!-- logout button -->
                <a href="<?= base_url('/user/logout') ?>"><i class="fa-solid fa-arrow-right-from-bracket"></i> Logout</a>
                <div class="content">
                </div>
            </div>
        </div>

        <div class="card-container">

                <!-- my account -->
                 <div class="cards account">
                    <div class="prof-container">
                        <div class="profile">
                            <h2>My Profile</h2>
                            <h3>Manage your account</h3>
                            <div class="line"></div>
                        </div>
                        <div class="user-image">
                            <img src=" <?=base_url('assets/img/user.png') ?>" alt="">
                            <input type="file" placeholder="Select Image">
                        </div>
                    </div>

                    <div class="edit-profile">
                        <form action="">
                            <div class="input-block">
                                <label for="username">User Name</label>
                                <!-- pangalan ng user na nag login -->
                                <p>Julian barrientos</p>
                            </div>
                            <div class="input-block">
                                <label for="email">Email</label>
                                <input type="text">
                                <a href="/">Change</a>
                            </div>
                            <div class="input-block">
                                <label for="pnum">Phone Number</label>
                                <input type="input">
                                <a href="/">Change</a>
                            </div>
                            <div class="input-block gender">

                                <label class="label">Gender</label>
                                <div>
                                    <input type="radio" id="male">
                                    <label for="male">Male</label>
                                </div>
                                <div>
                                    <input type="radio" id="female">
                                    <label for="female">Female</label>
                                </div>
                                <div>
                                    <input type="radio" id="other">
                                    <label for="other">Other</label>
                                </div>
                            </div>

                            <button type="/">Save</button>
                        </form>
                    </div>

                 </div>

        </div>

        <div class="card purchase">

        </div>
    </div>

<!-- @PHP CODE - this includes header.php file on every website that has this code -->
<?php echo view("includes/footer.php");?>
<!-- @PHP CODE -->
</body>
</html>