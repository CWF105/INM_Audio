<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="<?= base_url('admin/css/dashboard.css') ?>">
    <link rel="stylesheet" href="<?= base_url('admin/css/grid.css') ?>">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        #dashboard { 
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

    
    <!-- newly logged in modal show -->
    <div class="modal fade" id="myModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <center>
                    <span style="color: green; font-size: 24px; padding: 15px;">
                        Welcome <?= session()->get('username'); ?>
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

    
    
    <!-- Dashboard Content -->
    <section class="container-section item-container ">
        <h1>Dashboard</h1>

        <div class="">

        </div>
    </section>

</main>


<!-- scripts  -->
<script>
     <?php if(session()->getFlashdata('welcome')): ?>
        var myModal = new bootstrap.Modal(document.getElementById('myModal'));
        myModal.show();
    <?php endif; ?>
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>