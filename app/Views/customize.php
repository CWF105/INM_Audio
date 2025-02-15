<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="<?= base_url('assets/css/customize.css') ?>">
	<title>INM Shop</title>
</head>

<body>
	<!-- Header -->
	<header class="header">
		<?php echo view("includes/header.php"); ?>
	</header>

	<!-- React App Container -->
	<div id="root">
		<div class="App">
			<div class="container">
				<div class="left-container">
					<div class="left-top">Left Top Content</div>
					<div class="left-bottom">Left Bottom Content</div>
				</div>
				<div class="right-container">Right Content</div>
			</div>
		</div>
	</div>

	<!-- Footer -->
	<footer class="footer">
		<?php echo view("includes/footer.php"); ?>
	</footer>

	<!-- Load React App -->
	<script src="<?= base_url('react-app/assets/index-CNfnd6Hr.js') ?>" type="module"></script>
	<link rel="stylesheet" href="<?= base_url('react-app/assets/index-DAPNoOtH.css') ?>">
</body>

</html>