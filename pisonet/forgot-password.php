<?php
// Define variable and initialize with empty value
$username = "";
$username_err = "";

// Include config file
require_once "config.php";

// Initialize the session
session_start();

// Check if the user is already logged in, if yes then redirect them to the welcome page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: admin.php");
    exit;
}

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){

    // Check if username is empty
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter username.";
    } else{
        $username = trim($_POST["username"]);
    }

    // Validate input errors before sending reset code
    if(empty($username_err)){
        // Redirect user to a page to handle sending reset code (send-reset-code.php)
        // You'll implement this logic in send-reset-code.php
        // For now, let's assume it redirects properly
        header("location: send-reset-code.php?username=" . $username);
        exit;
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Forgot Password</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <link rel="stylesheet" href="front.css"> <!-- Include your CSS file -->
    <script>
        function validateForm() {
            var username = document.forms["forgotPasswordForm"]["username"].value;
            if (username == "") {
                alert("Please enter username.");
                return false;
            }
        }
    </script>
</head>
<body>
    <div class="wrapper">
        <h2>Forgot Password</h2>
        <p>Please enter your username. We'll send a password reset code to your email.</p>
        <form name="forgotPasswordForm" action="send-reset-code.php" method="post" onsubmit="return validateForm()">
            <div class="form-group">
                <label>Username</label>
                <input type="text" name="username" class="form-control">
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Send Reset Code">
            </div>
            <p class="register-link"><a href="login.php">Back to Login</a></p>
        </form>
    </div>
</body>
</html>
