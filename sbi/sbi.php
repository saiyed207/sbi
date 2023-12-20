<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sbi";


$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$accountNumber = $_SESSION['account_number']; 
$pin = $_SESSION['pin']; 

$sql = "SELECT account_holder_name, account_balance, account_number FROM accounts WHERE account_number = ? AND pin = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $accountNumber, $pin);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
 
    $row = $result->fetch_assoc();
    $account_balance = $row['account_balance'];
    $account_holder_name = $row['account_holder_name'];
    $account_number = $row['account_number'];


    $_SESSION['account_number'] = $account_number;
    $_SESSION['account_holder_name'] = $account_holder_name;
} else {

    echo "failure";
}

$stmt->close();
$conn->close();
?>



<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="styles.css">
        <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
     
        
    </head>
    <body>
    
  
  <!--   -->
    
    <link href='https://fonts.googleapis.com/css?family=Orbitron&text=0123456789:AMP' rel='stylesheet' type='text/css'>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@500&display=swap" rel="stylesheet">
    
    
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@500&display=swap" rel="stylesheet">
    <div id="atmmac">
    
    <div id="outer">
    <div id="camera"><div id="lens"></div>
        <div id="light"></div>
    </div>
    <div id="com">
    
        <button id="b1" ></button>
        <button id="b2"></button>
        <button id="b3"></button>
        <button id="b4"></button>
        <button id="b5"></button>
        <button id="b6"></button>
        
    <p id="com1"><b>SBI ATM</b></p></div>
        <div class="screen">
        
        <div id="loading" >
        
        <p id="inf" style="font-size:70px; margin-left:250px;">Please wait 5 seconds</p>
    <div id="round1"></div>
    <div id="round2"></div>
    <div id="round3"></div>
    <div id="round4"></div>
    <p id="l4" style="color:white;font-weight:bold">Card processing</p>
        </div>
            
        <div id="begin">
              <div style="text-align:center;">
              <img width="400" height="200" src="sbi.png"/>
            </div>
            
           
              <p class="well2" style="font-size:50px; margin-top:120px; margin-left:250px;">Enter your Account Number</p>
              
                <input type="text" class="pass2" name="account_number" maxlength="8">
                <button id="btne2" >Submit</button>
           
          </div>
          <div id="all">
          
          <div class="welcome" style="margin-left:450px; margin-top:200px" >
          <img class="well8" width="400" height="200" src="sbi.png"/>
              <p class="well2" style="font-size:50px; margin-top:120px; margin-left:250px;" >Please enter your password</p>
                <input type="password" name="pin" class="pass" maxlength="4" >
                <button id="btne1" >Submit</button>
                
          </div>
          
          
          
          <div id="beginwrg">

            <div style="text-align:center;">
                <img width="240" height="100" src="sbi.png"/>
              </div>
            <div style="width:100%; height:60px; background-color:aqua;color:blue; margin-top:-20px; font-size:40px; text-align:center";>Invalid Account number !!</div>

              <p id="pinwrg2">!! Please try again !!</p>
              <center> <button id="bac4">Back</button></center>
          </div>
          <div id="pinwrg">

            <div style="text-align:center;">
                <img width="240" height="100" src="sbi.png"/>
              </div>
            <div style="width:100%; height:60px; background-color:aqua;color:blue; margin-top:-20px; font-size:40px; text-align:center";>Invalid Pin</div>

              <p id="pinwrg2">!! Please try again !!</p>
              <center> <button id="bac3">Back</button></center>
          </div>
            <div id="pincrt">
            <div id="success"> 
                <div style="text-align:center;">
                    <img width="240" height="100" src="sbi.png"/>
                  </div>
                <div style="width:100%; height:60px; background-color:aqua;color:blue; margin-top:-20px; font-size:40px; text-align:center";>Please Select Transaction</div>
               
                <div id="accountInfo" style="text-align: center; padding: 20px; color:white; font-size:25px;">           
          </div>
          
            <button id="wdr">WITHDRAW</button>
            <button id="dep">DEPOSIT</button>
            <button id="mst">BAL ENQUIRY</button>
            <button id="cpin">CHANGE PIN</button>
            <button id="det">DETAILS</button>
            <button id="otr">OTHERS</button>
             <center> <button id="backs" name="back" >Cancel</button></center>
            
         </div>
        
        <div id="deti">

            <div style="text-align:center;">
                <img width="300" height="100" src="sbi.png"/>
              </div>

              <div style="width:100%; height:60px; background-color:aqua;color:blue; margin-top:-20px; font-size:40px; text-align:center";>Detail Information</div>

            <table id="de">
                <tr>
                    <td>Account Name :      </td>
                    <td><?php echo $account_holder_name ?> </td>
                </tr>
                <tr>
                    <td style="text-align:right">Account No :</td>
                    <td><?php echo $account_number ?></td>
                </tr>
                <tr>
                    <td style="text-align:right">Total Amount :</td>
                    <td><?php echo $account_balance ?></td>
                </tr>
                <tr>
                    <td style="text-align:right">Account type :</td>
                    <td>Savings</td>
                </tr>
            </table>
           <center> <button id="back">Back</button></center>
       
        
        </div>
        <div id="error">
            <p id="err1">ERROR-404<br></p><p id="erp2">This feature under construction and it will be available soon..</p>
            <center> <button id="back2">Back</button></center>
        </div>
        
        <div id="chgpin">
            <div style="text-align:center;">
                <img width="300" height="100" src="sbi.png"/>
              </div>

              <div style="width:100%; height:60px; background-color:aqua;color:blue; margin-top:-20px; font-size:40px; text-align:center";>Enter the 4 digit new pin !!!</div>
              
              <form id="pinForm" action="changepin.php" method="post">
              <input type="password" name="pin" class="pass" maxlength="4" >
                <button id="btne2" >Change pin</button>
                <img src='construction.png'/>
              </form>
               


            <center> <button id="back3">Back</button></center>
        </div>
        <div id="balen">
            <div style="text-align:center;">
                <img width="300" height="100" src="sbi.png"/>
              </div>

              <div style="width:100%; height:60px; background-color:aqua;color:blue; margin-top:-20px; font-size:40px; text-align:center";>Balance enquiry</div>

            <p id="err5">Total balance : <?php echo $account_balance ?><br>
            <br>credit intrest : 50</p>
            <center> <button id="back4">Back</button></center>
        </div>
        
        <div id="witdrw">
            <div>
            <div style="text-align:center;">
                <img width="300" height="100" src="sbi.png"/>
              </div>

              <div style="width:1210px; height:60px; margin-left:-30px; background-color:aqua;color:blue; margin-top:-20px; font-size:40px; text-align:center";>Enter the amount to withdraw</div>
            </div>
            <br>
            <br>

              <input type="text" id="witdrwno" name="withdraw">
          <button id="btns2">Submit</button>
           <button id="back5">Back</button>
          </div>
          
          
          <div id="bill">
          <p id="succ">!!SUCCESS!!</p>
            <p id="succ2">please collect your cash within 5s else it will be taken back by the atm</p>  
              
              
          </div>
          
          
          
          <div id="result">
          <p id="wdt6">Total amount:</p>
          <p id="wdt7"></p>
          <p id="wdt2">widthdrawl amount:</p>
          <p id="wdt3"></p>
          <p id="wdt4">Remaining balance:</p>
          <p id="wdt5"></p>
          
          <center> <button id="back6">Back</button></center>
          </div>
          <div id="wrong">
          <p id="err5">Error:Your account contains low balance than you entered</p><br><p id="err6">**Please Enter the valid amount** </p>
          <center> <button id="back7">Back</button></center>
          </div>






          
          <div id="depst">

            <div style="text-align:center;">
                <img width="300" height="100" src="sbi.png"/>
              </div>

              <div style="width:1210px; height:60px; margin-left:-30px; background-color:aqua;color:blue; margin-top:-20px; font-size:40px; text-align:center";>Deposit the amount</div>

          <input type="text" id="depstno" name="deposit">
          <input type="button" id="bt3" value="Submit">
           <button id="back8">Back</button>
        </div>
        
        <div id="result2">

            <div style="text-align:center;">
                <img width="300" height="100" src="sbi.png"/>
              </div>

              <div style="width:100%; height:60px; background-color:aqua;color:blue; margin-top:-20px; font-size:40px; text-align:center";>The amount is successfully deposited</div>
            
            <p id="dep8">Total amount:</p>
          <p id="dep9"></p>
          <p id="dep10">Deposited amount:</p>
          <p id="dep11"></p>
          <!-- <p id="dep12">previous balance:</p>
          <p id="dep13"></p> -->
          <center> <button id="back9">Back</button></center>
        </div>

        
        <div id="final">

            <div style="text-align:center;">
                <img width="240" height="100" src="sbi.png"/>
              </div>
            <div style="width:100%; height:60px; background-color:aqua;color:blue; margin-top:-20px; font-size:40px; text-align:center";>Transaction Complete</div>

            <p id="final1">Thank you</p><p id="final3">For visiting our atm</p>
            <p id="final2">Have a nice day</p>
        </div>
        </div>
        </div>
        
        
        
    </div>     
        </div>
        
       
       
        <script>
            


