<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href=" <?= base_url('assets/css/style.css') ?>">
    <link rel="stylesheet" href=" <?= base_url('assets/css/navbar.css') ?>">
    <link rel="stylesheet" href=" <?= base_url('assets/css/footer.css') ?>">
    <link rel="shortcut icon" href="<?= base_url('assets/img/logo.png') ?>" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <title>INM User Settings    </title>
    <script defer src="<?= base_url('assets/js/script.js') ?>"></script>
</head>
    <style>
        a { color: red; text-decoration: none; font-size: 24px;}
        a:hover { color: darkred;}
        a:active {color: black; }
    </style>
<body>
<!-- ## -------------------------------------------------------------------------------------------------------------------------------------------------------------- ## -->
<!-- ## -------------------------------------------------------------------------------------------------------------------------------------------------------------- ## -->
<!-- this includes header.php file on every website that has this code -->
    <?php 
        echo view("others/header.php");
    ?>
<!-- ## -------------------------------------------------------------------------------------------------------------------------------------------------------------- ## -->
<!-- ## -------------------------------------------------------------------------------------------------------------------------------------------------------------- ## -->
<!-- Content goes here -->

<div class="content">

    <a href="<?= base_url('/user/logout') ?>">Logout</a>
</div>


<!-- ## -------------------------------------------------------------------------------------------------------------------------------------------------------------- ## -->
<!-- ## -------------------------------------------------------------------------------------------------------------------------------------------------------------- ## -->
<!-- this includes footer.php file on every website that has this code -->
    <?php 
        echo view("others/footer.php");
    ?> 
<!-- ## -------------------------------------------------------------------------------------------------------------------------------------------------------------- ## -->
<!-- ## -------------------------------------------------------------------------------------------------------------------------------------------------------------- ## -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>