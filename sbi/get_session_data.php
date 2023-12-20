<?php
session_start();

if (isset($_SESSION['account_number']) && isset($_SESSION['account_holder_name'])) {
    $sessionData = [
        'status' => 'success',
        'account_number' => $_SESSION['account_number'],
        'account_holder_name' => $_SESSION['account_holder_name']
    ];
    echo json_encode($sessionData);
} else {
    echo json_encode(['status' => 'failure']);
}
?>
