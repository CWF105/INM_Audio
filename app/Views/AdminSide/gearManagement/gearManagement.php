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
            background-color: #5fa8d3; 
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
        <div class="header" id="top">
            <a href="#top"><button style="position:fixed; bottom: 0; right: 30px; padding: 5px; color: black; border: 1px solid black;">^</button></a>
            <h1>Gears Management</h1>

            <div class="buttons">
                <a href="<?= base_url('/admin/gears/addGears') ?>"><button>Add Gear</button></a>
                <a href="<?= base_url('/admin/gears/addCategory') ?>"><button>Categories</button></a>
                &nbsp;
                <form action="<?= base_url('/admin/gears/searchGears') ?>" method="get">
                    <input type="search" name="search" placeholder="Search Product">
                    <input class="search" type="submit" value="Search">
                </form>
            </div>
        </div>

        <div class="container-content">
            <div class="table">
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Image</th>
                            <th>Gear Name</th>
                            <th>Price</th>
                            <th>Stocks</th>
                            <th>Category</th>
                            <th>Description</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(isset($gears) && !empty($gears)) :?>
                            <?php foreach($gears as  $gear) : ?>
                                <tr>
                                    <td id="one"><?= esc($gear['product_id']) ?></td>
                                    <td id="two">
                                        <a href="<?= esc($gear['image_url']) ?>" title="click the image to view" target="_blank">
                                            <img src="<?= esc($gear['image_url']) ?>" alt="<?= esc($gear['product_name']) ?>">
                                        </a>
                                    </td>
                                    <td id="three"><?= esc($gear['product_name']) ?></td>
                                    <td id="four"><?= esc($gear['price']) ?></td>
                                    <td id="five"><?= esc($gear['stock_quantity']) ?></td>
                                    <td id="six">
                                        <?php if($gear['category']) :?> <?= esc($gear['category']) ?>
                                        <?php else : ?>
                                            <p style="color: red;">Category not set</p>
                                        <?php endif;?>
                                    </td>
                                    <td id="seven"><?= esc($gear['description']) ?></td>
                                    <td id="eight">
                                        <a href="<?= base_url('') ?>"><button class="btn btn-primary">Edit</button></a>
                                        <a href="<?= base_url('/admin/gears/removeGears/'. $gear['product_id']) ?>">
                                            <button onclick="return confirm('Are you sure you want to delete this Gear?')" class="btn btn-danger">Remove</button>
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else :?>
                            <tr>
                                <td colspan="8" id="zero">No Gears Added</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</main>

 <!-- newly logged in modal show -->
 <div class="modal fade" id="myModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <center>
                <span style="color: green; font-size: 24px; padding: 15px;">
                    <?php if(session()->getFlashdata('removeSuccess')) :?>
                        <?= esc(session()->get('removeSuccess')) ?>
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

<script>
     <?php if(session()->getFlashdata('removeSuccess')): ?>
        var myModal = new bootstrap.Modal(document.getElementById('myModal'));
        myModal.show();
    <?php endif; ?>
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>