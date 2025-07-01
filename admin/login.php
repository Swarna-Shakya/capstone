<?php
require_once '../include/initialize.php';
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>Login Page - Admin Panel</title>
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
        <div class="main-header">
            <div class="logo-header">
                <a href="index.html" class="logo">
                    Admin Panel
                </a>
                <button class="navbar-toggler sidenav-toggler ml-auto" type="button" data-toggle="collapse" data-target="collapse" aria-controls="sidebar" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <button class="topbar-toggler more"><i class="la la-ellipsis-v"></i></button>
            </div>
        </div>

        <div class="main-panel" style="width: 100%;">
            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-6 ml-auto mr-auto">
                            <div class="card">
                                <form id="loginform">
                                    <div class="card-header">
                                        <div class="card-title">Log In</div>
                                    </div>
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="email">Email Address</label>
                                            <input type="text" class="form-control" id="email" placeholder="Enter Email" name="email">
                                        </div>
                                        <div class="form-group">
                                            <label for="password">Password</label>
                                            <input type="password" class="form-control" id="password" placeholder="Password" name="password">
                                        </div>

                                    </div>
                                    <div class="card-action">
                                        <button class="btn btn-success" id="login">Submit</button>
                                    </div>
                                    <div id="msg" class="mt-3"></div>
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
<script src="assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>
<script src="assets/js/ready.min.js"></script>
<script src="assets/js/jquery.validate.js"></script>


<script>
    $(document).ready(function() {

        $("#loginform").validate({
            errorClass: "error text-danger",
            errorElement: "span",
            focusInvalid: false,
            rules: {
                email: {
                    required: true,
                    email: true
                },
                password: {
                    required: true,
                    minlength: 2
                }
            },
            messages: {
                email: {
                    required: "Please enter your email address!"
                },
                password: {
                    required: "Please enter your password!",
                    minlength: "Your phone number must be at least 3 digits long!"
                }
            },
            submitHandler: function(form) {
                $("button#login").attr("disabled", true).text('Processing...');
                var action = "action=checkLogin&";
                var data = $('#loginform').serialize();
                queryString = action + data;
                $.ajax({
                    url: "ajax/user.php",
                    type: "POST",
                    dataType: "json",
                    data: queryString,
                    success: function(response) {
                        $("button#login").removeAttr("disabled").text('Send');
                        if (response.action === "success") {
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
                        $("button#login").removeAttr("disabled").text('Send');
                        $("#msg").html('<div class="alert alert-danger">An error occurred. Please try again.</div>');
                        console.error(error);
                    }
                });
            }
        });

    });
</script>

</html>