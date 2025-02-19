<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<!-- Boxicons -->
	<link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
	<!-- My CSS -->
	<link rel="stylesheet" href="<?= base_url('Admin/css/dashboard1.css') ?>">
	<link rel="stylesheet" href="<?= base_url('Admin/css/customer.css') ?>">
	<link rel="stylesheet" href="<?= base_url('Admin/css/notifModal.css') ?>">


	<title>User</title>
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
					<h1>Users</h1>
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
			</div>


			<div class="table">
				<form action="" method="get">
					<input type="search" name="search" id="search" value="<?= $search ?>">
					<button type="submit">Search</button>
				</form>

				<table>
					<thead>
						<th>ID</th>
						<th>User</th>
						<th>Email</th>
						<th>Joined At</th>
						<th>Actions</th>
					</thead>
					<tbody>
						<?php if($userAccount) :?>
							<?php 
								$no = 1; 
								foreach($userAccount as $index => $user) : 
							?>
								<tr>
									<td><?= $no++ ?></td>
									<td><?= $user['firstname']." ".$user['lastname'] ?></td>
									<td><?= $user['email'] ?></td>
									<td><?= $user['created_at'] ?></td>
									<td class="action">
											<a href="<?= base_url('/admin/view/'.$user['user_id']) ?>" class="view">View</a>
										<?php if($user['activation'] == "activated") :?>
											<a href="<?= base_url('/admin/deactAccount/'.$user['user_id']) ?>" class="deact">Deactivate User</a>
										<?php else:?>
											<a href="<?= base_url('/admin/deactAccount/'.$user['user_id']) ?>" class="act">Activate User</a>
										<?php endif; ?>
											<a href="<?= base_url('/admin/deleteUserAccount/'.$user['user_id']) ?>" class="delete">Delete Account</a>
									</td>
								</tr>				
							<?php endforeach;?>
						<?php else : ?>
							<tr>
								<td colspan="8" style="color: gray;">NO USERS</td>
							</tr>
						<?php endif;?>
					</tbody>
				</table>
			</div>
        </main>
    </section>

	<script src="<?= base_url('Admin/js/notifModal.js') ?>"></script>
	<script src="<?= base_url('Admin/js/dashboard1.js') ?>"></script>
</body>
</html>