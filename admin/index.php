<?php
require_once '../include/initialize.php';

// Optional: Get admin user name from session if available
$admin_name = $_SESSION['loginUser'] ?? 'Admin';
?>
<!DOCTYPE html>
<html>

<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<title>Dashboard - Admin Panel</title>
	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />

	<!-- fevicon -->
	<link rel="icon" href="../images/logo.png" type="image/gif" />

	<link rel="stylesheet" href="assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,300,400,600,700,800,900">
	<link rel="stylesheet" href="assets/css/ready.css">
	<link rel="stylesheet" href="assets/css/demo.css">
</head>

<body>
	<div class="wrapper">
		<?php require_once('nav.php'); ?>

		<div class="main-panel">
			<div class="content">
				<div class="container-fluid">
					<h4 class="page-title">Dashboard</h4>

					<!-- Welcome card -->
					<div class="alert alert-success alert-dismissible fade show" role="alert">
						<strong>Welcome back, <?= $admin_name ?>!</strong> Here's a quick overview of your hotel system.
						<button type="button" class="close" data-dismiss="alert" aria-label="Close" style="right: 10px;"	>
							<span aria-hidden="true" style="position: absolute; top: 0px; right: 12px; color: black;">&times;</span>
						</button>
					</div>

					<!-- Stats cards -->
					<div class="row">
						<div class="col-md-3">
							<div class="card card-stats card-success">
								<div class="card-body">
									<div class="row">
										<div class="col-5">
											<div class="icon-big text-center">
												<i class="la la-bar-chart"></i>
											</div>
										</div>
										<div class="col-7 d-flex align-items-center">
											<div class="numbers">
												<p class="card-category">Bookings</p>
												<?php
												$bookingdatas = bookings::find_all();
												$countbooking = count($bookingdatas);
												?>
												<h4 class="card-title"><?= $countbooking ?></h4>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>

						<div class="col-md-3">
							<div class="card card-stats card-primary">
								<div class="card-body">
									<div class="row">
										<div class="col-5">
											<div class="icon-big text-center">
												<i class="la la-bed"></i>
											</div>
										</div>
										<div class="col-7 d-flex align-items-center">
											<div class="numbers">
												<p class="card-category">Rooms</p>
												<?php
												$roomsdatas = Rooms::find_all();
												$countroom = count($roomsdatas);
												?>
												<h4 class="card-title"><?= $countroom ?></h4>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>

					</div>

				</div> <!-- /.container-fluid -->
			</div> <!-- /.content -->

			<footer class="footer">
				<div class="container-fluid">
					<div class="copyright ml-auto">
						© 2025 All Rights Reserved. Developed by Capstone.in
					</div>
				</div>
			</footer>
		</div> <!-- /.main-panel -->
	</div> <!-- /.wrapper -->

	<!-- Scripts -->
	<script src="assets/js/core/jquery.3.2.1.min.js"></script>
	<script src="assets/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js"></script>
	<script src="assets/js/core/popper.min.js"></script>
	<script src="assets/js/core/bootstrap.min.js"></script>
	<script src="assets/js/plugin/chartist/chartist.min.js"></script>
	<script src="assets/js/plugin/chartist/plugin/chartist-plugin-tooltip.min.js"></script>
	<script src="assets/js/plugin/bootstrap-notify/bootstrap-notify.min.js"></script>
	<script src="assets/js/plugin/bootstrap-toggle/bootstrap-toggle.min.js"></script>
	<script src="assets/js/plugin/jquery-mapael/jquery.mapael.min.js"></script>
	<script src="assets/js/plugin/jquery-mapael/maps/world_countries.min.js"></script>
	<script src="assets/js/plugin/chart-circle/circles.min.js"></script>
	<script src="assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>
	<script src="assets/js/ready.min.js"></script>
	<script src="assets/js/demo.js"></script>

</body>
</html>
