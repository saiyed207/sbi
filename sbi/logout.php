<?php
// Start the session
session_start();
unset($_SESSION['account_holder_name']);
unset($_SESSION['account_number']);
unset($_SESSION['account_pin']);
exit;

?>