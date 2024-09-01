<!doctype html>
<html lang="en">

<head>
<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>INM Admin - gear management</title>
  <link rel="shortcut icon" type="image/png" href="<?= base_url('assets/css/logo.png') ?>" />
  <link rel="stylesheet" href="<?= base_url('Admin_Side_Assets/css/styles.min.css') ?>" />
  <link rel="stylesheet" href="<?= base_url('Admin_Side_Assets/css/table.css') ?>" />
  <link rel="stylesheet" href="<?= base_url('Admin_Side_Assets/css/adminProducts.css')?>">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer"/>
  

</head>
<body class="bg">
<!--  Body Wrapper -->
<div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full" data-sidebar-position="fixed" data-header-position="fixed">

<!-- includes admin side menu panel -->
    <?php echo view('AdminSide/sideMenu'); ?>

<!-- MAIN CONTENT -->
    <div class="bgProducts">
        <!-- Switch tab buttons -->
        <div class="switchTabButton">
            <button class="tab-btn active" data-switch-tab="tab-1">Gears</button>
            <button class="tab-btn " data-switch-tab="tab-2">Add Gear</button>
            <button class="tab-btn " data-switch-tab="tab-3">Add Category</button>
            <button class="tab-btn " data-switch-tab="tab-4">Manage Comments</button>
        </div>


    <!-- Tabs  -->
        <!-- products table tab -->
        <div class="productsTable bgProducts tab-content" id="tab-1">
            <!-- success and error message after adding new category -->
            <?php 
              if(session()->getFlashdata('categoryCreated')){ echo "<h5 class='success'>". session()->get('categoryCreated') ."</h5>"; }
              if(session()->getFlashdata('categoryError')) { echo "<h5 class='error'>". session()->get('categoryError') ."</h5>"; }
              if(session()->getFlashdata('gearError')) { echo "<h5 class='error'>". session()->get('gearError') ."</h5>"; }
              if(session()->getFlashdata('gearAdded')) { echo "<h5 class='success'>". session()->get('gearAdded') ."</h5>"; }
            ?>

            <h4>Gears Table</h4>
        </div>

        <!-- add new products tab -->
        <div class="addNewProducts bgProducts tab-content" id="tab-2">
            <!-- success and error message after adding new category -->
            <?php 
              if(session()->getFlashdata('categoryCreated')){ echo "<h5 class='success'>". session()->get('categoryCreated') ."</h5>"; }
              if(session()->getFlashdata('categoryError')) { echo "<h5 class='error'>". session()->get('categoryError') ."</h5>"; }
              if(session()->getFlashdata('gearError')) { echo "<h5 class='error'>". session()->get('gearError') ."</h5>"; }
              if(session()->getFlashdata('gearAdded')) { echo "<h5 class='success'>". session()->get('gearAdded') ."</h5>"; }
            ?>
            <h4>Add new Gear </h4>
        </div>

        <!-- add new category tab -->
        <div class="addNewCategory bgProducts tab-content" id="tab-3">
            <!-- success and error message after adding new category -->
            <?php 
              if(session()->getFlashdata('categoryCreated')){ echo "<h5 class='success'>". session()->get('categoryCreated') ."</h5>"; }
              if(session()->getFlashdata('categoryError')) { echo "<h5 class='error'>". session()->get('categoryError') ."</h5>"; }
              if(session()->getFlashdata('gearError')) { echo "<h5 class='error'>". session()->get('gearError') ."</h5>"; }
              if(session()->getFlashdata('gearAdded')) { echo "<h5 class='success'>". session()->get('gearAdded') ."</h5>"; }
            ?>
            <h4>Create new Category</h4>
        </div>

        <div class="manageComments bgProducts tab-content" id="tab-4">
            <!-- success and error message after adding new category -->
            <?php 
              if(session()->getFlashdata('categoryCreated')){ echo "<h5 class='success'>". session()->get('categoryCreated') ."</h5>"; }
              if(session()->getFlashdata('categoryError')) { echo "<h5 class='error'>". session()->get('categoryError') ."</h5>"; }
              if(session()->getFlashdata('gearError')) { echo "<h5 class='error'>". session()->get('gearError') ."</h5>"; }
              if(session()->getFlashdata('gearAdded')) { echo "<h5 class='success'>". session()->get('gearAdded') ."</h5>"; }
            ?>
            <h4>Manage Comments</h4><hr>
        </div>

    </div>

</div>

<script src="<?= base_url('Admin_Side_Assets/js/adminProducts.js')?>"></script>
<script src=" <?= base_url('Admin_Side_Assets/libs/jquery/dist/jquery.min.js') ?>"></script>
<script src=" <?= base_url('Admin_Side_Assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js') ?>"></script>
<script src=" <?= base_url('Admin_Side_Assets/js/sidebarmenu.js') ?>"></script>
<script src="<?= base_url('Admin_Side_Assets/js/app.min.js ') ?>"></script>
<script src=" <?= base_url('Admin_Side_Assets/libs/simplebar/dist/simplebar.js') ?>"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>