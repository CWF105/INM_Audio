<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>INM Admin - users management</title>
  <link rel="shortcut icon" type="image/png" href=" <?= base_url('Admin_Side_Assets/images/logos/logo.png') ?>" />
  <link rel="stylesheet" href="<?= base_url('Admin_Side_Assets/css/styles.min.css') ?>"/>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer"/>
</head>

<body>
  <!--  Body Wrapper -->
  <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
    data-sidebar-position="fixed" data-header-position="fixed">
  
<!-- includes admin side menu panel -->
    <?php 
      echo view('AdminSide/sideMenu');
    ?>


    </div>
  </div>
  <script src="<?= base_url('Admin_Side_Assets/libs/jquery/dist/jquery.min.js') ?>"></script>
  <script src="<?= base_url('Admin_Side_Assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js') ?>"></script>
  <script src="<?= base_url('Admin_Side_Assets/js/sidebarmenu.js') ?>"></script>
  <script src="<?= base_url('Admin_Side_Assets/js/app.min.js') ?>"></script>
  <script src="<?= base_url('Admin_Side_Assets/libs/apexcharts/dist/apexcharts.min.js') ?>"></script>
  <script src="<?= base_url('Admin_Side_Assets/libs/simplebar/dist/simplebar.js ') ?>"></script>
  <script src="<?= base_url('Admin_Side_Assets/js/dashboard.js') ?>"></script>
</body>

</html>