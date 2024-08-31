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
    .section1 {margin-left: 250px;;}
    .con {
      min-width: 1250px;
      max-width: fit-content;
    }
    .btnt { border-radius: 3px; background-color: lightblue; width: 100px; padding: 3px; position: fixed; bottom: 20px; right: 20px; z-index: 1;}
    .btnt a{color: black; font-weight: bold; font-family: Verdana, Geneva, Tahoma, sans-serif;}
    .btnt:hover, .btnt a:hover { background-color: #555; color: white; }
    .style { text-align: center;}

    table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 10px;
            border: 1px solid #ccc;
            position: relative;
        }
        .edit-btn {
            display: none;
            position: absolute;
            top: 0;
            right: 0;
            bottom: 0;
            left: 0;
            background-color: rgba(0, 123, 255, 0.7);
            color: white;
            border: none;
            cursor: pointer;
            text-align: center;
            justify-content: center;
            align-items: center;
            opacity: 0.8;
        }
        td:hover .edit-btn {
            display: flex;
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

<div class="section1">   
  <div class="container-fluid con">
    <div class="container-fluid">
      <div class="container-fluid">
        <div class="card">
          <a href="#buttons"><button class="btnt">Back to top</button></a>
            <!-- success and error message after adding new category -->
            <?php 
              if(session()->getFlashdata('categoryCreated')){ echo "<h5 class='success'>". session()->get('categoryCreated') ."</h5>"; }
              if(session()->getFlashdata('categoryError')) { echo "<h5 class='error'>". session()->get('categoryError') ."</h5>"; }
              if(session()->getFlashdata('gearError')) { echo "<h5 class='error'>". session()->get('gearError') ."</h5>"; }
              if(session()->getFlashdata('gearAdded')) { echo "<h5 class='success'>". session()->get('gearAdded') ."</h5>"; }
            ?>
          <div class="card-body">
            <!-- product actions -->
            <div class="actions_container" id="buttons">
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
                    <option value="default" selected disabled style="background: #999; color: black;">Filter Table</option> <!-- default value is null -->
                    <option value="default">ascending (default)</option>
                    <option value="descending">descending</option>
                    <option value="byPrice">by price</option>
                    <option value="byStocks">by stocks</option>
                    <option value="nameAsc">Name ascending</option>
                    <option value="namedes">Name descending</option>
                    <option value="categoryAsc">by category ascending</option>
                    <option value="categoryDes">by category descending</option>
              </select>

              <!-- table for gears -->
              <div class="card">
                <table>
                  <thead>
                      <tr>
                          <th class="one">Id</th>
                          <th class="two">Image</th>
                          <th class="three">Name</th>
                          <th class="four">Price</th>
                          <th class="five">Stocks</th>
                          <th class="six">Category</th>
                          <th class="seven">Description</th>
                          <th class="eight">Actions</th>
                      </tr>
                  </thead>
                  <tbody>
                    <?php if(isset($showProducts)) :?>
                      <?php foreach($showProducts as $gear) :?>
                        <tr class="style">
                          <td class="style1"><?= $gear['product_id']?></td>
                          <td class="style2" style=" width: 120px; height: 120px; padding: 5px; margin: 0;">
                            <img  src="<?= $gear['image_url']?>"
                                  style="border-radius: 5px; margin:auto; width: 120px; height: 120px;" 
                                  alt="<?= $gear['product_name']?>">
                          </td>
                          <td class="style style3"><?= $gear['product_name']?></td>
                          <td class="style style4"><?= $gear['price']?></td>
                          <td class="style style5"><?= $gear['stock_quantity']?></td>
                          <td class="style style6">
                            <?php if($gear['category'] == null) :?>
                              <h5 style="color: red">not set</h5>
                            <?php else :?>
                              <?= $gear['category']?>
                          <?php endif;?>
                          </td>
                          <td class="style style7">
                            <?php if($gear['description'] == null) :?>
                              <h5 style="color: red">no description</h5>
                            <?php else : ?>
                              <?= $gear['description']?>
                            <?php endif;?>
                            </php>
                          </td>
                          <td class="style style8">
                            <button class="btn btn-primary w-75 mb-2 save" data-bs-toggle="modal" data-bs-target="#editGearModalLabel">Edit</button>
                            <br>
                            <button class="btn btn-danger w-75">Remove</button>
                          </td>
                        </tr>

                      <?php endforeach;?>
                    <?php else :?>
                        <tr>
                          <td colspan="8" style="text-align: center;">No Products Available</td>
                        </tr>
                    <?php endif;?>
                  </tbody>
                </table>
              </div>    
            </div>
                    
          </div>
        </div>
      </div>
    </div>
    
    <!-- -------------------------------------------------------------------------------------------------------------------------------- -->
    
    <!-- MODAL for EDITING -->
    <div class="modal fade" id="editGearModalLabel" tabindex="-1" aria-labelledby="editGearModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">      
          <div class="modal-header">
            <h5 class="modal-title" id="editGearModalLabel">Edit</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>

          <div class="modal-body">
            <form action="" method="post" enctype="multipart/form-data">
              <div class="mb-3">
                <form action="<?= base_url('') ?>" method="post" enctype="multipart/form-data">
                    <label for="image_url" class="form-label">Image</label><br><br>
                    <label for="product_name" class="form-label">Gear name</label><br><br>
                    <label for="price" class="form-label">price</label><br><br>
                    <label for="category" class="form-label">category</label><br><br>
                    <label for="description" class="form-label">description</label><br><br>

                    <input type="hidden" name="product_id" id="product_id">
                  <button type="submit" class="btn btn-primary">Save changes</button>
                </form>
              </div>
              <input type="hidden" name="action" value="add">
            </form>
          </div>
        </div>
      </div>
    </div>

    <!-- Modal for Adding gear -->
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
                <label for="quantity" class="form-label">Stocks</label>
                <input type="number" class="form-control" id="quantity" name="quantity" required>
              </div>

              <!-- options for selecting categories -->
              <div class="mb-3">
                <label for="cat_id" class="form-label">Category</label>
                <select class="form-select" id="categorySelected" name="categorySelected">

                  <!-- check if theres a category in database display if there is a category -->
                  <?php if(!empty($categories)) :?>
                    <option value="" selected disabled style="background: #999; color: black;">Select Category</option> <!-- default value is null -->
                    <option value="" title="will set to null if there is no category">None</option>
                    <?php foreach($categories as $category) : ?>
                      <option value="<?= esc($category['category_id']); ?>"><?= esc($category['category']); ?></option>
                    <?php endforeach;?>
                  <?php else :?>
                    <option value="" title="will set to null if there is no category">No categories available</option>
                  <?php endif;?>
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