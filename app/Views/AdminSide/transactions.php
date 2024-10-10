<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Transactions</title>
    <link rel="stylesheet" href="<?= base_url('admin/css/transaction.css') ?>">
    <link rel="stylesheet" href="<?= base_url('admin/css/grid.css') ?>">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        #transactions { 
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
        <div class="header" id="top">
            <a href="#top"><button style="position:fixed; bottom: 0; right: 30px; padding: 5px; color: black; border: 1px solid black;">^</button></a>
            <h1>Transactions</h1>
            <div class="buttons">
            </div>
        </div>    

        <div class="container-content">
            <div class="table">
                <table>
                    <thead>
                        <tr>
                            <th>DateTime</th>
                            <th>Transaction ID</th>
                            <th>User ID</th>
                            <th>Ammount</th>
                            <th>Payment Method</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php if(isset($transactions) && !empty($transactions)) :?>
                        <?php foreach($transactions as  $transaction) : ?>
                            <tr title="Gear added at <?= esc($transaction['created_at']) ?>">
                                <td id="one"><?= esc($transaction['created_at']) ?></td>
                                <td id="two"><?= esc($transaction['transaction_id']) ?></td>
                                <td id="three"><?= esc($transaction['user_id']) ?></td>
                                <td id="four"><?= esc($transaction['ammount']) ?></td>
                                <td id="five"><?= esc($transaction['payment_method']) ?></td>
                                <td id="six"><?= esc($transaction['status']) ?></td>
                                <td id="eight">
                                    <a href="<?= base_url('') ?>"><button class="btn btn-primary">Edit</button></a>
                                    <a href="<?= base_url('/admin/transaction/removeTransaction/'. $transaction['transaction_id']) ?>">
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

<!-- scripts -->
<script>
     <?php if(session()->getFlashdata('removeSuccess')): ?>
        var myModal = new bootstrap.Modal(document.getElementById('myModal'));
        myModal.show();
    <?php endif; ?>
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>