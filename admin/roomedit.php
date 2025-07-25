<?php
require_once '../include/initialize.php';

$roomId = $_GET['roomid'] ?? '';
$roomdata = null;
$title = 'Add Room';

if (!empty($roomId)) {
	$roomdata = Rooms::find_by_id((int)$roomId);
	$title = 'Edit Room';
}

?>
<!DOCTYPE html>
<html>

<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<title><?php echo $title; ?> - Ready Bootstrap Dashboard</title>
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

					<div class="row justify-content-center">
						<div class="col-md-10 col-lg-8 col-xl-6">
							<div class="card shadow">
								<div class="card-header">
									<div class="card-title m-0"><?php echo $title ?></div>
								</div>
								<form id="addeditform" enctype="multipart/form-data">
									<div class="card-body">
										<div class="form-group">
											<label for="title">Room Title</label>
											<input type="text" class="form-control" id="title" name="title" placeholder="Enter your room title"
												value="<?php echo !empty($roomdata->title) ? $roomdata->title : ""; ?>">
										</div>
										<div class="form-group">
											<label for="room_qnty">No of Rooms</label>
											<input type="text" class="form-control" id="room_qnty" name="room_qnty" placeholder="Enter total no of rooms"
												value="<?php echo !empty($roomdata->room_qnty) ? $roomdata->room_qnty : ""; ?>">
										</div>
										<div class="form-group">
											<label for="beds">No of Beds</label>
											<input type="text" class="form-control" id="beds" name="beds" placeholder="Enter total no of beds"
												value="<?php echo !empty($roomdata->beds) ? $roomdata->beds : ""; ?>">
										</div>
										<div class="form-group">
											<label for="bed_type">Bed type</label>
											<input type="text" class="form-control" id="bed_type" name="bed_type" placeholder="Enter your bed type"
												value="<?php echo !empty($roomdata->bed_type) ? $roomdata->bed_type : ""; ?>">
										</div>
										<div class="form-group">
											<label for="currency">Currency</label>
											<input type="text" class="form-control" id="currency" name="currency" placeholder="Enter your currency"
												value="<?php echo !empty($roomdata->currency) ? $roomdata->currency : ""; ?>">
										</div>
										<div class="form-group">
											<label for="price">Room price</label>
											<input type="text" class="form-control" id="price" name="price" placeholder="Enter your room price"
												value="<?php echo !empty($roomdata->price) ? $roomdata->price : ""; ?>">
										</div>
										<div class="form-group">
											<label for="room_image">Room Image</label>
											<input type="file" class="form-control" id="room_image" name="room_image" accept="image/*">
										</div>
										<?php if (!empty($roomdata->image)) : ?>
											<div class="mb-3">
												<label>Current Image:</label><br>
												<img src="../images/rooms/<?php echo $roomdata->image; ?>" alt="Room Image" style="max-width: 100%; height: auto;">
											</div>
										<?php endif; ?>

										<div class="form-group">
											<label for="content">Content</label>
											<textarea class="form-control" id="content" name="content" rows="5"><?php echo !empty($roomdata->content) ? $roomdata->content : ""; ?></textarea>
										</div>
										<div id="msg" class="my-3"></div>
									</div>
									<div class="card-footer text-right">
										<button class="btn btn-success" type="submit" id="submit">
											<?php echo !empty($roomdata) ? 'Update Room' : 'Add Room'; ?>
										</button>
										<a class="btn btn-secondary" href="rooms.php">Cancel</a>
									</div>
								</form>
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
<script src="assets/js/jquery.validate.js"></script>


<script>
	$("#addeditform").validate({
		errorClass: "error text-danger",
		errorElement: "span",
		focusInvalid: false,
		rules: {

			title: "required",
			room_qnty: "required",
			bed_type: "required",
			currency: "required",
			price: "required",

			content: "required"
		},
		messages: {

			title: "Please enter Room title!",
			room_qnty: "Please enter total no of rooms!",
			bed_type: "Please enter Bed type!",
			currency: "Please enter currency!",
			price: "Please enter price!",
			content: "Please enter room content!"
		},
		submitHandler: function(form) {
			$("button#login").attr("disabled", true).text('Processing...');

			var formData = new FormData(document.getElementById("addeditform"));
			formData.append("action", "<?php echo !empty($roomdata) ? 'update' : 'add'; ?>");
			<?php if (!empty($roomdata)) echo 'formData.append("id", "' . $roomdata->id . '");'; ?>

			$.ajax({
				url: "ajax/room.php",
				type: "POST",
				dataType: "json",
				data: formData,
				contentType: false,
				processData: false,
				success: function(response) {
					$("button#login").removeAttr("disabled").text('Send');
					if (response.action === "success") {
						$("#msg").html('<div class="alert alert-success">' + response.message + '</div>');
						setTimeout(function() {
							window.location.href = "rooms.php";
						}, 3000);
					} else {
						$("#msg").html('<div class="alert alert-danger">' + response.message + '</div>');
					}
				},
				error: function(xhr, status, error) {
					$("button#login").removeAttr("disabled").text('Send');
					$("#msg").html('<div class="alert alert-danger">An error occurred. Please try again.</div>');
					console.error(error);
				}
			});
		}
	});
</script>

</html>