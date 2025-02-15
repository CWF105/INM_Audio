<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<!-- Boxicons -->
	<link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
	<!-- My CSS -->
	<link rel="stylesheet" href="<?= base_url('Admin/css/dashboard1.css') ?>">
	<link rel="stylesheet" href="<?= base_url('Admin/css/notifModal.css') ?>">
	<link rel="stylesheet" href="<?= base_url('Admin/css/customer.css') ?>"> <!-- //! TABLE LANG ANG CSS NA KINUKUHA DITO -->
	<?php echo view('AdminSide/includes/notifModal') ?>

	<style>
		.pic { width: 100px; height: 100px; border-radius: 50px; border: 1px solid black;}

	</style>
	<title>User's</title>
</head>
<body>


	<!-- SIDEBAR -->
	<?php echo view('AdminSide/includes/sideNav1') ?>
	<!-- SIDEBAR -->



	<!-- CONTENT -->
	<section id="content">	
		<nav>
			<i class='bx bx-menu' ></i>
			<!-- <a href="#" class="nav-link">Categories</a> -->
			<form action="#">
				<div class="form-input">
					<!-- <input type="search" placeholder="Search..."> -->
					<button type="submit" class="search-btn"><i class='bx bx-submit' disabled></i></button>
				</div>
			</form>
			<label for="switch-mode">Theme</label>
			<input type="checkbox" id="switch-mode" hidden>
			<label for="switch-mode" class="switch-mode"></label>
			<button class="notification open-modal1">
				<i class='bx bxs-bell' ></i>
				<span class="num">8</span>
			</button>
		</nav>
		<!-- MAIN -->
		<main>
            <?php ?>
			<div class="head-title">
				<div class="left">
					<a href="<?= base_url('/admin/customers') ?>">
						<button>Back</button>
					</a>
					<h1>User Info</h1>
					<br><br>
					<img class="pic" src="data:image/jpeg;base64,<?= base64_encode($userInfo['profile_pic']) ?>" alt="">
					<h2><?= $userInfo['username'] ?></h2>
					<p><?= $userInfo['firstname'] . $userInfo['lastname'] ?></p>
					<ul class="breadcrumb">
						<!-- <li>
							<a href="#">Dashboard</a>
						</li>
						<li><i class='bx bx-chevron-right' ></i></li>
						<li>
							<a class="active" href="#">Home</a>
						</li> -->
					</ul>

					<div class="info">
						<p><?= $userInfo['email'] ?></p>
						<p><?= $userInfo['phone_number'] ?></p>
						<p><?= $userInfo['country'] ?></p>
						<p><?= $userInfo['city_municipality'] ?></p>
						<p><?= $userInfo['zipcode'] ?></p>
						<p><?= $userInfo['address'] ?></p>
						<p><?= $userInfo['created_at'] ?></p>
					</div>

					<br><hr><br>
					<div class="table">
						<table>
							<thead>
								<th>Order-Number</th>
								<th>Status</th>
								<th>Item</th>
								<th>Quantity</th>
								<th>Price</th>
								<th>Payment Method</th>
								<th>Order Date</th>
							</thead>
							<tbody>
								<?php if($orders) :?>
									<?php foreach($orders as $order): ?>
										<tr>
											<td><?= $order->order_id ?></td>
											<td><?= $order->order_status ?></td>
											<td><?= $order->product_name ?></td>
											<td><?= $order->quantity ?></td>
											<td><?= $order->price ?></td>
											<td><?= $order->payment_method ?></td>
											<td><?= $order->created_at ?></td>
										</tr>
									<?php endforeach; ?>
								<?php else :?>
									<tr>
										<td colspan="7">No orders yet</td>
									</tr>
								<?php endif;?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
            <?php ?>
        </main>
    </section>

	<script src="<?= base_url('Admin/js/notifModal.js') ?>"></script>
	<script src="<?= base_url('Admin/js/dashboard1.js') ?>"></script>
</body>
</html>