<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<title>Forms - Ready Bootstrap Dashboard</title>
	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
	<link rel="stylesheet" href="assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">
	<link rel="stylesheet" href="assets/css/ready.css">
	<link rel="stylesheet" href="assets/css/demo.css">
</head>
<body>
	<div class="wrapper">
		<?php require_once 'nav.php';
        $roomId = $_GET['roomid'] ?? null;
        $roomdata= rooms::find_by_id($roomId);?>
			<div class="main-panel">
				<div class="content">
					<div class="container-fluid">
						<h4 class="page-title">Forms</h4>
						<div class="row">
							<div class="col-md-10">
								<div class="card">
									<div class="card-header">
										<div class="card-title"> <?php echo 'Edit'.' '.$roomdata->title.' '. 'Room' ?></div>
									</div>
									<div class="card-body">
										<div class="form-group">
											<label for="Room Title">Room Title</label>
											<input type="text" class="form-control" id="title" name="title" placeholder="Enter your room title" value="<?php echo !empty($roomdata->title) ? $roomdata->title : ""; ?>">
										</div>
                                        <div class="form-group">
											<label for="No of Rooms">No of Rooms</label>
											<input type="text" class="form-control" id="room_qnty" name="room_qnty" placeholder="Enter total no of rooms" value="<?php echo !empty($roomdata->room_qnty) ? $roomdata->room_qnty : ""; ?>">
										</div>
                                        <div class="form-group">
											<label for="No of Rooms">Bed type</label>
											<input type="text" class="form-control" id="bed_type" name="bed_type" placeholder="Enter your bed type" value="<?php echo !empty($roomdata->bed_type) ? $roomdata->bed_type : ""; ?>">
										</div>
                                         <div class="form-group">
											<label for="Currency">Currency</label>
											<input type="text" class="form-control" id="currency" name="currency" placeholder="Enter your currency" value="<?php echo !empty($roomdata->currency) ? $roomdata->currency : ""; ?>">
										</div>
                                        <div class="form-group">
											<label for="Room price">Room price</label>
											<input type="text" class="form-control" id="price" name="price" placeholder="Enter your room price" value="<?php echo !empty($roomdata->price) ? $roomdata->price : ""; ?>">
										</div>
                                      
										</div>
										<div class="card-action">
											<button class="btn btn-success">Submit</button>
											<a class="btn btn-danger" href="rooms.php">Cancel</a>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<footer class="footer">
						<div class="container-fluid">
							<nav class="pull-left">
								<ul class="nav">
									<li class="nav-item">
										<a class="nav-link" href="http://www.themekita.com">
											ThemeKita
										</a>
									</li>
									<li class="nav-item">
										<a class="nav-link" href="#">
											Help
										</a>
									</li>
									<li class="nav-item">
										<a class="nav-link" href="#">
											Licenses
										</a>
									</li>
								</ul>
							</nav>
							<div class="copyright ml-auto">
								2018, made with <i class="la la-heart heart text-danger"></i> by <a href="http://www.themekita.com">ThemeKita</a>
							</div>				
						</div>
					</footer>
				</div>
			</div>
		</div>
	</div>
	<!-- Modal -->
	<div class="modal fade" id="modalUpdate" tabindex="-1" role="dialog" aria-labelledby="modalUpdatePro" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-header bg-primary">
					<h6 class="modal-title"><i class="la la-frown-o"></i> Under Development</h6>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body text-center">									
					<p>Currently the pro version of the <b>Ready Dashboard</b> Bootstrap is in progress development</p>
					<p>
					<b>We'll let you know when it's done</b></p>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				</div>
			</div>
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