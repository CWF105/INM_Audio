<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- @ICON -->
    <link rel="shortcut icon" href="<?= base_url('assets/img/logo.png') ?>" type="image/x-icon">
    <!-- @CSS FILE LINKS -->
    <link rel="stylesheet" href=" <?= base_url('assets/css/style.css') ?>">
    <link rel="stylesheet" href=" <?= base_url('assets/css/navbar.css') ?>">
    <link rel="stylesheet" href=" <?= base_url('assets/css/footer.css') ?>">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer"/>
    
    <title>INM User Settings    </title>
    <style>
        a { color: red; text-decoration: none; font-size: 24px;}
        a:hover { color: darkred;}
        a:active {color: black; }
    </style>
</head>
<body>
<!-- @PHP CODE HEADER - this includes header.php file on every website that has this code -->
    <?php  echo view("includes/header.php"); ?>
<!-- @END PHP CODE HEADER  -->


<!-- @MAIN CONTENT - all contents goes here -->
<div class="content">
    <!-- logout button -->
    <a href="<?= base_url('/user/logout') ?>">Logout</a>
</div>
<!-- @END MAIN CONTENT -->


<!-- @PHP CODE FOOTER - includes footer  -->
    <?php  echo view("includes/footer.php"); ?> 
<!-- @END PHP CODE FOOTER  -->


<!-- @SCRIPTS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script defer src="<?= base_url('assets/js/script.js') ?>"></script>

</body>
</html>