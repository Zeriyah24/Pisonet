<?php
// Include config file
require_once "config.php";

// Attempt to connect to MySQL database
$mysqli = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

// Check connection
if($mysqli === false){
    die("ERROR: Could not connect. " . $mysqli->connect_error);
}
// Check if username is provided
if(isset($_GET["username"])){
    $username = $_GET["username"];

    // Generate reset code
    $reset_code = bin2hex(random_bytes(16));

    // Store reset code in the database
    $sql = "INSERT INTO reset_codes (username, reset_code) VALUES (?, ?)";
    if($stmt = $mysqli->prepare($sql)){
        // Bind variables to the prepared statement as parameters
        $stmt->bind_param("ss", $param_username, $param_reset_code);

        // Set parameters
        $param_username = $username;
        $param_reset_code = $reset_code;

        // Attempt to execute the prepared statement
        if($stmt->execute()){
            // Send reset code to the user's email
            // For demonstration, let's assume the email sending is successful and redirect the user
            header("location: enter-reset-code.php?username=" . $username);
            exit();
        } else{
            echo "Oops! Something went wrong. Please try again later.";
        }

        // Close statement
        $stmt->close();
    } else {
        echo "Error: " . $mysqli->error;
    }
} else {
    echo "No username provided.";
}

// Close connection
$mysqli->close();
?>
