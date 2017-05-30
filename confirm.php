<?php
 if(!empty($_POST)) {
 try {
     $firstName = $_POST['firstName'];
     $lasttName = $_POST['lastName'];
     $email = $_POST['email'];
     $isComing = $_POST['RSVP'];
     $message = $_POST['message'];
     // Insert data
     /*$sql_insert = "INSERT INTO registration_tbl (name, email, date) 
                    VALUES (?,?,?)";
     $stmt = $conn->prepare($sql_insert);
     $stmt->bindValue(1, $name);
     $stmt->bindValue(2, $email);
     $stmt->bindValue(3, $date);
     $stmt->execute();*/

     echo "First: $firstName";
     echo "Last: $lastName";
     echo "Email: $email";
     echo "Coming?: $isComing";
     echo "Comments: $message";
 }
 catch(Exception $e) {
     die(var_dump($e));
 }
 echo "<h3>Your're registered!</h3>";
 }
?>