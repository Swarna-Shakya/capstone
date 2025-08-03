<?php
require_once '../include/initialize.php';
confirm_logged_in();
?>
<div class="main-header">
	<div class="logo-header d-flex align-items-center pl-2">
		<a href="index.php" class="logo d-flex align-items-center text-white text-decoration-none">
			<img src="" alt="" style="height: 32px; margin-right: 8px;">
			<span style="margin-left: 1px;">IIMS Admin Panel</span>
		</a>

		<button class="navbar-toggler sidenav-toggler ml-auto" type="button" data-toggle="collapse" data-target="collapse" aria-controls="sidebar" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<button class="topbar-toggler more"><i class="la la-ellipsis-v"></i></button>
	</div>

	<nav class="navbar navbar-header navbar-expand-lg">
		<div class="container-fluid">
			<ul class="navbar-nav topbar-nav ml-md-auto align-items-center">
				<li class="nav-item dropdown">
					<a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="#" aria-expanded="false">
						<span><?php echo $_SESSION['loginUser']; ?></span>
					</a>
					<ul class="dropdown-menu dropdown-user">
						<li><a class="dropdown-item" href="logout.php"><i class="fa fa-power-off"></i> Logout</a></li>
					</ul>
				</li>
			</ul>
		</div>
	</nav>
</div>

<?php
// to add active class to the current page
$current_page = basename($_SERVER['PHP_SELF'], ".php");
?>

<div class="sidebar">
	<div class="scrollbar-inner sidebar-wrapper">
		<ul class="nav">
			<li class="nav-item <?php echo ($current_page == 'index') ? 'active' : ''; ?>">
				<a href="index.php">
					<i class="la la-dashboard"></i>
					<p>Dashboard</p>
				</a>
			</li>
			<li class="nav-item <?php echo ($current_page == 'booking') ? 'active' : ''; ?>">
				<a href="booking.php">
					<i class="la la-bar-chart"></i>
					<p>Booking</p>
					<?php
					$bookingdatas 	= bookings::find_all();
					$countbooking 	= count($bookingdatas, 0);
					?>
					<span class="badge badge-count badge-success"><?php echo $countbooking; ?></span>
				</a>
			</li>
			<li class="nav-item <?php echo ($current_page == 'rooms' || $current_page == 'roomedit') ? 'active' : ''; ?>">
				<a href="rooms.php">
					<i class="la la-bed"></i>
					<p>Rooms</p>
					<?php
					$roomsdatas 	= Rooms::find_all();
					$countroom 		= count($roomsdatas, 0);
					?>
					<span class="badge badge-count badge-success"><?php echo $countroom; ?></span>
				</a>
			</li>
		</ul>
	</div>
</div>
<style>
	.logo-header {
		background-color: #0f172a;
		color: #ffffff;
	}

	.logo-header .logo {
		color: #ffffff !important;
	}

	.logo-header img {
		object-fit: contain;
		border-radius: 4px;
	}

	/* Dropdown container */
	.navbar-nav .dropdown-user {
		min-width: 150px;
		background-color: #1e293b;
		/* Dark background */
		border-radius: 0.5rem;
		padding: 0.5rem 0;
		box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
		border: none;
	}

	/* Dropdown links */
	.navbar-nav .dropdown-user .dropdown-item {
		color: #f8fafc;
		/* Light text */
		padding: 0.5rem 1.5rem;
		font-weight: 600;
		display: flex;
		align-items: center;
		transition: background-color 0.2s ease;
	}

	/* Icon inside dropdown item */
	.navbar-nav .dropdown-user .dropdown-item i {
		margin-right: 8px;
		color: #f87171;
		/* A subtle red for logout icon */
	}

	/* Hover effect */
	.navbar-nav .dropdown-user .dropdown-item:hover {
		background-color: #374151;
		/* Slightly lighter dark */
		color: #fbbf24;
		/* Optional: golden highlight on hover */
		cursor: pointer;
	}

	/* Profile pic / username toggle styling */
	.profile-pic {
		color: #1e293b;
		/* Dark text */
		font-weight: 700;
		cursor: pointer;
		padding: 0.5rem 1rem;
		border-radius: 0.375rem;
		transition: background-color 0.2s ease;
	}

	/* Hover on toggle */
	.profile-pic:hover {
		background-color: #e0f2fe;
		/* Light blue highlight */
		color: #0369a1;
	}
</style>