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
                            <div class="col-md-12" id="msg"></div>
                            <div class="col-md-12">
                                <input class="contactus" placeholder="Check In" type="text" name="check_in" id="check_in" autocomplete="off">
                            </div>
                            <div class="col-md-12">
                                <input class="contactus" placeholder="Check Out" type="text" name="check_out" id="check_out" autocomplete="off">
                            </div>
                            <div class="col-md-12">
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
            let availabilityCache = {};

            // Custom validator: check-out must be greater than check-in
            $.validator.addMethod("greaterThan", function(value, element, params) {
                if (!/Invalid|NaN/.test(new Date(value))) {
                    return new Date(value) > new Date($(params).val());
                }
                return false;
            }, 'Check-out date must be after check-in date');

            // Custom validator: check room availability via AJAX
            $.validator.addMethod("checkAvailability", function(value, element) {
                const checkIn = $('#check_in').val();
                const checkOut = $('#check_out').val();
                const roomId = $('input[name="room_id"]').val();

                if (!checkIn || !checkOut || new Date(checkOut) <= new Date(checkIn)) {
                    return false;
                }

                const cacheKey = `${roomId}_${checkIn}_${checkOut}`;

                if (availabilityCache.hasOwnProperty(cacheKey)) {
                    return availabilityCache[cacheKey]; // Return cached result
                }

                let isValid = false;

                $.ajax({
                    url: 'check_availability.php',
                    type: 'POST',
                    data: {
                        check_in: checkIn,
                        check_out: checkOut,
                        room_id: roomId
                    },
                    dataType: 'text',
                    async: false,
                    success: function(response) {
                        isValid = response.trim().toLowerCase().includes("available");
                        availabilityCache[cacheKey] = isValid;

                        if (isValid) {
                            $('#msg').html('<div class="alert alert-success">' + response + '</div>');
                        } else {
                            $('#msg').html('<div class="alert alert-danger">' + response + '</div>');
                        }
                    },
                    error: function() {
                        $('#msg').html('<div class="alert alert-danger">Error checking availability</div>');
                        availabilityCache[cacheKey] = false;
                    }
                });

                return isValid;
            }, "Room is not available for selected dates.");

            // Initialize datepickers
            $("#check_in").datepicker({
                dateFormat: 'yy-mm-dd',
                minDate: 0,
                onSelect: function(selectedDate) {
                    let selected = new Date(selectedDate);
                    if (!isNaN(selected)) {
                        let nextDay = new Date(selected);
                        nextDay.setDate(nextDay.getDate() + 1);
                        let formattedDate = $.datepicker.formatDate('yy-mm-dd', nextDay);

                        $("#check_out").datepicker("option", "minDate", nextDay);
                        $("#check_out").val(formattedDate);

                        availabilityCache = {}; // Clear cache
                        validateBothDates();
                    }
                },
                onChangeMonthYear: function() {
                    availabilityCache = {};
                }
            });

            $("#check_out").datepicker({
                dateFormat: 'yy-mm-dd',
                minDate: 1,
                onSelect: function() {
                    availabilityCache = {};
                    validateBothDates();
                },
                onChangeMonthYear: function() {
                    availabilityCache = {};
                }
            });

            // Validate both date fields
            function validateBothDates() {
                if ($("#check_in").val() && $("#check_out").val()) {
                    $("#bookForm").validate().element("#check_in");
                    $("#bookForm").validate().element("#check_out");
                }
            }

            // Setup form validation
            $("#bookForm").validate({
                errorClass: "error text-danger",
                errorElement: "span",
                focusInvalid: false,
                rules: {
                    check_in: {
                        required: true,
                        checkAvailability: true
                    },
                    check_out: {
                        required: true,
                        greaterThan: "#check_in",
                        checkAvailability: true
                    },
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
                    check_in: {
                        required: "Please select your check-in date!",
                        checkAvailability: "Room is not available for the selected dates."
                    },
                    check_out: {
                        required: "Please select your check-out date!",
                        greaterThan: "Check-out date must be after check-in date",
                        checkAvailability: "Room is not available for the selected dates."
                    },
                    name: "Please enter your full name!",
                    email: {
                        required: "Please enter your email address!",
                        email: "Please enter a valid email address!"
                    },
                    phone: {
                        required: "Please enter your phone number!",
                        minlength: "Your phone number must be at least 10 digits long!"
                    },
                    message: "Please enter a message!"
                },
                submitHandler: function(form) {
                    $("button#submit").attr("disabled", true).text('Processing...');
                    $.ajax({
                        url: "send_booking_email.php",
                        type: "POST",
                        dataType: "json",
                        data: $(form).serialize(),
                        success: function(response) {
                            $("button#submit").removeAttr("disabled").text('Send');
                            if (response.success) {
                                $("#msg").html('<div class="alert alert-success">' + response.message + '</div>');
                                form.reset();
                                setTimeout(function() {
                                    window.location.href = "index.php";
                                }, 3000);
                            } else {
                                $("#msg").html('<div class="alert alert-danger">' + response.message + '</div>');
                            }
                        },
                        error: function(xhr, status, error) {
                            $("button#submit").removeAttr("disabled").text('Send');
                            $("#msg").html('<div class="alert alert-danger">An error occurred. Please try again.</div>');
                            console.error(error);
                        }
                    });
                }
            });

            // Refresh validation on date change
            $("#check_in, #check_out").on('change', function() {
                availabilityCache = {};
                validateBothDates();
            });
        });
    </script>
</body>

</html>