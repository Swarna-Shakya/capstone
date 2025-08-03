<?php
require_once '../include/initialize.php';
?>
<!DOCTYPE html>
<html>

<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<title>Bookings - Admin Panel</title>
	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />

	<!-- fevicon -->
	<link rel="icon" href="../images/logo.png" type="image/gif" />

	<link rel="stylesheet" href="assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">
	<link rel="stylesheet" href="assets/css/ready.css">
	<link rel="stylesheet" href="assets/css/demo.css">
	<style>
		html,
		body {
			height: 100%;
			margin: 0;
			padding: 0;
		}

		body {
			background-color: #f8fafc;
			font-family: 'Nunito', sans-serif;
			color: #1e293b;
		}

		.wrapper {
			display: flex;
			flex-direction: column;
			min-height: 100vh;
		}

		.main-panel {
			margin-left: 250px;
			/* Remove flex properties and min-height */
			background-color: #f8fafc;
			/* Let it be a normal block container */
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
			/* Indigo 200 */
			color: #1e3a8a;
			/* Indigo 900 */
			border: 1px solid #a5b4fc;
		}

		.card-stats.card-primary {
			background-color: #bfdbfe;
			/* Blue 200 */
			color: #1e40af;
			/* Blue 900 */
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
			/* light blue */
			color: #0369a1;
			/* strong blue */
			border: 1px solid #bae6fd;
			font-weight: 500;
			border-radius: 0.75rem;
			padding: 1rem 1.5rem;
			position: relative;
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

		/* Sidebar styles */
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
			margin-bottom: 20px;
		}

		.page-header img {
			border-radius: 6px;
			object-fit: contain;
		}

		.logo-header {
			border-bottom: none !important;
			margin: 0;
			padding: 0 20px;
			background-color: #0f172a;
		}

		.badge-count {
			font-size: 0.75rem;
			font-weight: 700;
			padding: 0.25rem 0.6rem;
			border-radius: 1rem;
			min-width: 24px;
			text-align: center;
			display: inline-block;
		}

		.badge-success {
			background-color: #10b981;
			/* Tailwind emerald-500 */
			color: white;
			box-shadow: 0 0 5px #10b981aa;
		}

		.nav-item:hover .badge-count {
			background-color: #059669;
			box-shadow: 0 0 8px #059669cc;
			transition: background-color 0.3s ease, box-shadow 0.3s ease;
		}

		.main-header {
			border: none;
		}

		.footer {
			padding: 1rem 2rem;
			background-color: #f8fafc;
			color: #444444ff;
			border-top: 1px solid #e5e7eb;
			text-align: center;
			/* Just a normal footer - no special positioning */
		}
	</style>

</head>

<body>
	<div class="wrapper">
		<?php require_once 'nav.php'; ?>

		<div class="main-panel">
			<div class="content">
				<div class="container-fluid">
					<h4 class="page-title">Bookings List</h4>
					<div class="row">
						<div class="card col-md-12">
							<div class="card-body table-responsive">
								<table class="table table-striped mt-3">
									<thead>
										<tr>
											<th scope="col">S. No.</th>
											<th scope="col">Guest name</th>
											<th scope="col">Room type</th>
											<th scope="col">Checkin date</th>
											<th scope="col">Checkout date</th>
											<th scope="col">Book date</th>
											<th scope="col">Phone No.</th>
											<th scope="col">Email Address</th>
											<th scope="col">Message</th>
										</tr>
									</thead>
									<tbody>
										<?php
										$bookingdatas = Bookings::find_all();
										if (!empty($bookingdatas)) {
											foreach ($bookingdatas as $key => $bookingdata) {
												$roomdata = Rooms::find_by_id($bookingdata->room_id);
										?>
												<tr>
													<td><?php echo $key + 1; ?></td>
													<td><?php echo $bookingdata->name; ?></td>
													<td><?php echo $roomdata->title; ?></td>
													<td><?php echo $bookingdata->check_in; ?></td>
													<td><?php echo $bookingdata->check_out; ?></td>
													<td><?php echo date('Y-m-d', strtotime($bookingdata->created_at)); ?></td>
													<td><?php echo $bookingdata->phone; ?></td>
													<td><?php echo $bookingdata->email; ?></td>
													<td><?php echo $bookingdata->message; ?></td>
												</tr>
										<?php
											}
										}
										?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
			<footer class="footer">
				© 2025 All Rights Reserved. Developed by Capstone.in
			</footer>

		</div>

	</div>
</body>

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

</html>