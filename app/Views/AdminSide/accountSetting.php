<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Account Settings</title>
    <link rel="stylesheet" href="<?= base_url('admin/css/accountSetting.css') ?>">
    <link rel="stylesheet" href="<?= base_url('admin/css/grid.css') ?>">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        #settings { 
            background-color: #5fa8d3; 
            color: white;
            border-top-left-radius: 10px;
            border-bottom-left-radius: 10px; 
        }
    </style>
</head>
<body>

<!-- Main Content -->
<main class="main-container">
    <!-- Side Navigation -->
    <aside>
        <?php echo view('AdminSide/includes/sideNav'); ?>
    </aside>

    <!-- Dashboard Content -->
    <section class="container-section item-container">
        <div class="header" id="top">
            <h1>Settings</h1>
        </div>

        <div class="container-content">
            <?php if(isset($adminAccount)) :?>
                <form action="<?= base_url('/admin/updateAccount') ?>" method="post" enctype="multipart/form-data">
    
                   <div class="pfp-con">
                        <label for="profile_pic" class="form-label">Profile Picture</label>
                        <?php if($adminAccount && $adminAccount['profile_pic'] != null) :?>
                            <div class="mb-3 pfp">
                                <img title="Hover mouse to see profile picture" src="data:image/jpeg;base64,<?= base64_encode($adminAccount['profile_pic']) ?>" alt="<?= $adminAccount['username'] ?>"> 
                                <input type="file" name="profile_pic" id="profile_pic" accept="image/*" style="display: block;">
                            </div>
                        <?php else :?>
                            <div class="mb-4 pfp">
                                <br>
                                <label>Upload Image</label>
                                <input type="file" name="profile_pic" id="profile_pic" accept="image/*" style="display: block;">
                            </div>
                        <?php endif;?>   
                        <strong><h1><?= $adminAccount['username']?></h1></strong>
                    </div>
                    <br><br><br>
                    <div class="fields">
                        <div class="input-block">
                            <label for="username" class="text font-label">Username</label>
                            <input type="text" id="username" name="username" class="input form-control" value="<?= $adminAccount['username'] ?>">
                        </div>
                        <div class="input-block">
                            <label for="email" class="text font-label">Email</label>
                            <input type="text" id="email" name="email" class="input form-control" value="<?= $adminAccount['email'] ?>">
                        </div>
                        <div class="input-block">
                            <label for="password" class="text font-label">Password</label>
                            <input type="password" id="password" name="password" class="input form-control" value="" placeholder="Enter new password">
                        </div>
                        <button type="submit" class="btn btn-danger">Save</button>
                    </div>
                </form>
            <?php endif;?>

            <br><br>

            <a href="<?= base_url('/admin/deleteAccount/'. session()->get('admin_id')) ?>">
                <button onclick="return confirm('Are you sure you want to delete this Account?\nyou will be redirected to homepage')" class="btn btn-danger">Delete Account</button>
            </a>
        </div>
    </section>
</main>


    <!-- successful update - modal show -->
    <div class="modal fade" id="myModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <center>
                    <?php if(session()->get('successUpdateProfile')) :?>
                        <span style="color: green; font-size: 24px; padding: 15px;">
                            <?= session()->get('successUpdateProfile'); ?>
                        </span>
                    <?php endif;?>
                    <?php if(session()->get('existingUsername')) :?>
                        <span style="color: red; font-size: 24px; padding: 15px;">
                            <?= session()->get('existingUsername'); ?>
                        </span>
                    <?php endif;?>
                    <?php if(session()->get('existingEmail')) :?>
                        <span style="color: red; font-size: 24px; padding: 15px;">
                            <?= session()->get('existingEmail'); ?>
                        </span>
                    <?php endif;?>
                    <?php if(session()->get('existingBoth')) :?>
                        <span style="color: red; font-size: 24px; padding: 15px;">
                            <?= session()->get('existingBoth'); ?>
                        </span>
                    <?php endif;?>
                </center>
                <center>
                    <button type="button" style="font-size: 10px; width: 100px; padding: 10px;" class="btn btn-danger" data-bs-dismiss="modal">
                        Close
                    </button> 
                </center>
            </div>
        </div>
    </div>


<!-- scripts  -->
<script>
     <?php if(session()->getFlashdata('successUpdateProfile') || session()->get('existingEmail') || session()->get('existingBoth') || session()->get('existingUsername')): ?>
        var myModal = new bootstrap.Modal(document.getElementById('myModal'));
        myModal.show();
    <?php endif; ?>
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>