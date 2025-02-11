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
			<a href="#" class="notification">
				<i class='bx bxs-bell' ></i>
				<span class="num">8</span>
			</a>
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
				<table>
					<thead>
						<th>NO.</th>
						<th>Profile</th>
						<th>Customer</th> <!-- image, firstname, lastname -->
						<th>Email</th>
						<th>Phone</th>
						<th>Country</th>
						<th>Joined At</th>
						<th>...</th>
					</thead>
					<tbody>
						<?php if($userAccount): ?>
							<?php 
								$no = 1;
								foreach($userAccount as $user) : 
							?>
								<td><?= $no++; ?></td>
								<td>
									<img src="data:image/jpeg;base64,<?= base64_encode($user['profile_pic']) ?>" alt="Nice">
								</td>
								<td><?= $user['firstname']." ".$user['lastname'] ?></td>
								<td><?= $user['email'] ?></td>
								<td><?= $user['phone_number'] ?></td>
								<td><?= $user['country'] ?></td>
								<td><?= $user['created_at'] ?></td>
								<td class="action">
									<?php if($user['activation'] == "activated") :?>
										<a href="<?= base_url('/admin/deactAccount/'.$user['user_id']) ?>" class="deact">Deactivate User</a>
									<?php else:?>
										<a href="<?= base_url('/admin/deactAccount/'.$user['user_id']) ?>" class="act">Activate User</a>
									<?php endif; ?>
									<a href="<?= base_url('/admin/deleteUserAccount/'.$user['user_id']) ?>" class="delete">Delete Account</a>
								</td>
							<?php endforeach; ?>
						<?php else :?>
							<tr>
								<td colspan="8" style="color: gray;">NO USERS</td>
							</tr>
						<?php endif; ?>
					</tbody>
				</table>
			</div>
        </main>
    </section>

	<script src="<?= base_url('Admin/js/dashboard1.js') ?>"></script>
</body>
</html>