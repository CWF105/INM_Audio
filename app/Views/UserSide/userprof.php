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
                <?php if($userAccount && $userAccount['profile_pic']) :?>
                    <img src="data:image/jpeg;base64,<?= base64_encode($userAccount['profile_pic']) ?>" alt="">
                <?php else :?>
                    <img src=" <?=base_url('assets/img/user.png') ?>" alt="Upload picture">
                <?php endif; ?>
                <p><?= $userAccount['username']; ?></p>
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

        <!-- FIELDS FOR USER SETTINGS -->
            <div class="card-container">
            <!-- my account -->
                <div class="cards account">
                    <div class="prof-container">
                        <div class="profile">
                            <h2>My Profile</h2>
                            <h3>Manage your account</h3>
                            <div class="line"></div>
                        </div>
                        <!-- CHANGE PROFILE PICTURE -->
                        <form action="<?= base_url('/user/changeProfile') ?>" method="post" enctype="multipart/form-data">
                            <div class="user-image">
                                <?php if($userAccount && $userAccount['profile_pic']) :?>
                                    <img src="data:image/jpeg;base64,<?= base64_encode($userAccount['profile_pic']) ?>" alt="">
                                <?php else :?>
                                    <img src=" <?=base_url('assets/img/user.png') ?>" alt="Upload picture">
                                <?php endif; ?>
                                    <input type="file" name="pfp" id="pfp" placeholder="Select Image">
                                    <button type="submit">Update Profile</button>
                            </div>
                        </form>
                    </div>

                    <div class="edit-profile">
                        <!-- SUCCESS MESSAGE -->
                        <?php if(session()->has('profileUpdated')) :?>
                            <span style="color: green"><?= session()->getFlashdata('profileUpdated')?></span>
                        <?php endif;?>

                        <!-- CHANGE/UPDATE USERNAME -->
                        <form class="formInputs one" action="<?= base_url( '/user/changeUsername') ?>" method="post">
                            <div class="input-block">
                                <label for="username">Username</label>
                                <input type="text" name="username" id="username" value="<?= $userAccount['username']; ?>" placeholder="Enter Username">
                                <button type="submit">Change</button>
                            </div>
                        </form>

                        <!-- CHANGE/UPDATE FIRSTNAME -->
                        <form class="formInputs" action="<?= base_url( '/user/changeFirstname') ?>" method="post">
                            <div class="input-block">
                                <label for="firstname">Firstname</label>
                                <input type="text" name="firstname" id="firstname" value="<?= $userAccount['firstname']; ?>" placeholder="Set firstname">
                                <button type="submit">Change</button>
                            </div>
                        </form>

                        <!-- CHANGE/UPDATE LASTNAME -->
                        <form class="formInputs" action="<?= base_url( '/user/changeLastname') ?>" method="post">
                            <div class="input-block">
                                <label for="lastname">Lastname</label>
                                <input type="text" name="lastname" id="lastname" value="<?= $userAccount['lastname']; ?>" placeholder="Set lastname">
                                <button type="submit">Change</button>
                            </div>
                        </form>

                        <!-- CHANGE/UPDATE EMAIL -->
                        <form class="formInputs" action="<?= base_url('/user/changeEmail') ?>" method="post">
                            <div class="input-block">
                                <label for="email">Email</label>
                                <input type="email" name="email" id="email" value="<?= $userAccount['email']; ?>" placeholder="Set email">
                                <button type="submit">Change</button>
                            </div>
                        </form>

                        <!-- CHANGE/UPDATE PHONE NUMBER -->
                        <form class="formInputs" action="<?= base_url('/user/changePhone') ?>" method="post">
                            <div class="input-block">
                                <label for="phonenumber">Phone Number</label>
                                <input type="number" name="phonenumber" id="phonenumber" value="<?= $userAccount['phone_number']; ?>" placeholder="Set phonenumber">
                                <button type="submit">Change</button>
                            </div>
                        </form>
                        
                        <br><br><hr><br>
                        <h3>Address</h4>
                        <!-- CHANGE/UPDATE HOME ADDRESS -->
                        <form class="formInputs" action="<?= base_url('/user/changeAddress') ?>" method="post">
                            <div class="input-block">
                                <label for="address">Home address</label>
                                <input type="text" name="address" id="address" value="<?= $userAccount['address']; ?>" placeholder="Set Home Address">
                                <button type="submit">Change</button>
                            </div>
                        </form>

                        <!-- CHANGE/UPDATE CITY OR MUNICIPALITY -->
                        <form class="formInputs" action="<?= base_url('/user/changeCM') ?>" method="post">
                            <div class="input-block">
                                <label for="cityMunicipality">City/Municipality </label>
                                <input type="text" name="cityMunicipality" id="cityMunicipality" value="<?= $userAccount['city_municipality']; ?>" placeholder="Set city/municipality">
                                <button type="submit">Change</button>
                            </div>
                        </form>

                        <!-- CHANGE/UPDATE ZIPCODE -->
                        <form class="formInputs" action="<?= base_url('/user/changeZipcode') ?>" method="post">
                            <div class="input-block">
                                <label for="zipcode">ZipCode </label>
                                <input type="number" name="zipcode" id="zipcode" value="<?= $userAccount['zipcode']; ?>" placeholder="Set zipcode">
                                <button type="submit">Change</button>
                            </div>
                        </form>

                        <!-- CHANGE/UPDATE COUNTRY -->
                        <form class="formInputs" action="<?= base_url('/user/changeCountry') ?>" method="post">
                            <div class="input-block">
                                <label for="country">Country </label>
                                <input type="text" name="country" id="country" value="<?= $userAccount['country']; ?>" placeholder="Set country">
                                <button type="submit">Change</button>
                            </div>
                        </form>

                        <br><br><hr><br>
                        <h3>Change Password</h4>

                        <!-- CHANGE/UPDATE PASSWORD -->
                        <form class="formInputs" action="<?= base_url('/user/changePassword') ?>" method="post">
                            <div class="input-block">
                                <label for="currentPass">Current Password </label>
                                <input type="password" name="currentPass" id="currentPass" placeholder="Enter current password">
                            </div>
                            <!-- ERROR MESSAGE -->
                            <?php if(session()->has('cpassInvalid')) :?>
                                <span class="errorMessage" style="color: red"><?= session()->getFlashdata('cpassInvalid')?></span>
                            <?php endif;?>
                            <?php if(session()->has('cpassEmpty')) :?>
                                <span class="errorMessage" style="color: red"><?= session()->getFlashdata('cpassEmpty')?></span>
                            <?php endif;?>

                            <div class="input-block">
                                <label for="newPass">New Password </label>
                                <input type="password" name="newPass" id="newPass" placeholder="Enter new password">
                            </div>
                            <!-- ERROR MESSAGE -->
                            <?php if(session()->has('npassEmpty')) :?>
                                <span class="errorMessage" style="color: red"><?= session()->getFlashdata('npassEmpty')?></span>
                            <?php endif;?>
                            <?php if(session()->has('npassInvalid')) :?>
                                <span class="errorMessage" style="color: red"><?= session()->getFlashdata('npassInvalid')?></span>
                            <?php endif;?>
                            <button type="submit" class="passChange">Update Password</button>
                        </form>

                    </div>
                </div>
            </div>

        <!--  -->
        <div class="card purchase">

        </div>
    </div>

<!-- @PHP CODE - this includes header.php file on every website that has this code -->
<?php echo view("includes/footer.php");?>
<!-- @PHP CODE -->
</body>
</html>