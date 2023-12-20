<?php
// Assuming you have already established a database connection
// Replace 'your_db_host', 'your_db_username', 'your_db_password', and 'your_db_name' with your database credentials
$host = 'your_db_host';
$username = 'your_db_username';
$password = 'your_db_password';
$db_name = 'your_db_name';

$conn = mysqli_connect($host, $username, $password, $db_name);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_POST['account']) && isset($_POST['pin'])) {
    $account = $_POST['account'];
    $pin = $_POST['pin'];

    // Prevent SQL injection
    $account = mysqli_real_escape_string($conn, $account);
    $pin = mysqli_real_escape_string($conn, $pin);

    // Fetch the account and pin from the database
    $sql = "SELECT * FROM accounts WHERE account_number = '$account' AND pin = '$pin'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) == 1) {
        // Account and pin match, login successful
        // You can redirect the user to the logged-in page or display a success message here
        echo "Login successful!";
    } else {
        // Account and/or pin does not match, login failed
        // You can redirect the user to the login page with an error message or display an error message here
        echo "Invalid account number or pin!";
    }
}

mysqli_close($conn);
?>