function showe()
{
    $("#begin").show();
    $("#indicator2").hide();
    $("#loading").hide();
    $("#cash1").hide();
    clearInterval(ani);
}
      function showes()
{
    $("#result").show();

    $("#bill").hide();
    $("#cash1").hide();
     $("#indicator2").hide();
    
    clearInterval(mani);
} 
            
$(document).ready(function(){

             
             ani = setInterval("showe()", 900);
             $("#loading").show();
             

 $("#begin").hide();
    
    $(".welcome").hide();
   $("#success").hide ();
    $("#deti").hide();
    $("#error").hide();
    $("#chgpin").hide();
    $("#balen").hide();
    $("#witdrw").hide();
    $("#result").hide();
    $("#wrong").hide();
    $("#depst").hide();
    $("#result2").hide();
    $("#final").hide();
    $("#pinwrg").hide();
    $("#beginwrg").hide();
    $("#bill").hide();
    $("#cash1").hide();
     $("#indicator2").hide();
    

     $(document).ready(function() {
    $("#btne2").click(function() {
        var accs = $(".pass2").val();

        $.ajax({
            type: "POST",
            url: "fetch_account_number.php",
            data: { account_number: accs },
            success: function(response) {
                var data = JSON.parse(response);
                if (data.status === "success") {
                    // Account number matches, show the welcome screen
                    $(".welcome").show("fast");
                    $("#begin").hide("fast");
                    $("#cash1").hide();
                    $("#indicator2").hide();
                    navigator.vibrate(100);

                    // Now fetch the session data without refreshing the page
                    $.ajax({
                        type: "GET",
                        url: "get_session_data.php", // Create a new PHP file to fetch the session data
                        success: function(sessionResponse) {
                            var sessionData = JSON.parse(sessionResponse);
                            if (sessionData.status === "success") {
                                // Display the session data on the webpage
                                $("#accountInfo").html("Account Number: " + sessionData.account_number + "<br>Account Holder Name: " + sessionData.account_holder_name);
                            } else {
                                // Handle failure to fetch session data
                                alert("Failed to fetch session data.");
                            }
                        },
                        error: function() {
                            alert("Error: Unable to fetch data from the server.");
                        }
                    });
                } else {
                    // Account number does not match, show error message
                    $("#beginwrg").show("fast");
                    $("#begin").hide("fast");
                    $("#cash1").hide();
                    $("#indicator2").hide();
                    navigator.vibrate(100);
                }
            },
            error: function() {
                alert("Error: Unable to fetch data from the server.");
            }
        });
    });

   
});
$("#bac4").click(function(){
    $("#begin ").show();
     $("#indicator2").hide();
    $("#beginwrg").hide ();
    $("#cash1").hide();

    navigator.vibrate(100);
    });
    $(document).ready(function() {
          
            function validatePin(pin) {
                $.ajax({
                    type: "POST",
                    url: "fetch_pin.php",
                    data: { pin: pin },
                    success: function(response) {
                        if (response === "success") {
                            // PIN is valid, show the success screen
                            $("#success").show();
                            $(".welcome").hide("fast");
                            $("#cash1").hide();
                            $("#indicator2").hide();
                            navigator.vibrate(100);
                        } else {
                            // PIN is invalid, show error message
                            $("#pinwrg").show();
                            $(".welcome").hide("fast");
                            $("#cash1").hide();
                            $("#indicator2").hide();
                            navigator.vibrate(100);
                        }
                    },
                    error: function() {
                        alert("Error: Unable to fetch data from the server.");
                    }
                });
            }

            $("#btne1").click(function() {
                var pins = $(".pass").val();
                validatePin(pins);
                
            });
        });
$("#bac3").click(function(){
    $(".welcome ").show();
    
    $("#pinwrg").hide ();
    $("#cash1").hide();
     $("#indicator2").hide();
    navigator.vibrate(100);
    });


 $(document).ready(function() {
            $("#backs").click(function() {
                // Hide elements (if needed)
                $(".welcome").hide();
                $("#success").hide();
                $("#deti").hide();
                $("#error").hide();
                $("#balen").hide();
                $("#chgpin").hide();
                $("#witdrw").hide();
                $("#result").hide();
                $("#wrong").hide("fast");
                $("#result2").hide("fast");
                $("#depst").hide("fast");
                $("#cash1").hide();
                $("#indicator2").hide();

             
                $("#final").show();

              
                if ("vibrate" in navigator) {
                    navigator.vibrate(100);
                }

         
                $.ajax({
                    type: "GET",
                    url: "logout.php",
                    success: function(response) {
              
                    },
                    error: function(xhr, status, error) {
               
                    }
                });
            });
        });



  
  
$("#det").click(function(){

    $(".welcome").hide();
    $("#success").hide();
    $("#deti").show();
    $("#error").hide();
    $("#result").hide();
    $("#chgpin").hide();
    $("#balen").hide();
    $("#witdrw").hide();
    $("#wrong").hide("fast");
    $("#depst").hide("fast");
    $("#result2").hide("fast");
    $("#final").hide();
    $("#cash1").hide();
     $("#indicator2").hide();
    
    navigator .vibrate (100);
$("#back").click(function(){
    $(".welcome").hide();
    $("#success").show();
    $("#deti").hide();
    $("#error").hide();
    $("#chgpin").hide();
    $("#balen").hide();
    $("#witdrw").hide();
    $("#wrong").hide("fast");
    $("#depst").hide("fast");
    $("#result2").hide("fast");
    $("#final").hide();
    $("#cash1").hide();
    $("#result").hide();
     $("#indicator2").hide();
    navigator .vibrate (100);
  });
  
  });
$("#otr").click(function(){
    $(".welcome").hide();
    $("#success").hide();
    $("#deti").hide();
    $("#error").show();
    $("#chgpin").hide();
    $("#balen").hide();
    $("#result").hide();
    $("#wrong").hide("fast");
    $("#depst").hide("fast");
    $("#result2").hide("fast");
    $("#final").hide();
    $("#cash1").hide();
    $("#witdrw").hide();
     $("#indicator2").hide();
    navigator .vibrate (100);
$("#back2").click(function(){
    $(".welcome").hide();
    $("#success").show();
    $("#deti").hide();
    $("#error").hide();
    $("#chgpin").hide();
    $("#balen").hide();
    $("#witdrw").hide();
    $("#result").hide();
    $("#wrong").hide("fast");
    $("#depst").hide("fast");
    $("#result2").hide("fast");
    $("#final").hide();
     $("#indicator2").hide();
    $("#cash1").hide();
    navigator .vibrate (100);
  });
  
  });
$("#cpin").click(function(){
    $(".welcome").hide();
    $("#success").hide();
    $("#deti").hide();
    $("#error").hide();
    $("#chgpin").show();
    $("#balen").hide();
    $("#witdrw").hide();
    $("#result").hide();
    $("#wrong").hide("fast");
    $("#depst").hide("fast");
    $("#result2").hide("fast");
    $("#final").hide();
     $("#indicator2").hide();
    $("#cash1").hide();
    navigator .vibrate (100);
$("#back3").click(function(){
    $(".welcome").hide();
    $("#success").show();
    $("#deti").hide();
    $("#error").hide();
    $("#balen").hide();
    $("#chgpin").hide();
    $("#result").hide();
    $("#wrong").hide("fast");
    $("#depst").hide("fast");
    $("#result2").hide("fast");
    $("#final").hide();
    $("#cash1").hide();
    $("#witdrw").hide();
     $("#indicator2").hide();
    navigator .vibrate (100);
  });
  
  });
$("#mst").click(function(){
    $(".welcome").hide();
    $("#success").hide();
    $("#deti").hide();
    $("#error").hide();
    $("#chgpin").hide();
    $("#balen").show();
    $("#result").hide();
    $("#wrong").hide("fast");
    $("#depst").hide("fast");
    $("#result2").hide("fast");
    $("#final").hide();
    $("#cash1").hide();
    
     $("#indicator2").hide();
    $("#witdrw").hide();
    navigator .vibrate (100);
$("#back4").click(function(){
    $(".welcome").hide();
    $("#success").show();
    $("#deti").hide();
    $("#error").hide();
    $("#balen").hide();
    $("#chgpin").hide();
    $("#witdrw").hide();
    $("#result").hide();
    $("#wrong").hide("fast");
    $("#depst").hide("fast");
    $("#result2").hide("fast");
    $("#final").hide();
    $("#cash1").hide();
     $("#indicator2").hide();
    
    navigator .vibrate (100);
  });
  
  });
  
$("#wdr").click(function(){
    $(".welcome").hide();
    $("#success").hide();
    $("#deti").hide();
    $("#error").hide();
    $("#chgpin").hide();
    $("#balen").hide();
    $("#witdrw").show();
    $("#result").hide();
    $("#wrong").hide("fast");
    $("#depst").hide("fast");
    $("#result2").hide("fast");
    $("#final").hide();
    $("#cash1").hide();
    
     $("#indicator2").hide();
    navigator .vibrate (100);

    
$("#back5").click(function(){
    $(".welcome").hide();
    $("#success").show();
    $("#deti").hide();
    $("#error").hide();
    $("#balen").hide();
    $("#chgpin").hide();
    $("#witdrw").hide();
    $("#result").hide();
    $("#wrong").hide("fast");
    $("#depst").hide("fast");
    $("#result2").hide("fast");
    $("#final").hide();
     $("#indicator2").hide();
    
    $("#cash1").hide();
    navigator .vibrate (100);
    });
    });
    

  
    

    



  
    $(document).ready(function() {
    // ... (other code)

    $("#btns2").click(function() {
        var withdrawAmount = $("#witdrwno").val();
        withdrawAmount = parseInt($.trim(withdrawAmount));

      
        $.ajax({
            type: "POST",
            url: "withdraw.php", 
            data: { withdrawAmount: withdrawAmount },
            success: function(response) {
                $("#wdt3").empty();
                $("#wdt5").empty();
                $("#wdt7").empty();
              

                $("#cash1").hide();
                $("#indicator2").hide();

               
                var str = withdrawAmount;
                var sub = parseInt(response);
                var bal = sub+str;

                

                mani = setInterval("showes()", 7000);
                $("#bill").show();
                $("#cash1").show();
                $("#indicator2").show();
                $("#wdt3").append(str);
                $("#wdt5").append(sub);
                $("#wdt7").append(bal);
                $(".welcome").hide();
                $("#success").hide();
                $("#deti").hide();
                $("#error").hide();
                $("#chgpin").hide();
                $("#balen").hide();
                $("#witdrw").hide();
                $("#result").hide();
                $("#wrong").hide("fast");
                $("#depst").hide("fast");
                $("#result2").hide("fast");
                $("#final").hide();
                navigator.vibrate(100);
            },
            error: function() {
                alert("Error: Unable to fetch data from the server.");
            }
        });
    });

    $("#back6").click(function() {
        $(".welcome").hide();
        $("#success").hide();
        $("#deti").hide();
        $("#error").hide();
        $("#balen").hide();
        $("#chgpin").hide();
        $("#witdrw").hide();
        $("#result").hide();
        $("#wrong").hide("fast");
        $("#depst").hide("fast");
        $("#result2").hide("fast");
        $("#final").show();
        $("#cash1").hide();
        $("#indicator2").hide();
        navigator.vibrate(100);
    });

    $("#back7").click(function() {
        $(".welcome").hide();
        $("#success").hide();
        $("#deti").hide();
        $("#error").hide();
        $("#balen").hide();
        $("#chgpin").hide();
        $("#witdrw").show();
        $("#result").hide();
        $("#wrong").hide("fast");
        $("#depst").hide("fast");
        $("#result2").hide("fast");
        $("#final").hide();
        $("#indicator2").hide();

        $("#cash1").hide();
        navigator.vibrate(100);
    });

    // The rest of your code goes here...

});

$("#dep").click(function(){
    $(".welcome").hide();
    $("#success").hide();
    $("#deti").hide();
    $("#error").hide();
    $("#chgpin").hide();
    $("#balen").hide();
    $("#witdrw").hide();
    $("#result").hide();
    $("#wrong").hide("fast");
    $("#depst").show("fast");
    $("#result2").hide("fast");
    $("#final").hide();
    $("#cash1").hide();
     $("#indicator2").hide();
    
    navigator .vibrate (100);
          
$("#back8").click(function(){
    $(".welcome").hide();
    $("#success").show();
    $("#deti").hide();
    $("#error").hide();
    $("#balen").hide();
    $("#chgpin").hide();
    $("#witdrw").hide();
    $("#result").hide();
    $("#wrong").hide("fast");
    $("#depst").hide("fast");
    $("#result2").hide("fast");
    $("#final").hide();
    $("#cash1").hide();
    
     $("#indicator2").hide();
    navigator .vibrate (100);
    });
    });
    
    $(document).ready(function() {
    // ...

    // Function to handle deposit
    function depositAmount(amount) {
    $.ajax({
        type: "POST",
        url: "deposit.php", // Update the URL
        data: { deposit: amount },
        success: function(response) {
            // Process the response from the server if needed
        },
        error: function() {
            alert("Error: Unable to fetch data from the server.");
        }
    });
}

$(document).ready(function() {
    $("#bt3").click(function() {
        var depositAmount = $("#depstno").val();
        depositAmount = parseInt($.trim(depositAmount));
        
        // Perform an AJAX request to call the PHP script for deposit
        $.ajax({
            type: "POST",
            url: "deposit.php", // Update the URL with the correct path to your PHP script
            data: { depositAmount: depositAmount }, // Pass the deposit amount to the server
            success: function(response) {
                // Update the page elements with the returned data
                $("#dep11").empty();
                $("#dep9").empty();
                $("#dep13").empty();
                $("#cash1").hide();
                $("#indicator2").hide();
                
                var newBalance = response;
                var str1 = parseInt(depositAmount);
                var previousBalance = newBalance - str1;
                
                $("#dep11").append(str1);
                $("#dep9").append(newBalance);
                $("#dep13").append(previousBalance);
                $(".welcome").hide();
                $("#success").hide();
                $("#deti").hide();
                $("#error").hide();
                $("#chgpin").hide();
                $("#balen").hide();
                $("#witdrw").hide();
                $("#result").hide();
                $("#wrong").hide("fast");
                $("#result2").show("fast");
                $("#depst").hide("fast");
                $("#final").hide();
                $("#cash1").hide();
                $("#indicator2").hide();
                navigator.vibrate(100);
            },
            error: function() {
                alert("Error: Unable to fetch data from the server.");
            }
        });
    });
});


    
$("#back9").click(function(){
    $(".welcome").hide();
    $("#success").hide();
    $("#deti").hide();
    $("#error").hide();
    $("#balen").hide();
    $("#chgpin").hide();
    $("#witdrw").hide();
    $("#result").hide();
    $("#wrong").hide("fast");
    $("#result2").hide("fast");
    $("#depst").hide("fast");
    $("#final").show();
    $("#cash1").hide();
     $("#indicator2").hide();
    navigator.vibrate(100);
    });
    

  });

});
function arr()
{
    window .alert("Account number:12345678                      Pin number:9876");
    
}


        </script>
        
             
    </body>
</html>