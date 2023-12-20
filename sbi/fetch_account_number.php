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
$accountNumberFromUser = $_POST['account_number'];

// Query the database to fetch the account_number based on the user input
$sql = "SELECT account_number, account_holder_name FROM accounts WHERE account_number = '$accountNumberFromUser'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $_SESSION['account_number'] = $accountNumberFromUser;
    $_SESSION['account_holder_name'] = $row['account_holder_name'];
    session_write_close();

    // Return account holder name as JSON response
    echo json_encode(['status' => 'success', 'account_holder_name' => $row['account_holder_name']]);
} else {
    // Account number not found in the database
    echo json_encode(['status' => 'failure']);
}

$conn->close();
?>
