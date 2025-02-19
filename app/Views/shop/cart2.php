<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href=" <?= base_url('assets/css/cart.css') ?>">
    <link rel="stylesheet" href=" <?= base_url('assets/css/navbar.css') ?>">
    <link rel="stylesheet" href=" <?= base_url('assets/css/footer.css') ?>">
    <link rel="shortcut icon" href="<?= base_url('assets/img/logo.png') ?>" type="image/x-icon">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <title>Cart</title>
    <script defer src="<?= base_url('assets/js/script.js') ?>"></script>
</head>
<body>
<!-- this includes header.php file on every website that has this code -->
<!-- @PHP CODE -->
<?php echo view("includes/header.php");?>
<!-- @PHP CODE -->

<!-- MAIN CONTENT - USER CART -->
<main>
    <div class="cart">
        <div class="title">
            <h2>Cart</h2>
        </div>

        <form action="" id="cartForm" method="get">
            <div class="items">
                <table>
                    <thead>
                        <tr>
                            <th>...</th>
                            <th>Gear</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Total</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(isset($cart_items) && !empty($cart_items)) : ?>
                            <?php foreach($cart_items as $item) :?>
                                <tr>
                                    <td>
                                        <input type="checkbox" class="itemCheckbox" name="selected_items[]" value="<?php echo $item['cart_item_id']; ?>">
                                    </td>
                                    <td>
                                        <img src="<?= esc($item['image_url']) ?>" alt="">
                                        <p><?= $item['product_name'] ?></p>
                                    </td>
                                    <td>₱<?= esc(number_format($item['price'], 2)) ?></td>
                                    <td><?= esc($item['quantity']) ?></td>
                                    <td>₱<?= esc(number_format($item['price'] * $item['quantity'], 2)) ?></td>
                                    <td>
                                        <a href="<?= base_url('/cart/delete/'. $item['cart_item_id']) ?>">Delete</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="5">
                                    <p style="color: #777; text-align: center; font-size: 24px; background-color: #0001; padding: 150px;">Your cart is empty.</p>
                                    <a href="<?=base_url('/shop')?>" id="empty" class="empty">Buy now</a>
                                </td>
                            </tr>
                        <?php endif;?>    
                    </tbody>
                </table>
                <div class="options">
                    <div class="one">
                        <input type="checkbox" id="selectAll"> &nbsp;
                        <label for="selectAll">Select All</label>
                        &nbsp; &nbsp;
                        <a href="" style="text-decoration: none; color: white;">
                            <button type="submit" id="deleteBtn" style="display: none;">Delete</button>
                        </a>
                    </div>
    
                    <div class="two">
    
                    </div>
                    <div class="total">
                        <p>Total (<?= esc($totalQuantity) ?> item<?= ($totalQuantity !== 1) ? 's' : '' ?>):</p>
                        <p>₱<?= esc(number_format($totalPrice, 2)) ?></p>
                        <?php if(isset($cart_items)) :?>
                            <a href="<?=base_url('/buy')?>">
                                <button type="button" class="total-checkout">Check Out</button>
                            </a>
                        <?php else :?>
                            <a href="<?=base_url('/checkOutFailed')?>">
                                <button type="button" class="total-checkout" title="cannot checkout, cart is empty">Check Out</button>
                            </a>
                        <?php endif;?>
                    </div>
                </div>
            </div>
        </form>
    </div>
</main>


<!-- this includes header.php file on every website that has this code -->
<?php echo view("includes/footer.php");?>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const selectAll = document.getElementById('selectAll');
    const checkboxes = document.querySelectorAll('.itemCheckbox');
    const deleteBtn = document.getElementById('deleteBtn');

    function toggleDeleteButton() {
        const anyChecked = Array.from(checkboxes).some(checkbox => checkbox.checked);
        deleteBtn.style.display = anyChecked ? 'block' : 'none';
    }

    // Select all functionality
    selectAll.addEventListener('click', function() {
        checkboxes.forEach(checkbox => {
            checkbox.checked = this.checked;
        });
        toggleDeleteButton();
    });

    // Individual checkbox functionality
    checkboxes.forEach(checkbox => {
        checkbox.addEventListener('change', toggleDeleteButton);
    });

    // Handle delete button click
    deleteBtn.addEventListener('click', function () {
        let selectedItems = [];
        checkboxes.forEach(checkbox => {
            if (checkbox.checked) {
                selectedItems.push(checkbox.value);
            }
        });

        if (selectedItems.length > 0) {
            if (confirm('Are you sure you want to delete the selected items?')) {
                fetch('<?php echo base_url('cart/deleteItems'); ?>', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({ selected_items: selectedItems })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert('Items deleted successfully!');
                        location.reload();
                    } else {
                        alert('Error deleting items.');
                    }
                })
                .catch(error => console.error('Error:', error));
            }
        }
    });
});
</script>
</body>
</html>