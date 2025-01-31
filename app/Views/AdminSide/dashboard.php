<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<!-- Boxicons -->
	<link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
	<!-- My CSS -->
	<link rel="stylesheet" href="<?= base_url('Admin/css/dashboard1.css') ?>">

	<title>AdminHub</title>
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
			<a href="#" class="notification">
				<i class='bx bxs-bell' ></i>
				<span class="num">8</span>
			</a>
		</nav>

		<!-- MAIN -->
		<main>
			<div class="head-title">
				<div class="left">
					<h1>Dashboard</h1>
					<ul class="breadcrumb">
						<!-- <li>
							<a href="#">Dashboard</a>
						</li>
						<li><i class='bx bx-chevron-right' ></i></li>
						<li>
							<a class="active" href="#">Home</a>
						</li> -->
					</ul>
				</div>
				<a href="#" class="btn-download">
					<i class='bx bxs-cloud-download' ></i>
					<span class="text">Download PDF</span>
				</a>
			</div>

			<ul class="box-info">
				<li>
					<i class='bx bxs-calendar-check' ></i>
					<span class="text">
						<h3><?php echo ($totalOrders) ? $totalOrders->totalOrders : 0;?></h3>
						<p>New Order</p>
					</span>
				</li>
				<li>
					<i class='bx bxs-group' ></i>
					<span class="text">
						<h3><?php echo ($totalPlaced) ? $totalPlaced->totalPlacedOrders : 0;?></h3>
						<p>Total Sold</p>
					</span>
				</li>
				<li>
					<i class='bx bxs-dollar-circle' ></i>
					<span class="text">
						<h3><?php echo ($totalRevenue->totalRevenue > 0) ? "$".$totalRevenue->totalRevenue : "$". 0;?></h3>
						<p>Total Sales</p>
					</span>
				</li>
			</ul>

		<!-- RECENT ORDERS -->
			<div class="table-data">
				<div class="order">
					<div class="head">
						<h3>Recent Orders</h3>
						<!-- <i class='bx bx-search' ></i> -->
					</div>
					<table>
						<thead>
							<tr>
								<th>User</th>
								<th>Gear</th>
								<th>Base Price</th>
								<th>Total Price</th>
								<th>Date Order</th>
								<th>Status</th>
							</tr>
						</thead>
						<tbody>
						<!-- recentOrders -->
							<?php if($recentOrders) :?>
								<?php foreach($recentOrders as $recent) : ?>
									<tr>
										<td>
											<img src="data:image/jpeg;base64,<?= base64_encode($recent->profile_pic) ?>" alt="">
											<p><?= $recent->firstname ." ". $recent->lastname?></p>
										</td>
										<td>
											<img src="<?= $recent->image_url ?>" alt="">
											<p><?= $recent->product_name ?></p>
										</td>
										<td><?= $recent->basePrice ?></td>
										<td><?= $recent->totalPrice ?></td>
										<td><?= $recent->dateOrder ?></td>
										<td>
											<?php if($recent->order_status == "complete") :?>
												<span class="status completed"><?= $recent->order_status ?></span>
											<?php elseif($recent->order_status == "cancelled") : ?>
												<span class="status pending"><?= $recent->order_status ?></span>
											<?php else: ?>
												<span class="status process"><?= $recent->order_status ?></span>
											<?php endif;?>
										</td>
									</tr>
								<?php endforeach; ?>
							<?php else: ?>
								<tr>
									<td colspan="3" style="color: gray;">No recent orders!</td>
								</tr>
							<?php endif; ?>				
						</tbody>
					</table>
				</div>
			</div>
		</main>
		<!-- MAIN -->
	</section>
	<!-- CONTENT -->
	

<script src="<?= base_url('Admin/js/dashboard1.js') ?>"></script>
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
</body>
</html>