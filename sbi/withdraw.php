<?php
// Start the session to access session variables
session_start();

// Replace these database credentials with your actual database details
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sbi";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Assuming you have a unique identifier for the account, let's say 'account_id'.
// Replace 'your_account_id' with the actual identifier for the account you want to fetch.
$accountNumber = $_SESSION['account_number'];
$withdrawAmount = $_POST['withdrawAmount'];

// Validate the withdrawal amount
if (!is_numeric($withdrawAmount) || $withdrawAmount <= 0) {
    echo "Error: Invalid withdrawal amount.";
    exit;
}

// Fetch the account balance from the database
$sql = "SELECT account_balance FROM accounts WHERE account_number = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $accountNumber);

// Execute the prepared statement
$stmt->execute();

// Get the result
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $account_balance = $row['account_balance'];

    // Check if the account balance is sufficient for withdrawal
    if ($account_balance >= $withdrawAmount) {
        // Calculate the new balance
        $new_balance = $account_balance - $withdrawAmount;

        // Update the account balance in the database
        $update_sql = "UPDATE accounts SET account_balance = ? WHERE account_number = ?";
        $update_stmt = $conn->prepare($update_sql);
        $update_stmt->bind_param("ss", $new_balance, $accountNumber);
        $update_stmt->execute();
        $update_stmt->close();

        // Close the prepared statement and database connection
        $stmt->close();
        $conn->close();

        // Return the updated account balance as a response to the AJAX request
        echo $new_balance;
    } else {
        // Handle insufficient balance
        echo "Error: Insufficient balance for withdrawal.";
        $stmt->close();
        $conn->close();
    }
} else {
    // Handle the case where the account is not found in the database
    echo "Error: Account not found.";
    $stmt->close();
    $conn->close();
}
?>
