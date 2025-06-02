<!DOCTYPE html>
<html lang="en">

<?php
include_once("include/initialize.php");
?>

<head>
   <!-- basic -->
   <meta charset="utf-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <!-- mobile metas -->
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <meta name="viewport" content="initial-scale=1, maximum-scale=1">
   <!-- site metas -->
   <title>Our Rooms - Capstone</title>
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
                           <li class="nav-item active">
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
                  <h2>Our Rooms</h2>
               </div>
            </div>
         </div>
      </div>
   </div>
   <!-- our_room -->
   <div class="our_room">
      <div class="container">
         <div class="row">
            <div class="col-md-12">
               <div class="titlepage">
                  <p class="margin_0"> </p>
               </div>
            </div>
         </div>
         <div class="row">
            <?php
            // Fetch room data from the database
            $query = "SELECT * FROM rooms ORDER BY id DESC";
            $rooms = Rooms::find_by_sql($query);
            if ($rooms) {
               foreach ($rooms as $room) {
            ?>
                  <div class="col-md-4 col-sm-6">
                     <div id="serv_hover" class="room">
                        <div class="room_img">
                           <figure><img src="images/rooms/<?= $room->image; ?>" alt="<?= $room->title; ?>" /></figure>
                        </div>
                        <div class="bed_room">
                           <h3><?= $room->title; ?></h3>
                           <p><?= $room->content; ?> </p>
                           <p>No. of beds: <?php echo $room->beds; ?> <?= $room->bed_type ?></p>
                           <p>Price: <?= $room->currency ?> <?= $room->price ?></p>
                           <a class="btn btn-primary mt-2 rounded text-white" href="booknow.php?roomid=<?= $room->id ?>">Book Now</a>
                        </div>
                     </div>
                  </div>
            <?php
               }
            }
            ?>
         </div>
      </div>
   </div>
   <!-- end our_room -->

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
   <!-- sidebar -->
   <script src="js/jquery.mCustomScrollbar.concat.min.js"></script>
   <script src="js/custom.js"></script>
</body>

</html>