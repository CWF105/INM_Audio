<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Transaction Management</title>
    <link rel="stylesheet" href="<?= base_url('admin/css/products.css') ?>">
    <link rel="stylesheet" href="<?= base_url('admin/css/grid.css') ?>">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        #transactions { 
            background-color: #5fa8d3; 
            color: white;
            border-top-left-radius: 10px;
            border-bottom-left-radius: 10px; 
        }
        .cell { text-align: center; justify-content: center; align-items: center; padding: 3px; border: 1px solid gray;}
        .container-content .table table thead tr th { text-align: center;}
    </style>
</head>
<body>

<!-- Main Content -->
<main class="main-container">
    <!-- Side Navigation -->
    <aside>
        <?php echo view('AdminSide/includes/sideNav'); ?>
    </aside>

    <!-- transaction Content -->
    <section class="container-section item-container">
        <div class="header" id="top">
            <a href="#top"><button style="position:fixed; bottom: 0; right: 30px; padding: 5px; color: black; border: 1px solid black;">^</button></a>
            <h1>Gears Management</h1>
            <!-- notif top right corner -->
            <!-- //TODO when click a modal will pop up, contains notifications -->
            <button class="notif" onclick="" title="notifications">
                <?php if(true) : ?>
                    <img src="<?= base_url('admin/img/app-indicator.svg') ?>" alt="">
                <?php endif;?>
            </button>
        </div>
        
        <div class="container-content">

            <div class="table">
                <table>
                    <thead>
                        <tr>
                            <th>DateTime</th>
                            <th>Transaction ID</th>
                            <th>User ID</th>
                            <th>User ID</th>
                            <th>Payment Method</th>
                            <th>Status</th>
                            <th>Action</th>

                    <?php if(isset($transactions) && !empty($transactions)) :?>
                        <?php foreach($transactions as  $transaction) : ?>
                            <tr>
                                <td id="one" class="cell"><?= esc($transaction['created_at']) ?></td>
                                <td id="two" class="cell"><?= esc($transaction['transaction_id']) ?></td>
                                <td id="three" class="cell"><?= esc($transaction['user_id']) ?></td>
                                <td id="four" class="cell"><?= esc($transaction['ammount']) ?></td>
                                <td id="five" class="cell"><?= esc($transaction['payment_method']) ?></td>
                                <td id="six" class="cell"><?= esc($transaction['status']) ?></td>
                                <td id="eight" class="cell">
                                    <!-- edit status -->
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editModal"
                                        data-transaction-id="<?= esc($transaction['transaction_id']) ?>"
                                        data-status="<?= esc($transaction['status']) ?>">
                                        Edit
                                    </button>
                                    <!-- view transaction - (orders/shipping status) -->
                                    <a href="<?= base_url('/admin/transaction/view/'. $transaction['user_id']) ?>">
                                        <button type="button" class="btn btn-secondary">View</button>
                                    </a>
                                    <!-- remove transation -->
                                    <a href="<?= base_url('/admin/transaction/removeTransaction/' . $transaction['transaction_id']) ?>">
                                        <button onclick="return confirm('Are you sure you want to delete this Transaction?')" class="btn btn-danger">Remove</button>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        <?php else :?>
                            <tr>
                                <td colspan="8" id="zero">No Transactions</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</main>


<!-- MODALS -->
<!-- Edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit Transaction Status</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="statusForm" method="post" action="<?= base_url('/admin/transaction/updateStatus') ?>">
                <div class="modal-body">
                    <input type="hidden" name="transaction_id" id="transaction_id">
                    <div class="mb-3">
                        <label for="status" class="form-label">Status</label>
                        <select class="form-select" name="status" id="status">
                            <option value="pending">Pending</option>
                            <option value="complete">Complete</option>
                            <option value="unsuccessful">Unsuccessful</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- SCRIPTS -->
<script src="<?= base_url('admin/js/transaction.js') ?>"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>