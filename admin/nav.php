<?php
require_once '../include/initialize.php';
confirm_logged_in();
?>
<div class="main-header">
	<div class="logo-header">
		<a href="index.php" class="logo">Admin Panel</a>
		<button class="navbar-toggler sidenav-toggler ml-auto" type="button" data-toggle="collapse" data-target="collapse" aria-controls="sidebar" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<button class="topbar-toggler more"><i class="la la-ellipsis-v"></i></button>
	</div>

	<nav class="navbar navbar-header navbar-expand-lg">
		<div class="container-fluid">
			<ul class="navbar-nav topbar-nav ml-md-auto align-items-center">
				<li class="nav-item dropdown">
					<a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="#" aria-expanded="false"><span>Hizrian</span></a>
					<ul class="dropdown-menu dropdown-user">
						<a class="dropdown-item" href="#"><i class="ti-user"></i> My Profile</a>
						<div class="dropdown-divider"></div>
						<a class="dropdown-item" href="logout.php"><i class="fa fa-power-off"></i> Logout</a>
					</ul>
					<!-- /.dropdown-user -->
				</li>
			</ul>
		</div>
	</nav>
</div>

<div class="sidebar">
	<div class="scrollbar-inner sidebar-wrapper">
		<ul class="nav">
			<li class="nav-item active">
				<a href="index.php">
					<i class="la la-dashboard"></i>
					<p>Dashboard</p>
				</a>
			</li>
			<li class="nav-item">
				<a href="booking.php">
					<i class="la la-table"></i>
					<p>Booking</p>
					<?php
					$bookingdatas 	= bookings::find_all();
					$countbooking 	= count($bookingdatas, 0);
					?>
					<span class="badge badge-count"><?php echo  $countbooking; ?></span>
				</a>
			</li>
			<li class="nav-item">
				<a href="rooms.php">
					<i class="la la-table"></i>
					<p>Rooms</p>
					<?php
					$roomsdatas 	= Rooms::find_all();
					$countroom 		= count($roomsdatas, 0);
					?>
					<span class="badge badge-count"><?php echo  $countroom; ?></span>
				</a>
			</li>
		</ul>
	</div>
</div>