<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
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
        <h1>Gears Management</h1>
        
        <div class="container-content ">
            <div class="table">
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
    </section>
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>