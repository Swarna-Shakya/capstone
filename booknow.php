<?php
include_once("include/initialize.php");
$roomId = $_GET['roomid'] ?? null;
$roomname = Rooms::find_by_id($roomId)->title ?? 'Room not found';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- basic -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- mobile metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="initial-scale=1, maximum-scale=1">
    <!-- site metas -->
    <title>Capstone</title>
    <meta name="keywords" content="Hotel, booking, AI chatbot">
    <meta name="description" content="Hotel, booking, AI chatbot">
    <meta name="author" content="IIMS">

    <!-- bootstrap css -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/jquery-ui.css">
    <!-- style css -->
    <link rel="stylesheet" href="css/style.css">
    <!-- Responsive-->
    <link rel="stylesheet" href="css/responsive.css">

    <!-- fevicon -->
    <link rel="icon" href="images/logo.png" type="image/gif" />

    <!-- Scrollbar Custom CSS -->
    <link rel="stylesheet" href="css/jquery.mCustomScrollbar.min.css">
    <!-- Tweaks for older IEs-->
    <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css" media="screen">
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
</head>
<!-- body -->

<body class="main-layout">
    <!-- loader  -->
    <div class="loader_bg">
        <div class="loader"><img src="images/loading.gif" alt="#" /></div>
    </div>
    <!-- end loader -->
    <!-- header -->
    <header>
        <!-- header inner -->
        <div class="header">
            <div class="container">
                <div class="row">
                    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col logo_section">
                        <div class="full">
                            <div class="center-desk">
                                <div class="logo">
                                    <a href="index.php"><img src="images/logo.png" alt="#" /></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-9 col-lg-9 col-md-9 col-sm-9">
                        <nav class="navigation navbar navbar-expand-md navbar-dark ">
                            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample04" aria-controls="navbarsExample04" aria-expanded="false" aria-label="Toggle navigation">
                                <span class="navbar-toggler-icon"></span>
                            </button>
                            <div class="collapse navbar-collapse" id="navbarsExample04">
                                <ul class="navbar-nav mr-auto">
                                    <li class="nav-item ">
                                        <a class="nav-link" href="index.php">Home</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="about.php">About</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="room.php">Our room</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="contact.php">Contact Us</a>
                                    </li>
                                </ul>
                            </div>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- end header inner -->
    <!-- end header -->
    <div class="back_re">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="title">
                        <h2>Book Now</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--  contact -->
    <div class="contact">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <h2>Book Room: <?php echo $roomname; ?></h2>
                    <form id="bookForm" class="main_form col-md-6 offset-md-3" method="post" action="">
                        <input type="hidden" name="room_id" value="<?php echo $roomId; ?>">
                        <input type="hidden" name="room_title" value="<?php echo $roomname; ?>">
                        <div class="row">
                            <div class="col-md-12 ">
                                <input class="contactus" placeholder="Check In" type="text" name="check_in" id="check_in">
                            </div>
                            <div class="col-md-12 ">
                                <input class="contactus" placeholder="Check Out" type="text" name="check_out" id="check_out">
                            </div>
                            <div class="col-md-12 ">
                                <input class="contactus" placeholder="Name" type="text" name="name">
                            </div>
                            <div class="col-md-12">
                                <input class="contactus" placeholder="Email Address" type="text" name="email">
                            </div>
                            <div class="col-md-12">
                                <input class="contactus" placeholder="Phone Number" type="text" name="phone">
                            </div>
                            <div class="col-md-12">
                                <textarea class="textarea" placeholder="Message" name="message"></textarea>
                            </div>
                            <div class="col-md-12">
                                <button class="send_btn" type="submit" id="submit">Send</button>
                            </div>
                            <div class="col-md-12">
                                <p id="msg" class="mt-3"></p>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- end contact -->
    <!--  footer -->
    <footer>
        <div class="footer">
            <div class="copyright">
                <div class="container">
                    <div class="row">
                        <div class="col-md-10 offset-md-1">

                            <p>
                                © 2025 All Rights Reserved. Developed by <a href="#"> Capstone.in</a>
                            </p>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- end footer -->
    <!-- Javascript files-->
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/jquery-3.0.0.min.js"></script>
    <script src="js/jquery-ui.min.js"></script>
    <script src="js/jquery.validate.js"></script>
    <!-- sidebar -->
    <script src="js/jquery.mCustomScrollbar.concat.min.js"></script>
    <script src="js/custom.js"></script>

    <script>
        $(document).ready(function() {
            $("#check_in").datepicker({
                dateFormat: 'yy-mm-dd',
                minDate: 0, // 0 days from today
                onSelect: function(selectedDate) {
                    // Convert the selected date string to a Date object
                    var selected = new Date(selectedDate);

                    // Ensure it's a valid date
                    if (!isNaN(selected)) {
                        // Add one day for the Check-Out date
                        selected.setDate(selected.getDate() + 1);

                        // Set the Check-Out Datepicker's minDate and date
                        $("#check_out").datepicker("option", "minDate", selected);
                        $("#check_out").datepicker("setDate", selected);
                    }
                }
            }); // Set Check-In to today's date

            $("#check_out").datepicker({
                dateFormat: 'yy-mm-dd',
                minDate: 'today' + 1,
            });

            $("#bookForm").validate({
                errorClass: "error text-danger",
                rules: {
                    check_in: "required",
                    check_out: "required",
                    name: "required",
                    email: {
                        required: true,
                        email: true
                    },
                    phone: {
                        required: true,
                        minlength: 10
                    },
                    message: "required"
                },
                messages: {
                    check_in: "Please select your check-in date!",
                    check_out: "Please select your check-out date!",
                    name: "Please enter your full name!",
                    email: "Please enter your email address!",
                    phone: {
                        required: "Please enter your phone number!",
                        minlength: "Your phone number must be at least 10 digits long!"
                    },
                    message: "Please enter a message!"
                },
                submitHandler: function(form) {
                    $("button#submit").attr("disabled", "true").text('Processing...');
                    $.ajax({
                        url: "send_booking_email.php",
                        type: "POST",
                        dataType: "JSON",
                        data: $(form).serialize(),
                        success: function(response) {
                            $("button#submit").removeAttr("disabled").text('Send');
                            var msg = eval(response);
                            $("#msg").text(msg.message);
                            $("#msg").removeClass("alert alert-danger").addClass("alert alert-success").fadeOut(5e3);
                            form.reset();
                            setInterval(function() {
                                window.location.href = "index.php";
                            }, 5000);
                        },
                        error: function() {
                            $("button#submit").removeAttr("disabled").text('Send');
                            $("#msg").text("An error occurred. Please try again.");
                            $("#msg").removeClass("alert alert-success").addClass("alert alert-danger").fadeOut(5e3);
                        }
                    });
                }
            });
        });
    </script>
</body>

</html>