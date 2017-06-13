<?php
/* SQL Connection */

$host = getenv("SQLAZURECONNSTR_serverName");
$user = getenv("SQLAZURECONNSTR_UID");
$pwd = getenv("SQLAZURECONNSTR_password");
$db = "Wedding";

try {
    $conn = new PDO( "sqlsrv:Server= $host ; Database = $db ", $user, $pwd);
    $conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
}
catch(Exception $e){
    die(var_dump($e));
}
/* SQL Connection */

 if(!empty($_POST)) {
 try {
     $firstName = $_POST['FirstName'];
     $lastName = $_POST['LastName'];
     $isComing = ($_POST['RSVP'] == 'Yes' ? 1 : 0);
     $message = $_POST['Message'];
     $dateRegistered = date('m/d/Y');

     // Insert data
     $sql_insert = "INSERT INTO Attendee (firstName, lastName, isComing, message) 
                    VALUES (:firstName, :lastName, :isComing, :message, :dateRegistered)";
     $stmt = $conn->prepare($sql_insert);
     $stmt->bindValue(':firstName', $firstName);
     $stmt->bindValue(':lastName', $lastName);
     $stmt->bindValue(':isComing', $isComing);
     $stmt->bindValue(':message', $message);
     $stmt->bindValue(':dateRegistered', $dateRegistered);
     $stmt->execute();

     echo "First: $firstName </br>";
     echo "Last: $lastName </br>";
     echo "Coming?: $isComing </br>";
     echo "Comments: $message </br>";
 }
 catch(Exception $e) {
     die(var_dump($e));
     error_log( "Error: $e" );
 }
 echo "<h3>Thanks for confirming on $dateRegistered, $firstName!</h3>";
 }
?>