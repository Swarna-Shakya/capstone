
<?php 
require_once '../include/initialize.php';
?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<title>Tables - Ready Bootstrap Dashboard</title>
	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
	<link rel="stylesheet" href="assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">
	<link rel="stylesheet" href="assets/css/ready.css">
	<link rel="stylesheet" href="assets/css/demo.css">
</head>
<body>
	<div class="wrapper">
	<?php require_once 'nav.php';?>
<div class="main-panel">
				<div class="content">
					<div class="container-fluid">
						<h4 class="page-title">Tables</h4>
						<div class="row">
								<div class="card">
									<div class="card-header">
										<div class="card-title">Basic Table</div>
									</div>
									<div class="card-body">
										<div class="card-sub">									
											This is the basic table view of the ready dashboard :
										</div>
										<table class="table mt-3">
											<thead>
												<tr>
													<th scope="col">s.no</th>
													<th scope="col">Guest name</th>
													<th scope="col">Room type</th>
													<th scope="col">Checkin date</th>
													<th scope="col">Checkout date</th>
												</tr>
											</thead>
											<tbody>
                                                <?php
                                                $bookingdatas= Bookings::find_all();

                                                if(!empty($bookingdatas)){
                                                    foreach($bookingdatas as $key => $bookingdata){
                                                        $roomdata= Rooms::find_by_id($bookingdata->room_id);
                                                        ?>
                                              
												<tr>
													<td><?php echo $key+1; ?></td>
													<td><?php echo $bookingdata->name; ?></td>
													<td><?php echo $roomdata->title; ?></td>
													<td><?php echo $bookingdata->check_in; ?></td>
													<td><?php echo $bookingdata->check_out; ?></td>
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
									<a class="nav-link" href="https://themewagon.com/license/#free-item">
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
			</div></body>
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
	$('#displayNotif').on('click', function(){
		var placementFrom = $('#notify_placement_from option:selected').val();
		var placementAlign = $('#notify_placement_align option:selected').val();
		var state = $('#notify_state option:selected').val();
		var style = $('#notify_style option:selected').val();
		var content = {};

		content.message = 'Turning standard Bootstrap alerts into "notify" like notifications';
		content.title = 'Bootstrap notify';
		if (style == "withicon") {
			content.icon = 'la la-bell';
		} else {
			content.icon = 'none';
		}
		content.url = 'index.html';
		content.target = '_blank';

		$.notify(content,{
			type: state,
			placement: {
				from: placementFrom,
				align: placementAlign
			},
			time: 1000,
		});
	});
</script>
</html>