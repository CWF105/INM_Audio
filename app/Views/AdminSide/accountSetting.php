<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Account Settings</title>
    <link rel="stylesheet" href="<?= base_url('admin/css/dashboard.css') ?>">
    <link rel="stylesheet" href="<?= base_url('admin/css/grid.css') ?>">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        #settings { 
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
        <h1>Settings</h1>
    </section>
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>