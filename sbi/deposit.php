<!-- This deposit is being encapsulated by Saiyed Afak Ahmed before the amount is being deposited into the database -->
<?php
class AccountManager
{
    private $conn;

    public function __construct($servername, $username, $password, $dbname)
    {
        $this->conn = new mysqli($servername, $username, $password, $dbname);
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    public function __destruct()
    {
        $this->conn->close();
    }

    public function depositAmount($accountNumber, $depositAmount)
    {
       
        if (!is_numeric($depositAmount) || $depositAmount <= 0) {
            return "Error: Invalid deposit amount.";
        }

      
        $select_sql = "SELECT account_balance FROM accounts WHERE account_number = ?";
        $stmt = $this->conn->prepare($select_sql);
        $stmt->bind_param("s", $accountNumber);

      
        $stmt->execute();

      
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $account_balance = $row['account_balance'];

           
            $new_balance = $account_balance + $depositAmount;

            $update_sql = "UPDATE accounts SET account_balance = ? WHERE account_number = ?";
            $update_stmt = $this->conn->prepare($update_sql);
            $update_stmt->bind_param("ss", $new_balance, $accountNumber);
            $update_stmt->execute();
            $update_stmt->close();

       
            return $new_balance;
        } else {
            
            return "Error: Account not found.";
        }
    }
}


session_start();


$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sbi";


$accountManager = new AccountManager($servername, $username, $password, $dbname);


$accountNumber = $_SESSION['account_number'];
$depositAmount = $_POST['depositAmount'];


$newAccountBalance = $accountManager->depositAmount($accountNumber, $depositAmount);


echo $newAccountBalance;
?>
