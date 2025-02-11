<?php

require_once '../connection.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_SESSION['userid'])) { 
   

    if(isset($_SESSION['userid'])){
        $userid=$_SESSION['userid'];
    
    if (isset($_POST['data']) && isset($_POST['branch'])){
        function validate($data){

            $data = trim($data);
     
            $data = stripslashes($data);
     
            $data = htmlspecialchars($data);
     
            return $data;
     
         }
         $description=[];
         $totalprice=0.00;
         $branch=validate($_POST['branch']);
      foreach($_POST['data'] as $value){
        
            $item=validate($value[0]);
            $qty=validate($value[1][0]);
            echo "item: $item qty: $qty branch: $branch" ;
            if($branch=="sugarrush"){
                $sql = "SELECT id,name,price FROM items WHERE name = '" . $item . "'";
            }
            else{
                $sql = "SELECT id,name,price FROM itemst WHERE name = '" . $item . "'";
            }
            
            $stmt = $con->prepare($sql);
            $stmt->execute();
            $result = $stmt->get_result();
           
            if ($result->num_rows == 1) {
                $row = $result->fetch_assoc();
                $info="Item:".$row["name"]." Qty:".$qty." price:".$row["price"];
                $description[]=$info;
                $totalprice=$totalprice+(((float)$row["price"])*((float)$qty));
            }
            else{
                echo "stop playing";
            }
        }
        $info=implode("\r\n", $description);
            $sqlo = "SELECT user_id, description, time, branch FROM orders WHERE user_id='$userid'";
            $stmto = $con->prepare($sqlo);
            $stmto->execute();
            $resulto = $stmto->get_result();
            
if ($resulto->num_rows >= 1) {
    $rowo = $resulto->fetch_assoc();
            $time1=$rowo['time'];
            $time2=date("Y-m-d h:i:s");

            // Formulate the Difference between two dates
            $diff = abs($time2 - $time1);
            
            $years = floor($diff / (365*60*60*24));

            $months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));

            $days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));

            $hours = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24 - $days*60*60*24)
									/ (60*60));
            $minutes = (int)floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24 - $days*60*60*24 - $hours*60*60)/ 60);
        if($minutes < 4){
            $query = "UPDATE orders SET  description='$info', branch='$branch', time='$time2', total='$totalprice' WHERE user_id=$userid";
            $stmt = $con->prepare($query);

            if ($stmt) {
                
                
                //echo "$info";
                
                
                
                
                if ($stmt->execute()) {
                    
                    echo "success";
                } else {
                    echo "Error: " . $query . "<br>" . $con->error;
                }
    
                $stmt->close();
            } else {
                echo "Statement preparation error: " . $con->error;
            }
       }
       else{
         $query = "UPDATE orders SET  description='$info', branch='$branch', time='$time2', total='$totalprice' WHERE user_id=$userid";
            $stmt = $con->prepare($query);

            if ($stmt) {
                
                
                //echo "$info";
                
                
                
                
                if ($stmt->execute()) {
                    
                    echo "success";
                } else {
                    echo "Error: " . $query . "<br>" . $con->error;
                }
    
                $stmt->close();
            } else {
                echo "Statement preparation error: " . $con->error;
            }
        echo "the 4 minutes to update your order was spent please contact us on our mobile number to help you more";
       }
        
    
} else{
    $query = "INSERT INTO orders (user_id, description, branch, time, total) VALUES(?, ?, ?, ?, ?)";
    $stmt = $con->prepare($query);

    if ($stmt) {
        $time=date("Y-m-d h:i:s");
        //echo "$info";
        
        $stmt->bind_param("sssss", $userid, $info, $branch, $time, $totalprice);
        
        if ($stmt->execute()) {
            
            echo "success";
        } else {
            echo "Error: " . $sql . "<br>" . $con->error;
        }

        $stmt->close();
    } else {
        echo "Statement preparation error: " . $con->error;
    }
}






                

            
                
        
        // $var = implode(json_decode($_POST['data'])) ;
            //echo $var;
            
        }//isset
    }
    else{
        echo "you are not loggedin!!";
    }
}
else{
    echo "you are not loggedin!!";
}

?>