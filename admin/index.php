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

	<style>
		body {
			background-color: #f8fafc;
			font-family: 'Nunito', sans-serif;
			color: #1e293b;
		}

		.main-panel {
			background-color: #f8fafc;
		}

		.page-title {
			color: #1e293b;
			font-weight: 700;
		}

		.card {
			background-color: #ffffff;
			border-radius: 1rem;
			box-shadow: 0 2px 6px rgba(0, 0, 0, 0.04);
			border: 1px solid #e5e7eb;
		}

		.card .card-category {
			font-size: 0.75rem;
			font-weight: 600;
			color: #6b7280;
			margin-bottom: 4px;
		}

		.card .card-title {
			font-size: 1.5rem;
			font-weight: 700;
			color: #1e293b;
		}

		.card-stats.card-success {
			background-color: #c7d2fe;
			/* Booking - Indigo 200 */
			color: #1e3a8a;
			/* Indigo 900 text */
			border: 1px solid #a5b4fc;
		}

		.card-stats.card-primary {
			background-color: #bfdbfe;
			/* Rooms - Blue 200 */
			color: #1e40af;
			/* Blue 900 text */
			border: 1px solid #93c5fd;
		}

		.card-stats .icon-big i {
			color: #4338ca;
			/* Bookings icon */
		}

		.card-stats.card-primary .icon-big i {
			color: #2563eb;
			/* Rooms icon */
		}

		.card-stats:hover {
			box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
			transform: translateY(-2px);
			transition: all 0.2s ease-in-out;
		}


		.icon-big i {
			font-size: 2rem;
			color: #3b82f6;
		}

		.alert-success {
			background-color: #e0f2fe;
			/* light blue background */
			color: #0369a1;
			/* strong blue text */
			border: 1px solid #bae6fd;
			/* soft border */
			font-weight: 500;
			border-radius: 0.75rem;
			padding: 1rem 1.5rem;
			position: relative;
			/* needed for absolute positioning of close */
			padding-right: 3rem;
			/* space for close button */
			box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
			display: flex;
			align-items: center;
			justify-content: space-between;
		}

		.alert-success strong {
			color: #0c4a6e;
		}

		.alert .close span {
			color: #0369a1 !important;
			font-size: 1.25rem;
			line-height: 1;
		}

		.alert .close {
			background: transparent;
			border: none;
			outline: none;
		}

		/* Sidebar dark theme (optional if nav.php has sidebar) */
		.sidebar,
		.sidebar-wrapper {
			background-color: #0f172a;
		}

		.sidebar .nav-item a {
			color: #9ca3af;
		}

		.sidebar .nav-item.active a {
			color: #ffffff;
			background-color: #1e293b;
			border-radius: 0.5rem;
		}

		.sidebar .logo {
			color: #ffffff;
		}

		.page-header {
			/* Optional styling */
			margin-bottom: 20px;
		}

		.page-header img {
			border-radius: 6px;
			/* optional rounded corners */
			object-fit: contain;
		}

		html,
		body {
			height: 100%;
			margin: 0;
			padding: 0;
		}

		.logo-header {
			border-bottom: none !important;
			margin: 0;
			padding: 0 20px;
			background-color: #0f172a;
			/* or match your theme */
		}

		.badge-count {
			font-size: 0.75rem;
			/* smaller text */
			font-weight: 700;
			/* bold */
			padding: 0.25rem 0.6rem;
			/* vertical and horizontal padding */
			border-radius: 1rem;
			/* pill shape */
			min-width: 24px;
			text-align: center;
			display: inline-block;
		}

		/* Change green background to a different shade or color */
		.badge-success {
			background-color: #10b981;
			/* Tailwind emerald-500, for example */
			color: white;
			box-shadow: 0 0 5px #10b981aa;
			/* subtle glow */
		}

		/* Optional: add hover effect */
		.nav-item:hover .badge-count {
			background-color: #059669;
			/* slightly darker on hover */
			box-shadow: 0 0 8px #059669cc;
			transition: background-color 0.3s ease, box-shadow 0.3s ease;
		}

		.main-header {
			border: none;
		}


		.wrapper {
			display: flex;
			flex-direction: column;
			min-height: 100vh;
		}

		.main-panel {
			margin-left: 250px;
			/* or the actual width of your sidebar */
			flex: 1;
			display: flex;
			flex-direction: column;
		}

		.footer {
			padding: 1rem 2rem;
			background-color: #f8fafc;
			color: #444444ff;
			border-top: 1px solid #e5e7eb;
		}


		.content {
			flex: 1;
			/* ensures content area takes space and pushes footer down */
		}
	</style>

</head>

<body>
	<div class="wrapper">
		<?php require_once('nav.php'); ?>

		<div class="main-panel">
			<div class="content">
				<div class="container-fluid">
					<div class="page-header d-flex align-items-center">
						<img src="../images/logo.png" alt="Logo" style="height: 40px; margin-right: 12px;">
						<h4 class="page-title m-0">Admin Panel</h4>
					</div>


					<!-- Welcome card -->
					<div class="alert alert-success alert-dismissible fade show" role="alert">
						<strong>Welcome back, <?= $admin_name ?>!</strong> Here's a quick overview of your hotel system.
						<button type="button" class="close" data-dismiss="alert" aria-label="Close" style="right: 10px;">
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