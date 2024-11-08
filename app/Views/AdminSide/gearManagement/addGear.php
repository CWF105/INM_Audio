<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Gear Management</title>
    <link rel="stylesheet" href="<?= base_url('admin/css/products.css') ?>">
    <link rel="stylesheet" href="<?= base_url('admin/css/grid.css') ?>">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        #management { 
            background-color: #356172; 
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
        <?php echo view('AdminSide/sideNav'); ?>
    </aside>

    <!-- Dashboard Content -->
    <section class="container-section item-container">
        <div class="header">
            <h1>Gears Management - add gear</h1>

            <div class="buttons">
                <a href="<?= base_url('/admin/gears') ?>"><button>Back</button></a>
            </div>
        </div>

        <!-- Main -->
        <div class="container-content">
            <div class="form">
                <form action="<?= base_url('/admin/gears/addGear') ?>" method="post" enctype="multipart/form-data">
                    <div class="mb-3 mt-3">
                        <label for="gear" class="form-label">Gear Name</label>
                        <input type="text" class="form-control" id="gear" placeholder="Enter gear name" name="gear">
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description:</label>
                        <textarea style="resize: none;" class="form-control" id="description" placeholder="Enter description" name="description" rows="5" cols="50"></textarea>
                    </div>
                    <div class="mb-3 mt-3">
                        <label for="price" class="form-label">Price</label>
                        <input type="text" class="form-control" id="price" placeholder="Enter price " name="price">
                    </div>
                    <div class="mb-3 mt-3">
                        <label for="stocks" class="form-label">Stocks</label>
                        <input type="text" class="form-control" id="stocks" placeholder="Enter stocks" name="quantity">
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
                    <button type="submit" class="btn btn-primary">Add</button>
                </form>
            </div>
        </div>

    </section>
</main>


<!-- successful creating gear - modal show -->
<!-- success and error message after adding new category -->
   <div class="modal fade" id="myModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <center>
                    <span style="color: green; font-size: 24px; padding: 15px;">
                        <?php if(session()->getFlashdata('gearAdded')) :?>
                            <?= esc(session()->get('gearAdded')) ?>
                        <?php endif;?>
                    </span>
                    <span style="color: red; font-size: 24px; padding: 15px;">
                        <?php if(session()->getFlashdata('gearError')) :?>
                            <?= esc(session()->get('gearError')) ?>
                        <?php endif;?>
                    </span>
                </center>
                <center>
                    <button type="button" style="font-size: 10px; width: 100px; padding: 10px;" class="btn btn-danger" data-bs-dismiss="modal">
                        Close
                    </button> 
                </center>
            </div>
        </div>
    </div>

<!-- scripts -->
<script>
    <?php if(session()->getFlashdata('gearAdded') || session()->getFlashdata('gearError')): ?>
        var myModal = new bootstrap.Modal(document.getElementById('myModal'));
        myModal.show();
    <?php endif; ?>
</script>  
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>