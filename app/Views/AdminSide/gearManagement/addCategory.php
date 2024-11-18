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
        <?php echo view('AdminSide/includes/sideNav'); ?>
    </aside>

    <!-- Dashboard Content -->
    <section class="container-section item-container">
        <div class="header">
            <h1>Gears Management - add category</h1>

            <div class="buttons">
                <a href="<?= base_url('/admin/gears') ?>"><button>Back</button></a>
            </div>
        </div>
        
        <!-- Main -->
        <div class="container-content">
            <div class="form">
                <form action="<?= base_url('/admin/gears/addCat') ?>" method="post">
                    <div class="mb-3 mt-3">
                        <label for="category" class="form-label">Category</label>
                        <input type="text" class="form-control" id="category" placeholder="Enter gear name" name="category">
                    </div>
                    <button type="submit" class="btn btn-primary">Add</button>
                </form>
            </div>
        </div>
        <div class="container-content">
            <div class="table">
                <table>
                    <thead>
                        <tr>
                            <th style="min-width: 100px;">ID</th>
                            <th style="min-width: 790px;">Category</th>
                            <th style="min-width: 200px;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php if(isset($categories) && !empty($categories)) :?>
                    <?php foreach($categories as  $category) : ?>
                        <tr>
                            <td><?= esc($category['category_id']) ?></td>
                            <td><?= esc($category['category']) ?></td>
                            <td>
                                <a href="<?= base_url('/admin/gears/removeCats/'. $category['category_id']) ?>">
                                    <button onclick="return confirm('Are you sure you want to delete this Category?\nGear that has this category will be unset')" class="btn btn-danger">Delete</button>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    <?php else :?>
                        <tr>
                            <td colspan="8" id="zero">No Categories Added</td>
                        </tr>
                    <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</main>



   <!-- successful adding new category modal show -->
   <div class="modal fade" id="myModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <center>
                    <span style="color: green; font-size: 24px; padding: 15px;">
                        <?php if(session()->getFlashdata('catAdded')) :?>
                            <?= esc(session()->get('catAdded')) ?>
                        <?php endif;?>
                    </span>
                    <span style="color: red; font-size: 24px; padding: 15px;">
                        <?php if(session()->getFlashdata('catError')) :?>
                            <?= esc(session()->get('catError')) ?>
                        <?php endif;?>
                    </span>
                    <span style="color: green; font-size: 24px; padding: 15px;">
                        <?php if(session()->getFlashdata('catDeleted')) :?>
                            <?= esc(session()->get('catDeleted')) ?>
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
    <?php if(session()->getFlashdata('catAdded') || session()->getFlashdata('catError') || session()->getFlashdata('catDeleted')): ?>
        var myModal = new bootstrap.Modal(document.getElementById('myModal'));
        myModal.show();
    <?php endif; ?>
</script>    
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>