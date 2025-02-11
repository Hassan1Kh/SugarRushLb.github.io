<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sugar Rush - Drinks and Sweets</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="history.css" id="special">
  
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="bootstrap.min.css">




</head>

<body>

<div class="navbar navbar-inverse">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">

                    <div class="navbar-header">
                        <button class="navbar-toggle" data-target="#mobile_menu" data-toggle="collapse"><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button>
                        <a href="index.php" class="navbar-brand">Sugar Rush</a>
                    </div>

                    <div class="navbar-collapse collapse" id="mobile_menu">
                        <ul class="nav navbar-nav">
                            <li><a href="index.php">Home</a></li>
                            <li><a href="#menu" onclick="forworder()" >Menu</a></li>
                            <?php

                        if(isset($_SESSION['username'])){
                          echo '<li><a href="index.php" id="openFormBtn">Reservation</a></li>
                          <li><a href="History.php">History</a></li>';
                          }
                          ?>
                            <li><a href="#about"  onclick="forworder()">About Us</a></li>
                            <li><a href="#contact">Contact Us</a></li>
                            <li><a href="#visit">Visit Us</a></li>
                            <!-- <li><a href="#">Contact Us</a></li>-->
                        </ul>
                        
                        <?php

                        if(isset($_SESSION['username'])){
                          echo ' <ul class="nav navbar-nav navbar-right">
                            
                          <li><a href="" class="dropdown-toggle" data-toggle="dropdown">Welcome '. $_SESSION['username'].' </a>
                              <ul class="dropdown-menu bg-dark">
                                  <li><a href="admin/logout.php" onclick="logout()">logout</a> </li>
                                  
                              </ul>';
                          }
                          else{
                            echo '<ul class="nav navbar-nav navbar-right">
                            
                            <li><a href="" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-log-in"></span> Login / Sign Up <span class="caret"></span></a>
                                <ul class="dropdown-menu bg-dark">
                                    <li><a href="admin_login.php">Login</a></li>
                                    <li><a href="signup.php">Sign Up</a></li>
                                </ul>';
                          }
                          ?>
                        
                            </li>
                        </ul>
                        
                    </div>
                </div>
            </div>
        </div>
        
        <header class="parallax" id="paralexo">
<div class="wrapper rounded"  id="special"> 


    <nav class="navbar navbar-expand-lg navbar-dark dark d-lg-flex align-items-lg-start">
         <a class="navbar-brand" href="#">Transactions 
            <p class="text-muted pl-1">Welcome to your transactions</p> </a> 
             
             
            </nav>
             <div class="row mt-2 pt-2"> 
                 
                 <div class="col-md-12">
                     
                     </div> 
                    </div> 
                    <div class="d-flex justify-content-between align-items-center mt-3">
                         <ul class="nav nav-tabs w-75">
                             <li class="nav-item"> <a class="nav-link active" href="#history">History</a> </li>
                            
                        </ul> 
                       
                    </div> 
                    <div class="table-responsive mt-3">
                         <table class="table table-dark table-borderless">
                           
                                             <?php
require_once '../connection.php'; 


if (isset($_SESSION['userid'])) { 
    $userid=$_SESSION['userid'];
// Step 2: Execute a query to retrieve data from the database
$sql = "SELECT * FROM history where user_id='$userid'"; // Change this to your table name
$result = $con->query($sql);



if ($result->num_rows > 0) {
    // Output data of each row
    while($row = $result->fetch_assoc()) {
        $linkedid=$row["link_id"];
        if($row["type"]=="order"){
        $sqli = "SELECT * FROM orders where id='$linkedid'"; // Change this to your table name
        $resulti = $con->query($sqli);
        if ($resulti->num_rows > 0) {
            $rowi = $resulti->fetch_assoc();
            // Step 3: Output the data within the HTML table
echo '<table class="table table-dark table-borderless">';
echo '<thead>';
echo '<tr>';
echo '<th scope="col">Activity</th>';
echo '<th scope="col">Date</th>';
echo '<th scope="col" class="text-right">Amount</th>';
echo '</tr>';
echo '</thead>';
echo '<tbody>';
        echo '<tr>';
        echo '<td scope="row">' . $row["type"] . '</td>'; // Assuming "type" corresponds to the "Activity" column
        echo '<td class="text-muted">' . $rowi["time"] . '</td>'; // Change "date_column" to the actual column name for the date
        echo '<td class="d-flex justify-content-end align-items-center">' . $rowi["total"] . '$</td>'; // Change "amount_column" to the actual column name for the amount
        echo '</tr>';
        }
        }
        else{
            $sqli = "SELECT * FROM reservations where id='$linkedid'"; // Change this to your table name
        $resulti = $con->query($sqli);
        if ($resulti->num_rows > 0) {
            $rowi = $resulti->fetch_assoc();
            // Step 3: Output the data within the HTML table
echo '<table class="table table-dark table-borderless">';
echo '<thead>';
echo '<tr>';
echo '<th scope="col">Activity</th>';
echo '<th scope="col">Date</th>';
echo '<th scope="col" class="text-right">Time</th>';
echo '</tr>';
echo '</thead>';
echo '<tbody>';
        echo '<tr>';
        echo '<td scope="row">' . $row["type"] . '</td>'; // Assuming "type" corresponds to the "Activity" column
        echo '<td class="text-muted">' . $rowi["arrival_date	"] . '</td>'; // Change "date_column" to the actual column name for the date
        echo '<td class="d-flex justify-content-end align-items-center">' . $row["arrival_time"] . '</td>'; // Change "amount_column" to the actual column name for the amount
        echo '</tr>';
        }
        }
        
    }
} else {
    echo '<tr><td colspan="3">No data found</td></tr>';
}

echo '</tbody>';
echo '</table>';
}
// Step 4: Close the database connection
$con->close();
?>

                                           
                                            </div>
                                                 <div class="d-flex justify-content-between align-items-center results"> 
                                                
                                                <div class="pt-3"> <nav aria-label="Page navigation example"> <ul class="pagination"> <li class="page-item disabled"> <a class="page-link" href="#" aria-label="Previous"> <span aria-hidden="true">&lt;</span> </a> </li> <li class="page-item"> <a class="page-link" href="#" aria-label="Next"> <span aria-hidden="true">&gt;</span> </a> </li> </ul> </nav> </div> </div>
</div>
        </header>
        
    <footer>
    <div class="container">
        <p>&copy; 2024 Sugar Rush. All rights reserved.</p>
    </div>
</footer>

                        </body>
                        </html>