<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= base_url('assets/css/UserSide/userAccount.css') ?>">
    <link rel="stylesheet" href=" <?= base_url('assets/css/navbar.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/UserSide/grid.css') ?>">
    <link rel="shortcut icon" href="<?= base_url('assets/img/logo.png') ?>" type="image/x-icon"> 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <title>My Profile</title>
</head>
<body>
  <!-- INCLUDE TOP(FIXED/STICKY) NAV -->
  <?php  echo view("includes/header.php"); ?>

<div class="main">
    <!-- INCLUDE SIDE NAV -->
    <?php echo view("UserSide/sideNav"); ?>
    
    <hr>
    <!-- MAIN CONTENT -->
    <main>
        <div class="card-container">
            <div class="top">
                <h2>My Profile</h2>
                <h3>Manage your account</h3>
                <div class="line"></div>
            </div>
            
            <div class="content">
                <form action="<?= base_url('/user/updateProfile') ?>" method="post" enctype="multipart/form-data">
                    <div class="user-image">
                        <?php if($userAccount && $userAccount['profile_pic']) :?>
                            <img src="data:image/jpeg;base64,<?= base64_encode($userAccount['profile_pic']) ?>" alt="">
                        <?php else :?>
                            <img src=" <?=base_url('assets/img/user.png') ?>" alt="Upload picture">
                        <?php endif; ?>
                            <input type="file" name="pfp" id="pfp" placeholder="Select Image">
                    </div>
                    
                    <div class="edit-profile">
                        <!-- SUCCESS MESSAGE -->
                        <?php if(session()->has('profileUpdated')) :?>
                            <span style="color: green"><?= session()->getFlashdata('profileUpdated')?></span>
                        <?php endif;?>
                            
                        <!-- UPDATE INFO -->
                        <div class="one">
                            <fieldset>
                                <!-- UPDATE USERNAME -->
                                <div class="input-block">
                                    <label for="username">Username</label>
                                    <input type="text" name="username" id="username" value="<?= $userAccount['username']; ?>" placeholder="Enter Username">
                                </div> 

                                <!-- CHANGE/UPDATE EMAIL -->
                                <div class="input-block">
                                    <label for="email">Email</label>
                                    <input type="email" name="email" id="email" value="<?= $userAccount['email']; ?>" placeholder="Set email">
                                </div>
                                
                                <!-- CHANGE/UPDATE PHONE NUMBER -->
                                <div class="input-block">
                                    <label for="phonenumber">Phone Number</label>
                                    <input type="number" name="phonenumber" id="phonenumber" value="<?= $userAccount['phone_number']; ?>" placeholder="Set phonenumber">
                                </div>
                            </fieldset>
                        </div>                     
                        <br>
                        <!-- UPDATE NAME -->
                        <div class="two">
                            <fieldset>
                                <!-- UPDATE FIRSTNAME -->
                                <div class="input-block">
                                    <label for="firstname">Firstname</label>
                                    <input type="text" name="firstname" id="firstname" value="<?= $userAccount['firstname']; ?>" placeholder="Set firstname">
                                </div>
        
                                <!-- UPDATE LASTNAME -->
                                <div class="input-block">
                                    <label for="lastname">Lastname</label>
                                    <input type="text" name="lastname" id="lastname" value="<?= $userAccount['lastname']; ?>" placeholder="Set lastname">
                                </div>
                            </fieldset>
                        </div>
                        <br>
                        <!-- CHANGE/UPDATE LOCATION -->
                        <div class="three">
                            <fieldset>
                                <!-- CHANGE/UPDATE HOME ADDRESS -->
                                <div class="input-block">
                                    <label for="address">Home address</label>
                                    <input type="text" name="address" id="address" value="<?= $userAccount['address']; ?>" placeholder="Set Home Address">
                                </div>
        
                                <!-- CHANGE/UPDATE CITY OR MUNICIPALITY -->
                                <div class="input-block">
                                    <label for="cityMunicipality">City/Municipality </label>
                                    <input type="text" name="cityMunicipality" id="cityMunicipality" value="<?= $userAccount['city_municipality']; ?>" placeholder="Set city/municipality">
                                </div>
        
                                <!-- CHANGE/UPDATE ZIPCODE -->
                                <div class="input-block">
                                    <label for="zipcode">ZipCode </label>
                                    <input type="number" name="zipcode" id="zipcode" value="<?= $userAccount['zipcode']; ?>" placeholder="Set zipcode">
                                </div>
        
                                <!-- CHANGE/UPDATE COUNTRY -->
                                <div class="input-block">
                                    <label for="country">Country </label>
                                    <input type="text" name="country" id="country" value="<?= $userAccount['country']; ?>" placeholder="Set country">
                                </div>
                            </fieldset>
                        </div>
                        <br>

                        <!-- CHANGE PASSWORD -->
                        <div class="four">
                            <fieldset>
                                <div class="input-block">
                                    <label for="currentPass">Current Password </label>
                                    <input type="password" name="currentPass" id="currentPass" placeholder="Enter current password">
                                </div>
                                <!-- ERROR MESSAGE -->
                                
                                <div class="input-block">
                                    <label for="newPass">New Password </label>
                                    <input type="password" name="newPass" id="newPass" placeholder="Enter new password">
                                </div>
                            </fieldset>
                            <!-- ERROR MESSAGE -->
                            <?php if(session()->has('npassInvalid')) :?>
                                <span class="errorMessage" style="color: red"><?= session()->getFlashdata('npassInvalid')?></span>
                            <?php endif;?>
                            <?php if(session()->has('cpassInvalid')) :?>
                                <span class="errorMessage" style="color: red"><?= session()->getFlashdata('cpassInvalid')?></span>
                            <?php endif;?>
                        </div>
                    </div>
                    <button type="submit">Save</button>
                </form>
            </div>
        </div>
    </main>
</div>

</body>
</html>