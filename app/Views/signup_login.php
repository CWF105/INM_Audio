

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="<?= base_url('assets/css/signup.css')?>">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer"/>
        <title>Sign Up</title>
        <style>
            /* Simple styling for modal */
            #notificationModal {
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background: rgba(0, 0, 0, 0.5);
                display: flex;
                justify-content: center;
                align-items: center;
            }
            .modal-content {
                padding: 20px;
                border-radius: 5px;
                position: relative;
                text-align: center;
                width: 300px;
            }
            .close-btn {
                position: absolute;
                top: 10px;
                right: 10px;
                cursor: pointer;
                font-size: 18px;
            }
            h5 a{
                text-decoration: none;
                color: white;
            }
            .error {color:red; font-size: 16px;}
            .success {color:green; font-size: 16px;}
            p {
                font-family: Verdana, Geneva, Tahoma, sans-serif;
                font-weight: bold;
                text-align: center;
            }
        </style>
        
    </head>

<!-- forms -->
        <php class="main">
            <input type="checkbox" id="chk" aria-hidden="true">

            <!-- This is the signup form for users only -->
            <div class="signup">
                <form action="<?= base_url("/account/signup") ?>" method="post">
                    <?= csrf_field() ?> <!-- CSRF protection field -->
                    <label for="chk" aria-hidden="true">Sign up</label>
                    <h5><a href="<?= base_url('/') ?>">Home</a></h5>
                        <!-- success register message -->
                        <?php $success =  session()->getFlashdata('successRegister'); if(isset($success)) {echo "<span class='success'>" . $success . "</span>" ;} ?>

                            <div class="input-block">
                                <input type="text" name="fname" placeholder="First name" title="Enter your First name" required>

                                <input type="text" name="lname" id="lname" placeholder="Last Name" title="Enter your Last Name" required>

                            </div>
                            <div class="input-block">
                                <input type="email" name="email" id="email" placeholder="Email Address" title="Enter your Address" required>

                                <input type="number" name="pnum" id="pnum" placeholder="Phone Number" title="Enter your Phone Number" required>

                            </div>
                            <div class="input-block" id="input-block"> 
                                <input type="text" name="user" id="user" placeholder="Username" title="Enter your Username" required>
                                <input type="password" name="pass" id="pass" placeholder="Password" title="Enter your Password" required>
                            </div>
                                <!-- error messages -->
                                <?php 
                                    $error1 = session()->getFlashdata('userError1');
                                    $error2 = session()->getFlashdata('userError2');
                                    $error3 = session()->getFlashdata('userError3') 
                                ?>
                                <?php if($error1) { echo "<span class='error'>" . $error1 . "</span>"; }?>
                                <?php if($error2) { echo "<span class='error'>" . $error2 . "</span>"; }?>
                                <?php if($error3) { echo "<p class='error'>" .$error3 . "</p>"; }?>


                    <button type="submit" value="register" name="submit">Sign up</button>
                </form>             
            </div>

                        
<!-- ===================================================================================================================================================== -->
            <div style="display: none;">
                <div class="modal-content">
                    <span class="close-btn" onclick="closeModal()">&times;</span>
                    <p id="modalMessage"></p>
                </div>  
            </div>

        <!-- Login form for user and admin -->
            <div class="login" id="login">
                <form action="<?= base_url("/account/login") ?>" method="post">
                    <?= csrf_field() ?> <!-- CSRF protection field -->
                    <label for="chk" aria-hidden="true" class="logins">Login</label>
                    
                        <?php if (session()->getFlashdata('error')): ?>
                            <p class="error"><?= session()->getFlashdata('error') ?></p>
                        <?php endif; ?>

                    <label for="chk" aria-hidden="true" class="xbutton"><i class="fa-solid fa-xmark"></i></label>
                    <input type="text" name="username" id="username" title="Enter your Username or Email" placeholder="Username" required>
                    <input type="password" name="pass" id="pass" title="Enter your Password" placeholder="Password" required >
                    <button type="submit">Login</button>
                </form>
            </div>

        




<!-- scripts  -->
        <script>
            function closeModal() {
                document.getElementById('notificationModal').style.display = 'none';
            }

            function showPopup(message, type) {
                const popup = document.getElementById('popup');
                const overlay = document.getElementById('overlay');
                const popupMessage = document.getElementById('popupMessage');

                // Set message and styles based on type
                popupMessage.innerHTML = `<p class="${type === 'success' ? 'text-success' : 'text-danger'}">${message}</p>`;
                popup.style.display = 'block';
                overlay.style.display = 'block';
            }

            function closePopup() {
                const popup = document.getElementById('popup');
                const overlay = document.getElementById('overlay');

                popup.style.display = 'none';
                overlay.style.display = 'none';
            }

            // Show the popup if flash data exists
            document.addEventListener('DOMContentLoaded', function() {
                const successMessage = '<?= session()->getFlashdata('success') ?>';
                const errorMessage = '<?= session()->getFlashdata('error') ?>';
                
                if (successMessage) {
                    showPopup(successMessage, 'success');
                } else if (errorMessage) {
                    showPopup(errorMessage, 'error');
                }
            });
        </script>

    </body>
</html>