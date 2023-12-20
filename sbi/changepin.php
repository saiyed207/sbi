<?php
// Assuming you have already established a database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sbi";

// Create a database connection
$connection = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

if (isset($_POST['name']) && $_POST['name'] === 'btnepin') {
    // Get the PIN and account holder name from the AJAX request
    $pin = $_POST["pin"];
    $account_holder_name = $_SESSION['account_holder_name'];// Replace with the actual account holder name

    // Perform the database update
    // Make sure to use proper database escape functions to prevent SQL injection
    $sql = "UPDATE accounts SET pin = ? WHERE account_holder_name = ?";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("ss", $pin, $account_holder_name);

    if ($stmt->execute()) {
        // Return a success response to the AJAX request
        echo "success";
    } else {
        // Return an error response to the AJAX request
        echo "error";
    }

    // Close the prepared statement and database connection
    $stmt->close();
    $connection->close();
}
?>

<img src='construction.png'/>