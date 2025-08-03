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
                           <li class="nav-item active">
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
   <div class="back_re">
      <div class="container">
         <div class="row">
            <div class="col-md-12">
               <div class="title">
                  <h2>Contact Us</h2>
               </div>
            </div>
         </div>
      </div>
   </div>
   <!--  contact -->
   <div class="contact">
      <div class="container">
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
   <script src="js/jquery.validate.js"></script>
   <!-- sidebar -->
   <script src="js/jquery.mCustomScrollbar.concat.min.js"></script>
   <script src="js/custom.js"></script>

   <script>
      $(document).ready(function() {
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