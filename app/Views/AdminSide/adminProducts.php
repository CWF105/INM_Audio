<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>INM Admin - gear management</title>
  <link rel="shortcut icon" type="image/png" href="<?= base_url('assets/css/logo.png') ?>" />
  <link rel="stylesheet" href="<?= base_url('Admin_Side_Assets/css/styles.min.css') ?>" />
  <link rel="stylesheet" href="<?= base_url('Admin_Side_Assets/css/table.css') ?>" />

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer"/>
  
  <style>
    .success {color: green; margin: 10px;}
    .error {color: red; margin: 10px;}
    .actions {
      background-color: azure;
      border: 1px solid gray;
      color: black;
    }
    .actions:hover {
      background-color: dimgrey;
      color: white;
    }

  </style>
</head>

<body>
   <!--  Body Wrapper -->
   <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
    data-sidebar-position="fixed" data-header-position="fixed">

<!-- includes admin side menu panel -->
    <?php 
      echo view('AdminSide/sideMenu');
    ?>

  <!--  Main wrapper -->
<div class="body-wrapper">
  <div class="container-fluid">
    <div class="container-fluid">
      <div class="card">
          <!-- success and error message after adding new category -->
          <?php 
            if(session()->getFlashdata('categoryCreated')){ echo "<h5 class='success'>". session()->get('categoryCreated') ."</h5>"; }
            if(session()->getFlashdata('categoryError')) { echo "<h5 class='error'>". session()->get('categoryError') ."</h5>"; }
            if(session()->getFlashdata('gearError')) { echo "<h5 class='error'>". session()->get('gearError') ."</h5>"; }
            if(session()->getFlashdata('gearAdded')) { echo "<h5 class='success'>". session()->get('gearAdded') ."</h5>"; }

          ?>
        <div class="card-body">
        <!-- product actions -->
          <div class="actions_container">
            <!-- add gear -->
            <button class="btn btn-primary w-30 py-8 fs-4 mb-4 rounded-2" data-bs-toggle="modal" data-bs-target="#addProductModal">
              Add New Gear
            </button>

            <!-- add category -->
            <button class="btn w-15 py-8 fs-4 mb-4 rounded-2 actions" data-bs-toggle="modal" data-bs-target="#addCategoryModal">
              Manage Category
            </button>

          <h5 class="card-title fw-semibold mb-4">Products </h5>          
          <select class="form-select w-25 mb-2" id="filterSelected" name="filterSelected" >
                <option value="" selected disabled style="background: #999; color: black;">Filter Table</option> <!-- default value is null -->
          </select>

          <!-- table for gears -->
          <div class="card">
          <table>
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Stocks</th>
                    <th>Category</th>
                    <th>Description</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <!--  -->
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

          <form action="<?= base_url('/admin/products/add') ?>" method="post" enctype="multipart/form-data">
            <div class="mb-3">
              <label for="gear" class="form-label">Gear Name</label>
              <input type="text" class="form-control" id="gear" name="gear" required>
            </div>
            <div class="mb-3">
              <label for="description" class="form-label">Description:</label>
              <textarea id="description" class="form-control" name="description" rows="1" cols="50" placeholder="Enter the gear description..."></textarea>
            </div>
            <div class="mb-3">
              <label for="price" class="form-label">Price</label>
              <input type="number" class="form-control" id="price" name="price" required>
            </div>
            <div class="mb-3">
              <label for="quantity" class="form-label">Quantity</label>
              <input type="number" class="form-control" id="quantity" name="quantity" required>
            </div>

            <!-- options for selecting categories -->
            <div class="mb-3">
              <label for="cat_id" class="form-label">Category</label>
              <select class="form-select" id="categorySelected" name="categorySelected">
                <option value="" selected disabled style="background: #999; color: black;">Select Category</option> <!-- default value is null -->
                
                <!-- check if theres a category in database display if there is a category -->
                <?php if (!empty($category) && is_array($category)): ?>
                    <?php foreach ($category as $categories): ?>
                        <option value="<?= esc($categories['category_id']); ?>"><?= esc($categories['category']); ?> </option>
                    <?php endforeach; ?>
                <?php else: ?>
                    <option value="">No categories available</option>
                <?php endif; ?>
              </select>


            </div>
            <div class="mb-3">
              <label for="image" class="form-label">Gear Image</label>
              <input type="file" class="form-control" id="image" name="image" accept="image/*">
            </div>
            <button type="submit" class="btn btn-primary">Add Gear</button>
          </form>
        </div>
      </div>
    </div>
  </div>


  <!-- Modal for Adding New Category -->
  <div class="modal fade" id="addCategoryModal" tabindex="-1" aria-labelledby="addCategoryModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">      
        <div class="modal-header">
          <h5 class="modal-title" id="addProductModalLabel">Manage Category</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

        </div>
        <div class="modal-body">

          <form action="<?= base_url('/admin/category') ?>" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="category" class="form-label">Category</label>
                <input type="text" class="form-control" id="category" name="category" required>
            </div>

            <input type="hidden" name="action" value="add">

            <button type="submit" class="btn btn-primary add" onclick="document.getElementsByName('action')[0].value='add'">Add Category</button>
            <button type="submit" class="btn btn-danger del" onclick="document.getElementsByName('action')[0].value='delete'">Delete Category</button>
          </form>
        </div>
      </div>
    </div>
  </div>


  <script src=" <?= base_url('Admin_Side_Assets/libs/jquery/dist/jquery.min.js') ?>"></script>
  <script src=" <?= base_url('Admin_Side_Assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js') ?>"></script>
  <script src=" <?= base_url('Admin_Side_Assets/js/sidebarmenu.js') ?>"></script>
  <script src="<?= base_url('Admin_Side_Assets/js/app.min.js ') ?>"></script>
  <script src=" <?= base_url('Admin_Side_Assets/libs/simplebar/dist/simplebar.js') ?>"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>