<?php
session_start();
// Replace these database credentials with your actual database details
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sbi";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the user's input from the request
$pin = $_POST['pin'];
$accountNumber = $_SESSION['account_number'];



// Query the database to fetch the account_number based on the user input
$sql = "SELECT pin FROM accounts WHERE account_number = '$accountNumber' AND pin = '$pin'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $_SESSION['pin']  = $pin;
    // Account number and PIN match in the database
    echo "success";
} else {
    // Account number and PIN do not match in the database
    echo "failure";
}

$conn->close();
?>
