<?php
require_once '../include/initialize.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>Login Page - IIMS Hotel Admin</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">

    <!-- favicon -->
    <link rel="icon" href="../images/logo.png" type="image/png" />

    <!-- Fonts and Styles -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:300,400,600,700,800" rel="stylesheet">

    <style>
        body {
            margin: 0;
            padding: 0;
            background-color: #2e3a47;
            font-family: 'Nunito', sans-serif;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        .login-card {
            background-color: #fff;
            padding: 40px 30px;
            border-radius: 10px;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 380px;
            text-align: center;
        }

        .login-card img.logo {
            width: 150px;
            height: auto;
            margin-bottom: 20px;
        }

        .login-card h3 {
            margin-bottom: 30px;
            font-size: 1.30rem;
            font-weight: 700;
            color: #333;
            white-space: nowrap;
        }

        .form-group {
            margin-bottom: 20px;
            text-align: left;
        }

        .form-group label {
            font-weight: 600;
            font-size: 0.95rem;
            color: #333;
        }

        .form-control {
            width: 100%;
            padding: 12px;
            border: 1px solid #ccc;
            border-radius: 6px;
            font-size: 0.95rem;
            transition: border 0.3s;
        }

        .form-control:focus {
            border-color: #0fb59d;
            box-shadow: 0 0 0 2px rgba(15, 181, 157, 0.2);
        }

        .btn-submit {
            background-color: #0e6292ff;
            color: #fff;
            border: #b5c5ceff;
            width: 100%;
            padding: 12px;
            border-radius: 6px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: background-color 0.3s ease-in-out;
        }

        .btn-submit:hover {
            background-color: #2b84b8ff;
        }

        .alert {
            font-size: 0.9rem;
            margin-top: 10px;
        }
    </style>
</head>

<body>
    <div class="login-card">
        <!-- Logo above heading -->
        <img src="../images/logo.png" alt="Logo" class="logo">
        <h3>Welcome to IIMS Hotel Admin!</h3>
        <form id="loginform">
            <div class="form-group">
                <label for="email">Email</label>
                <input type="text" class="form-control" id="email" name="email" placeholder="email@gmail.com">
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="********">
            </div>
            <button type="submit" class="btn-submit" id="login">SUBMIT</button>
            <div id="msg" class="mt-3"></div>
        </form>
    </div>

    <!-- JS Scripts -->
    <script src="assets/js/core/jquery.3.2.1.min.js"></script>
    <script src="assets/js/core/bootstrap.min.js"></script>
    <script src="assets/js/jquery.validate.js"></script>

    <script>
        $(document).ready(function () {
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
                        minlength: "Password must be at least 2 characters long!"
                    }
                },
                submitHandler: function (form) {
                    $("button#login").attr("disabled", true).text('Processing...');
                    var action = "action=checkLogin&";
                    var data = $('#loginform').serialize();
                    var queryString = action + data;
                    $.ajax({
                        url: "ajax/user.php",
                        type: "POST",
                        dataType: "json",
                        data: queryString,
                        success: function (response) {
                            $("button#login").removeAttr("disabled").text('SUBMIT');
                            if (response.action === "success") {
                                $("#msg").html('<div class="alert alert-success">' + response.message + '</div>');
                                form.reset();
                                setTimeout(function () {
                                    window.location.href = "index.php";
                                }, 2000);
                            } else {
                                $("#msg").html('<div class="alert alert-danger">' + response.message + '</div>');
                            }
                        },
                        error: function () {
                            $("button#login").removeAttr("disabled").text('SUBMIT');
                            $("#msg").html('<div class="alert alert-danger">An error occurred. Please try again.</div>');
                        }
                    });
                }
            });
        });
    </script>
</body>

</html>
