<?php
require_once '../include/initialize.php';
?>
<!DOCTYPE html>
<html>

<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<title>Rooms - Admin Panel</title>
	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />

	<!-- favicon -->
	<link rel="icon" href="../images/logo.png" type="image/gif" />

	<link rel="stylesheet" href="assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">
	<link rel="stylesheet" href="assets/css/ready.css">
	<link rel="stylesheet" href="assets/css/demo.css">

	<style>
		
		.logo-header {
			margin: 0;
			padding: 0;
			border-bottom: 0 !important;
			background-color: #0f172a;
		}

		.wrapper {
			margin: 0;
			padding: 0;
		}


		nav,
		header,
		.navbar {
			margin: 0;
			padding: 0;
			border: 0;
			background-color: #0f172a;
		}


		* {
			box-shadow: none !important;
			border: none !important;
		}


		body {
			background-color: #f8fafc;
			font-family: 'Nunito', sans-serif;
			color: #1e293b;
		}
		
		.main-panel {
			background-color: #f8fafc;
			margin-left: 250px;
			display: flex;
			flex-direction: column;
			flex: 1;
		}

		.content {
			flex: 1;
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

		.card-header .card-title {
			font-size: 1.25rem;
			font-weight: 700;
			color: #1e293b;
		}

		.btn-success {
			background-color: #10b981;
			border: none;
		}

		.btn-success:hover {
			background-color: #059669;
		}

		.btn-danger {
			background-color: #ef4444;
			border: none;
		}

		.btn-danger:hover {
			background-color: #dc2626;
		}

		.alert-success,
		.alert-danger {
			border-radius: 0.75rem;
			font-weight: 500;
			padding: 1rem 1.5rem;
			box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
			display: flex;
			align-items: center;
			justify-content: space-between;
			position: relative;
			padding-right: 3rem;
		}

		.alert-success {
			background-color: #e0f2fe;
			color: #0369a1;
			border: 1px solid #bae6fd;
		}

		.alert-danger {
			background-color: #fee2e2;
			color: #b91c1c;
			border: 1px solid #fecaca;
		}

		.alert .close span {
			color: #000 !important;
			font-size: 1.25rem;
		}

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
		
		.footer {
			padding: 1rem 2rem;
			background-color: #f8fafc;
			color: #444;
			border-top: 1px solid #e5e7eb;
			text-align: center;
		}
		.badge-count {
		font-size: 0.75rem;
		font-weight: 700;
		padding: 0.25rem 0.6rem;
		border-radius: 1rem;
		min-width: 24px;
		text-align: center;
		display: inline-block;
		background-color: #10b981; /* Tailwind emerald-500 */
		color: white;
		box-shadow: 0 0 5px #10b981aa;
		transition: background-color 0.3s ease, box-shadow 0.3s ease;
	}

	.sidebar .nav-item:hover .badge-count {
		background-color: #059669; /* Darker green on hover */
		box-shadow: 0 0 8px #059669cc;
	}
	</style>
</head>

<body>
	<div class="wrapper">
		<?php require_once 'nav.php'; ?>

		<div class="main-panel">
			<div class="content">
				<div class="container-fluid">
					<h4 class="page-title">Rooms</h4>
					<div class="row">
						<div class="col-md-12">
							<div class="card">
								<div class="card-header d-flex justify-content-between align-items-center">
									<div class="card-title">Room Listing</div>
									<a href="roomedit.php" class="btn btn-success"><i class="la la-plus"></i> Add Room</a>
								</div>
								<div class="card-body">
									<?php if (isset($_GET['deleted'])): ?>
										<div class="alert alert-<?php echo $_GET['deleted'] == 1 ? 'success' : 'danger'; ?> alert-dismissible fade show" role="alert">
											<?php echo $_GET['deleted'] == 1 ? 'Room deleted successfully.' : 'Room could not be deleted.'; ?>
											<button type="button" class="close" data-dismiss="alert" aria-label="Close" style="position: absolute; right: 10px; top: 10px;">
												<span aria-hidden="true">&times;</span>
											</button>
										</div>
									<?php endif; ?>

									<table class="table mt-3 table-striped">
										<thead>
											<tr>
												<th>S. No.</th>
												<th>Room name</th>
												<th>Total rooms</th>
												<th>Beds</th>
												<th>Bed Type</th>
												<th>Currency</th>
												<th>Price</th>
												<th>Action</th>
											</tr>
										</thead>
										<tbody>
											<?php
											$roomdatas = Rooms::find_all();
											if (!empty($roomdatas)) {
												foreach ($roomdatas as $key => $roomdata) {
											?>
													<tr>
														<td><?php echo $key + 1; ?></td>
														<td><?php echo $roomdata->title; ?></td>
														<td><?php echo $roomdata->room_qnty; ?></td>
														<td><?php echo $roomdata->beds; ?></td>
														<td><?php echo $roomdata->bed_type; ?></td>
														<td><?php echo $roomdata->currency; ?></td>
														<td><?php echo $roomdata->price; ?></td>
														<td>
															<a href="roomedit.php?roomid=<?php echo $roomdata->id; ?>" class="btn btn-success btn-sm"><i class="la la-edit"></i></a>
															<button class="btn btn-danger btn-sm" onclick="confirmDelete(<?php echo $roomdata->id; ?>)"><i class="la la-trash"></i></button>
														</td>
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
			</div>

			<footer class="footer">
				© 2025 All Rights Reserved. Developed by Capstone.in
			</footer>
		</div>
	</div>

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
	<script>
		function confirmDelete(roomId) {
			if (confirm("Are you sure you want to delete this room?")) {
				window.location.href = "roomdelete.php?roomid=" + roomId;
			}
		}
	</script>
</body>

</html>
