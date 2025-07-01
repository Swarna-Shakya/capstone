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
				<div class="container-fluid">
					<div class="copyright ml-auto">
						© 2025 All Rights Reserved. Developed by Capstone.in
					</div>
				</div>
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