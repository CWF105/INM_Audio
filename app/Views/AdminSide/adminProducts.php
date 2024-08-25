<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Modernize Free</title>
  <link rel="shortcut icon" type="image/png" href="<?= base_url('assets/css/logo.png') ?>" />
  <link rel="stylesheet" href="<?= base_url('AdminSideAssets/css/styles.min.css') ?>" />
  <link rel="stylesheet" href="<?= base_url('AdminSideAssets/css/table.css') ?>" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer"/>

</head>

<body>
   <!--  Body Wrapper -->
   <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
    data-sidebar-position="fixed" data-header-position="fixed">

    <!-- Sidebar Start -->
    <aside class="left-sidebar">
      <!-- Sidebar scroll-->
      <div>

      <!-- logo -->
        <div class="brand-logo d-flex align-items-center justify-content-between">
          <a href="index.php <?= base_url('/admin') ?>" class="text-nowrap logo-img">
            <img src="<?= base_url('assets/images/logo.png') ?>" width="150" alt="" />
          </a>
        </div>


        <!-- Sidebar navigation-->
        <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
          <ul id="sidebarnav">

            <!-- HEADER - HOME -->
            <li class="nav-small-cap">
              <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
              <span class="hide-menu">Home</span>
            </li>

            <!-- DASHBOARD -->
            <li class="sidebar-item">
              <a class="sidebar-link" href="<?= base_url("/admin") ?>" aria-expanded="false">
                <span>
                  <i class="ti ti-layout-dashboard"></i>
                </span>
                <span class="hide-menu">Dashboard</span>
              </a>
            </li>

                    <!-- space between dashboard and the bottom menus -->
                    <li class="nav-small-cap">
                      <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                    </li>



            <!-- TRANSACTIONS  -->
            <li class="sidebar-item">
              <a class="sidebar-link" href="<?= base_url("/admin/transactions") ?>" aria-expanded="false">
                <span>
                  <i class="fa-solid fa-store"></i>
                </span>
                <span class="hide-menu">Transactions</span>
              </a>
            </li>



            <!-- PRODUCT  -->
            <li class="sidebar-item">
              <a class="sidebar-link" href="<?= base_url("/admin/products") ?>" aria-expanded="false">
                <span>
                  <i class="fa-solid fa-store"></i>
                </span>
                <span class="hide-menu">Product</span>
              </a>
            </li>


            <!-- MANAGE USERS -->
            <li class="sidebar-item">
              <a class="sidebar-link" href="<?= base_url("/admin/manageUsers") ?>" aria-expanded="false">
                <span>
                  <i class="ti ti-cards"></i>
                </span>
                <span class="hide-menu">Users</span>
              </a>
            </li>

            
            <!-- HEADING - dash line -->
            <li class="nav-small-cap">
              <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
              <span class="hide-menu">---------------------------</span>
            </li>

            <!-- Log out button -->
            <li class="sidebar-item">
              <a class="sidebar-link" href="<?= base_url("Signup_Login/logout") ?>" aria-expanded="false">
                <span>
                  <i class="ti ti-login"></i>
                </span>
                <span class="hide-menu">Logout</span>
              </a>
            </li>

            <!-- Register new admin button -->
            <li class="sidebar-item">
              <a class="sidebar-link" href="<?= base_url("/admin/adminRegister") ?>" aria-expanded="false">
                <span>
                  <i class="ti ti-user-plus"></i>
                </span>
                <span class="hide-menu">Create new admin</span>
              </a>
            </li>
          </ul>
        </nav>
        <!-- End Sidebar navigation -->
      </div>
      <!-- End Sidebar scroll-->
    </aside>
    <!--  Sidebar End -->




    <!--  Main wrapper -->
    <div class="body-wrapper">
    <div class="container-fluid">
  <div class="container-fluid">
    <div class="card">
      <div class="card-body">
        <button class="btn btn-primary w-30 py-8 fs-4 mb-4 rounded-2" data-bs-toggle="modal" data-bs-target="#addProductModal">
          Add New Product
        </button>
        <h5 class="card-title fw-semibold mb-4">Products </h5>          

        <div class="card">
          <div class="card-body p-4">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>Product</th>
                  <th>Name</th>
                  <th>Price</th>
                  <th>Category</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <!-- rows here  -->
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Modal for Adding Product -->
<div class="modal fade" id="addProductModal" tabindex="-1" aria-labelledby="addProductModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addProductModalLabel">Add New Product</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">

        <form action="<?= base_url('/admin/newProduct') ?>" method="post" enctype="multipart/form-data">
          <div class="mb-3">
            <label for="product" class="form-label">Product Name</label>
            <input type="text" class="form-control" id="product" name="product" required>
          </div>
          <div class="mb-3">
            <label for="price" class="form-label">Price</label>
            <input type="number" class="form-control" id="price" name="price" required>
          </div>
          <div class="mb-3">
            <label for="quantity" class="form-label">Quantity</label>
            <input type="number" class="form-control" id="quantity" name="quantity" required>
          </div>
          <div class="mb-3">
            <label for="cat_id" class="form-label">Category</label>
            <select class="form-select" id="cat_id" name="cat_id" >

              <!-- Populate options dynamically from categories table -->
  

            </select>
          </div>
          <div class="mb-3">
            <label for="image" class="form-label">Product Image</label>
            <input type="file" class="form-control" id="image" name="image" accept="image/*">
          </div>
          <button type="submit" class="btn btn-primary">Add Product</button>
        </form>
      </div>
    </div>
  </div>
</div>

  <?php if (session()->getFlashdata('success')): ?>
    <div class="alert alert-success">
      <?= session()->getFlashdata('success') ?>
    </div>
  <?php endif; ?>

  <?php if (session()->getFlashdata('error')): ?>
    <div class="alert alert-danger">
      <?= session()->getFlashdata('error') ?>
    </div>
  <?php endif; ?>


  <script src="../assets/libs/jquery/dist/jquery.min.js"></script>
  <script src="../assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <script src="../assets/js/sidebarmenu.js"></script>
  <script src="../assets/js/app.min.js"></script>
  <script src="../assets/libs/simplebar/dist/simplebar.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>