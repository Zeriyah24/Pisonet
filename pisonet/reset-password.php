<?php
// Include config file
require_once "config.php";

// Initialize the session
session_start();

// Check if the user is already logged in, if yes then redirect them to the welcome page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: admin.php");
    exit;
}

// Check if username parameter exists in the URL
if(isset($_GET["username"])) {
    // Get the username from the URL parameter
    $username = $_GET["username"];

    // Check if reset password form is submitted
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        // Validate new password
        $new_password = trim($_POST["new_password"]);

        // Update password in the database
        $sql = "UPDATE users SET password = ? WHERE username = ?";

        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ss", $param_password, $param_username);

            // Set parameters
            $param_password = password_hash($new_password, PASSWORD_DEFAULT); // Hash the new password
            $param_username = $username;

            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Password updated successfully, redirect user to login page
                header("location: front.php");
                exit;
            } else{
                // Error updating password
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }

        // Close connection
        mysqli_close($link);
    }
} else {
    // Redirect user to the forgot password page if username parameter is not provided
    header("location: forgot-password.php");
    exit;
}
?>
