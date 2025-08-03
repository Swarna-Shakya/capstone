<?php
// Add these lines at the very top of the file
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include_once("include/initialize.php");
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
                           <li class="nav-item active">
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
                           <li class="nav-item">
                              <a class="nav-link" href="admin" target="_blank">Admin</a>
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
   <!-- banner -->
   <section class="banner_main">
      <div id="myCarousel" class="carousel slide banner" data-ride="carousel">
         <ol class="carousel-indicators">
            <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
            <li data-target="#myCarousel" data-slide-to="1"></li>
            <li data-target="#myCarousel" data-slide-to="2"></li>
         </ol>
         <div class="carousel-inner">
            <div class="carousel-item active">
               <img class="first-slide" src="images/banner1.jpg" alt="First slide">
               <div class="container">
               </div>
            </div>
            <div class="carousel-item">
               <img class="second-slide" src="images/banner2.jpg" alt="Second slide">
            </div>
            <div class="carousel-item">
               <img class="third-slide" src="images/banner3.jpg" alt="Third slide">
            </div>
         </div>
         <a class="carousel-control-prev" href="#myCarousel" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
         </a>
         <a class="carousel-control-next" href="#myCarousel" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
         </a>
      </div>
      <div class="booking_ocline">
         <div class="container">
            <div class="row">
               <div class="col-md-5">
                  <div class="book_room">
                     <h1>Book a Room Online</h1>
                     <form class="book_now" action="reserve.php" method="post">
                        <div class="row">
                           <div class="col-md-12">
                              <span>Arrival Date</span>
                              <img class="date_cua" src="images/date.png">
                              <input class="online_book" placeholder="dd/mm/yyyy" type="text" name="check_in" id="check_in">
                           </div>
                           <div class="col-md-12">
                              <span>Departure Date</span>
                              <img class="date_cua" src="images/date.png">
                              <input class="online_book" placeholder="dd/mm/yyyy" type="text" name="check_out" id="check_out">
                           </div>
                           <div class="col-md-12">
                              <button class="book_btn" type="submit" name="submit">Check Availability</button>
                           </div>
                        </div>
                     </form>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </section>
   <!-- end banner -->
   <!-- about -->
   <div class="about">
      <div class="container-fluid">
         <div class="row">
            <div class="col-md-5">
               <div class="titlepage">
                  <h2>About Us</h2>
                  <p>Welcome to IIMS Hotel, where we create an ideal setting through exceptional hospitality systems combined with modern innovative solutions. Through our superior services we offer personalized accommodation experiences that deliver comfort and memorable visits according to individual preferences.</p>
                  <a class="read_more" href="about.php"> Read More</a>
               </div>
            </div>
            <div class="col-md-7">
               <div class="about_img">
                  <figure><img src="images/about.png" alt="#" /></figure>
               </div>
            </div>
         </div>
      </div>
   </div>
   <!-- end about -->
   <!-- our_room -->
   <div class="our_room">
      <div class="container">
         <div class="row">
            <div class="col-md-12">
               <div class="titlepage">
                  <h2>Our Rooms</h2>
                  <p class="d-none">Lorem Ipsum available, but the majority have suffered </p>
               </div>
            </div>
         </div>

         <div class="row">
            <?php
            // Fetch room data from the database
            $query = "SELECT * FROM rooms ORDER BY id DESC LIMIT 6";
            $rooms = Rooms::find_by_sql($query);
            if ($rooms) {
               foreach ($rooms as $room) {
            ?>
                  <div class="col-md-4 col-sm-6">
                     <div id="serv_hover" class="room">
                        <div class="room_img">
                           <figure><img src="images/rooms/<?php echo $room->image; ?>" alt="<?= $room->title; ?>" /></figure>
                        </div>
                        <div class="bed_room">
                           <h3><?php echo $room->title; ?></h3>
                           <p><?php echo $room->content; ?></p>
                           <p>No. of beds: <?php echo $room->beds; ?> <?= $room->bed_type ?></p>
                           <p>Price: <?= $room->currency ?> <?= $room->price ?></p>
                           <a class="btn btn-primary mt-2 rounded text-white" href="booknow.php?roomid=<?= $room->id ?>">Book Now</a>
                        </div>
                     </div>
                  </div>
            <?php
               } // End of foreach loop
            }
            ?>
         </div>
      </div>
   </div>
   <!-- end our_room -->

   <!--  contact -->
   <div class="contact">
      <div class="container">
         <div class="row">
            <div class="col-md-12">
               <div class="titlepage">
                  <h2>Contact Us</h2>
               </div>
            </div>
         </div>
         <div class="row">
            <div class="col-md-6">
               <form id="contactForm" class="main_form">
                  <div class="row">
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
            <div class="col-md-6">
               <div class="map_main">
                  <div class="map-responsive">
                     <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3532.273263773803!2d85.32101877461272!3d27.708847925426838!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x39eb1908ed7fbacd%3A0x49b04b284da7a96f!2sIIMS%20College!5e0!3m2!1sen!2snp!4v1716115873704!5m2!1sen!2snp" width="600" height="400" frameborder="0" style="border:0; width: 100%;" allowfullscreen=""></iframe>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
   <!-- end contact -->
   <!--  footer -->
   <?php include 'include/footer.php'; ?>
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
         }).datepicker("setDate", new Date()); // Set Check-In to today's date

         $("#check_out").datepicker({
            dateFormat: 'yy-mm-dd',
            minDate: 'today' + 1,
         }).datepicker("setDate", new Date());


         $("#contactForm").validate({
            errorClass: "error text-danger",
            rules: {
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
                  url: "send_contact_email.php",
                  type: "POST",
                  dataType: "JSON",
                  data: $(form).serialize(),
                  success: function(response) {
                     $("button#submit").removeAttr("disabled").text('Send');
                     var msg = eval(response);
                     $("#msg").text(msg.message);
                     $("#msg").removeClass("alert alert-danger").addClass("alert alert-success").fadeOut(5e3);
                     form.reset();
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