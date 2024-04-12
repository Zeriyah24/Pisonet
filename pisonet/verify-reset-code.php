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

    // Check if reset code form is submitted
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        // Retrieve the reset code entered by the user
        $reset_code_entered = trim($_POST["reset_code"]);

        // Prepare a select statement to retrieve the reset code stored in the database
        $sql = "SELECT reset_code FROM users WHERE username = ?";

        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);

            // Set parameters
            $param_username = $username;

            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Store result
                mysqli_stmt_store_result($stmt);

                // Check if username exists
                if(mysqli_stmt_num_rows($stmt) == 1){
                    // Bind result variables
                    mysqli_stmt_bind_result($stmt, $reset_code_stored);

                    // Fetch the result
                    if(mysqli_stmt_fetch($stmt)){
                        // Check if the reset code entered by the user matches the stored reset code
                        if($reset_code_entered == $reset_code_stored){
                            // Redirect user to a page to reset the password (reset-password.php)
                            header("location: reset-password.php?username=" . $username);
                            exit;
                        } else {
                            // Reset code doesn't match
                            echo "Invalid reset code.";
                        }
                    }
                } else {
                    // Username not found
                    echo "Username not found.";
                }
            } else {
                // Error executing the prepared statement
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
