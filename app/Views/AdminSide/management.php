<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= base_url('Admin/css/management.css') ?>">
    <link rel="stylesheet" href="<?= base_url('Admin/css/grid.css') ?>">
    <title>Management</title>
    <style>
        /* SIDE NAV WHEN IN THIS PAGE - below css selectors can be found in the "sideNav.php" file */
        #management { background-color: #d4ebf844; }
        aside nav ul #management span { opacity: 1;}
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
        <h3>Management</h2>

        <!-- SUCCESS MESSAGE -->
        <?php if(session()->getFlashdata('catAdded')) :?>
            <span style="color: darkgreen;"><?= esc(session()->get('catAdded')) ?></span>
        <?php endif;?>
        <?php if(session()->getFlashdata('catDeleted')) :?>
            <span style="color: darkgreen;"><?= esc(session()->get('catDeleted')) ?></span>
        <?php endif;?>
        <?php if(session()->getFlashdata('gearAdded')) :?>
            <span style="color: darkgreen;"><?= esc(session()->get('gearAdded')) ?></span>
        <?php endif;?>

        <!-- ERROR MESSAGE -->
        <?php if(session()->getFlashdata('catError')) :?>
            <span style="color:darkred;"><?= esc(session()->get('catError')) ?></span>
        <?php endif;?>
        <?php if(session()->getFlashdata('gearError')) :?>
            <span style="color:darkred;"><?= esc(session()->get('gearError')) ?></span>
        <?php endif;?>
    </div>

    <div class="main">
        <div class="top">
            <button id="openGearModal" class="modalButton">
                <p>Add Gear</p>
                <img src="<?= base_url('Admin/img/icons/add.png') ?>" alt="">
            </button>

            <button id="openCategoriesModal" class="modalButton">
                <p>Add Category</p>
                <img src="<?= base_url('Admin/img/icons/add.png') ?>" alt="">
            </button>
        </div>

        <div class="content">
            <div class="tabs">
                <button onclick="switchTab('table1')">Gears</button>
                <button onclick="switchTab('table2')">Categories</button>
            </div>

            <!-- GEARS -->
            <div id="table1" class="tab-content active">
                <h3>GEARS</h3>
                <table>
                    <thead>
                        <tr>
                            <th>Item ID</th>
                            <th>Item</th>
                            <th>Price</th>
                            <th>Stock</th>
                            <th>Category</th>
                            <th>...</th>                        
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(isset($gears) && !empty($gears)) :?>
                            <?php foreach($gears as  $gear) : ?>
                            <tr>
                                <td class="th one"><?= esc($gear['product_id']) ?></td>
                                <td class="th two">
                                    <a href="<?= esc($gear['image_url']) ?>" title="click the image to view" target="_blank">
                                        <img src="<?= esc($gear['image_url']) ?>" alt="image">
                                    </a>
                                    <p><?= esc($gear['product_name']) ?></p>
                                </td>
                                <td class="th three"><?= esc($gear['price']) ?></td>
                                <td class="th four"><?= esc($gear['stock_quantity']) ?></td>
                                <td class="th five">
                                    <?php if($gear['category']) :?> 
                                        <?= esc($gear['category']) ?>
                                    <?php else : ?>
                                        <p style="color: red;">Category not set</p>
                                    <?php endif; ?>
                                </td>
                                <td class="th six">
                                    <a href="#" class="button1 view-button" data-target="gearItem">View</a>
                                    <a href="" class="button3">remove</a>
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

            <!-- CATEGORIES -->
            <div id="table2" class="tab-content">
                <h3>CATEGORIES</h3>
                <table>
                    <thead>
                        <tr>
                            <th>Category ID</th>
                            <th>Category</th>
                            <th>...</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php if(isset($categories) && !empty($categories)) :?>
                        <?php foreach($categories as  $category) : ?>
                        <tr>
                            <td class="th one"><?= $category['category_id'] ?></td>
                            <td class="th two"><?= $category['category'] ?></td>
                            <td class="th six">
                                <a href="<?= base_url('/admin/gears/removeCats/'. $category['category_id']) ?>" class="button3"
                                onclick="return confirm('Are you sure you want to delete this Category?\nGear that has this category will be unset')"
                                class="btn btn-danger">Remove</a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php else :?>
                        <tr>
                            <td colspan="8" style="color: #4f4f4f; opacity: .4; padding: 10px;">No Categories Added</td>
                        </tr>
                    <?php endif; ?>
                    </tbody>
                </table>            
            </div>
        </div>


        <!-- MODAL FOR VIEWING EACH ITEM--> 
        <div id="gearItem" class="modal">
            <div class="modal-content">
                <div class="add">
                    <span class="close close-gear">&times;</span>
                    <h2>Gear Item Name</h2>
                    <h5>Gear ID: 84736</h5>
                </div>
                <form action="/updateGear" method="post">
                    <div class="content">
                        <button type="button" id="editButton">Edit</button>
                        <button type="submit" id="saveButton" style="display: none;">Save</button>
                        <button type="button" id="cancelButton" style="display: none;">Cancel</button>

                        <div class="gearName">
                            <input type="text" name="gearName" class="edit-mode" value="GearName" style="display: none;">
                        </div>

                        <div class="img">
                            <img src="<?= base_url('Admin/img/icons/account.png') ?>" alt="">
                            <input type="file" name="img" class="edit-mode" value="" style="display: none;">
                        </div>

                        <div class="description">
                            <h3>Description</h3>
                            <p class="read-only">Lorem, ipsum dolor sit amet consectetur adipisicing elit.</p>
                            <input type="text" name="description" class="edit-mode" value="Lorem, ipsum dolor sit amet consectetur adipisicing elit." style="display: none;">
                        </div>

                        <div class="category">
                            <h3>Category</h3>
                            <p class="read-only">Musical</p>
                            <input type="text" name="category" class="edit-mode" value="Musical" style="display: none;">
                        </div>

                        <div class="price">
                            <h3>Price</h3>
                            <p class="read-only">100</p>
                            <input type="number" name="price" class="edit-mode" value="100" style="display: none;">
                        </div>

                        <div class="stocks">
                            <h3>Stock</h3>
                            <p class="read-only">129</p>
                            <input type="number" name="stock" class="edit-mode" value="129" style="display: none;">
                        </div>

                        <div class="dateAdded">
                            <h3>Date Added</h3>
                            <p class="read-only">19-19-1999</p>
                            <input type="text" name="dateAdded" class="edit-mode" value="19-19-1999" style="display: none;" disabled>
                        </div>

                        <div class="action">
                            <button type="button" class="remove-button">Remove Item</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>




        <!-- MODAL FOR ADDING NEW GEAR -->
        <div id="gearModal" class="modal">
            <div class="modal-content">
                <div class="add">
                    <span class="close close-gear">&times;</span>
                    <h2>Add Gear</h2>
                </div>
                <div class="content">
                    <form action="<?= base_url('/admin/gears/addGear') ?>" method="post" enctype="multipart/form-data">
                        <div class="gearname">
                            <label for="gearname">Gear name</label>
                            <input type="text" name="gearname" id="gearname" placeholder="Enter Gear Name"  required>
                        </div>

                        <div class="description">
                            <label for="description">Description</label>
                            <input type="text" name="description" id="description" placeholder="Enter Gear Description" required>
                        </div>

                        <div class="price">
                            <label for="price">Base Price</label>
                            <input type="number" id="price" name="price" placeholder="Enter Gear price" required>
                        </div>

                        <div class="stock">
                            <label for="stock">Stock</label>
                            <input type="number" id="stock" name="stock" placeholder="Enter Gear stock" required>
                        </div>

                        <div class="category">
                            <label for="category">Gear Category</label>
                            <select name="category" id="category" required>
                                <option value="" selected disabled style="background: #999; color: black;">Select Category</option>
                                <?php if(!empty($categories)) :?>
                                    <?php foreach($categories as $category) : ?>
                                    <option value="<?= esc($category['category_id']); ?>"><?= esc($category['category']); ?></option>
                                    <?php endforeach;?>
                                <?php else :?>
                                    <option value="" title="will set to null if there is no category">No categories available</option>
                                <?php endif;?>
                            </select>
                        </div>

                        <div class="img">
                            <label for="img">Gear Image</label>
                            <input type="file" id="img" name="img" placeholder="Select Img" required>
                        </div>

                        <button type="submit">Add</button>
                        <button type="reset">Reset</button>
                    </form>
                </div>
            </div>
        </div>




        <!-- MODAL FOR ADDING NEW GEAR CATEGORY -->
        <div id="categoriesModal" class="modal">
            <div class="modal-content">
                <div class="add">
                    <span class="close close-categories">&times;</span>
                    <h2>Add Gear</h2>
                </div>

                <div class="content">
                    <form action="<?= base_url('/admin/gears/addCat') ?>" method="post">
                        <div class="gearCategory">
                            <label for="category">Category</label>
                            <input type="text" name="category" id="category" placeholder="Category">
                            <!-- ERROR MESSAGE -->
                            <?php if(session()->getFlashdata('catError')) :?>
                                <span style="color:darkred;"><?= esc(session()->get('catError')) ?></span>
                            <?php endif;?>
                        </div>

                        <button type="submit">Add</button>
                        <button type="reset">Reset</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>

<script src="<?= base_url('Admin/js/management.js') ?>"></script>
</body>
</html>