<?php
require_once '../include/initialize.php';
?>
<!DOCTYPE html>
<html>

<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<title>Rooms - Admin Panel</title>
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
					<h4 class="page-title">Rooms</h4>
					<div class="row">
						<div class="col-md-12">
							<div class="card">
								<div class="card-header">
									<div class="card-title">Rooom Listing <a href="roomedit.php" class="btn btn-success float-right"><i class="la la-adn"></i></a></div>
								</div>
								<div class="card-body">

									<?php if (isset($_GET['deleted'])): ?>
										<div class="alert alert-<?php echo $_GET['deleted'] == 1 ? 'success' : 'danger'; ?> alert-dismissible fade show" role="alert">
											<?php echo $_GET['deleted'] == 1 ? 'Room deleted successfully.' : 'Room could not be deleted.'; ?>
											<button type="button" class="close" data-dismiss="alert" aria-label="Close" style="right: 10px;">
												<span aria-hidden="true" style="position: absolute; top: 0px; right: 12px; color: black;">&times;</span>
											</button>
										</div>
									<?php endif; ?>


									<table class="table mt-3">
										<thead>
											<tr>
												<th scope="col">S. No.</th>
												<th scope="col">Room name</th>
												<th scope="col">Total rooms</th>
												<th scope="col">Beds</th>
												<th scope="col">Bed Type</th>
												<th scope="col">Currency</th>
												<th scope="col">Price</th>
												<th scope="col">Action</th>
											</tr>
										</thead>
										<tbody>
											<?php
											$roomdatas = Rooms::find_all();

											if (!empty($roomdatas)) {
												foreach ($roomdatas as $key => $roomdata) {
													// $roomdata= Rooms::find_by_id($roomdata->room_id);
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
															<a href="roomedit.php?roomid=<?php echo $roomdata->id; ?>" class="btn btn-success"><i class="la la-edit"></i></a>
															<button class="btn btn-danger" onclick="confirmDelete(<?php echo $roomdata->id; ?>)"><i class="la la-trash"></i></button>
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
<script>
	function confirmDelete(roomId) {
		if (confirm("Are you sure you want to delete this room?")) {
			window.location.href = "roomdelete.php?roomid=" + roomId;
		}
	}
</script>

</html>