<?php
 if(!empty($_POST)) {
 try {
     $firstName = $_POST['FirstName'];
     $lasttName = $_POST['LastName'];
     $email = $_POST['Email'];
     $isComing = $_POST['RSVP'];
     $message = $_POST['Message'];
     // Insert data
     /*$sql_insert = "INSERT INTO registration_tbl (name, email, date) 
                    VALUES (?,?,?)";
     $stmt = $conn->prepare($sql_insert);
     $stmt->bindValue(1, $name);
     $stmt->bindValue(2, $email);
     $stmt->bindValue(3, $date);
     $stmt->execute();*/

     echo "First: $firstName </br>";
     echo "Last: $lastName </br>";
     echo "Email: $email </br>";
     echo "Coming?: $isComing </br>";
     echo "Comments: $message </br>";
 }
 catch(Exception $e) {
     die(var_dump($e));
 }
 echo "<h3>Thanks for Confirming!</h3>";
 }
?>