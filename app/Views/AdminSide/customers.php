<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= base_url('Admin/css/dashboard.css') ?>">
    <link rel="stylesheet" href="<?= base_url('Admin/css/grid.css') ?>">
    <title>Dashboard</title>
    <style>
        /* SIDE NAV WHEN IN THIS PAGE - below css selectors can be found in the "sideNav.php" file */
        #customers { background-color: #d4ebf844; }
        aside nav ul #customers span { opacity: 1;}
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
        <h3>CUSTOMERS</h2>
    </div>

    <div class="main">

    </div>
</main>

</body>
</html>