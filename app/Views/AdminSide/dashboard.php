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

	<title>AdminHub</title>
</head>
<body>


<!-- SIDEBAR -->
<?php echo view('AdminSide/includes/notifModal') ?>
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
						<h3><?php echo ($totalPlaced) ? $totalPlaced->totalPlacedOrders : 0;?></h3>
						<p>New Order</p>
					</span>
				</li>
				<li>
					<i class='bx bxs-group' ></i>
					<span class="text">
						<h3><?php echo ($totalOrders) ? $totalOrders->totalOrders : 0;?></h3>
						<p>Orders</p>
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

			<!-- CHART -->
			<div class="table-data chart">
				<div class="orders">
					<h5>Revenue Report</h5>
					<select id="timeframeSelect">
						<option value="yearly">Yearly</option>
						<option value="monthly">Monthly</option>
						<option value="weekly">Weekly</option>
					</select>
					<canvas id="yearlyRevenueChart"></canvas>
				</div>

				<div class="order">
					<h5>Product Trends</h5>
					<canvas id="productTrendsChart"></canvas>
				</div>
			</div>


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
	

<script src="<?= base_url('Admin/js/notifModal.js') ?>"></script>
<script src="<?= base_url('Admin/js/dashboard1.js') ?>"></script>
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
	document.addEventListener("DOMContentLoaded", function() {
		let revenueChart; // Store the chart instance

		function fetchRevenueData(timeframe = 'yearly') {
			fetch(`<?= base_url('/admin/chart-data/revenue') ?>?timeframe=${timeframe}`)
				.then(response => response.json())
				.then(data => {
					const ctx = document.getElementById('yearlyRevenueChart').getContext('2d');

					// Destroy existing chart before creating a new one
					if (revenueChart) {
						revenueChart.destroy();
					}

					revenueChart = new Chart(ctx, {
						type: 'bar',
						data: {
							labels: data.labels,
							datasets: [{
								label: `${timeframe.charAt(0).toUpperCase() + timeframe.slice(1)} Revenue`,
								data: data.values,
								backgroundColor: [
									'rgba(255, 99, 132, 0.7)',
									'rgba(54, 162, 235, 0.7)',
									'rgba(255, 206, 86, 0.7)',
									'rgba(75, 192, 192, 0.7)',
									'rgba(153, 102, 255, 0.7)',
									'rgba(255, 159, 64, 0.7)'
								],
								borderColor: 'rgba(0, 0, 0, 0.2)',
								borderWidth: 1
							}]
						},
						options: {
							responsive: true,
							scales: {
								y: {
									beginAtZero: true
								}
							}
						}
					});
				})
				.catch(error => console.error("Error fetching revenue data:", error));
		}

		// Load yearly revenue by default
		fetchRevenueData();

		// Handle timeframe change
		document.getElementById('timeframeSelect').addEventListener('change', function () {
			fetchRevenueData(this.value);
		});

		// Fetch Product Trends Data
		fetch("<?= base_url('/admin/chart-data/products') ?>")
			.then(response => response.json())
			.then(data => {
				const ctx = document.getElementById('productTrendsChart').getContext('2d');
				new Chart(ctx, {
					type: 'line',
					data: {
						labels: data.labels,
						datasets: [{
							label: 'Product Trends',
							data: data.values,
							backgroundColor: ['rgba(255, 99, 132, 0.2)', 
											'rgba(255, 99, 132, 0.7)',
											'rgba(54, 162, 235, 0.7)',
											'rgba(255, 206, 86, 0.7)',
											'rgba(75, 192, 192, 0.7)',
											'rgba(153, 102, 255, 0.7)',
											'rgba(255, 159, 64, 0.7)'
										],
							borderColor: 'rgba(255, 99, 132, 1)',
							borderWidth: 1
						}]
					},
					options: {
						responsive: true,
						scales: {
							y: {
								beginAtZero: true
							}
						}
					}
				});
			});
	});
</script>
</body>
</html>