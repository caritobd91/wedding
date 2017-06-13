<?php
/* SQL Connection */
/*
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
}*/
/* SQL Connection */

 if(!empty($_POST)) {
 try {

     //date_default_timezone_set('UTC');
     $firstName = $_POST['FirstName'];
     $lastName = $_POST['LastName'];
     $isComing = ($_POST['RSVP'] == 'Yes' ? 1 : 0);
     $message = $_POST['Message'];
     $dateRegistered = date('m/d/Y');
     // Insert data
     $sql_insert = "INSERT INTO Attendee (firstName, lastName, isComing, message) 
                    VALUES (?,?,?,?)";
     $stmt = $conn->prepare($sql_insert);
     $stmt->bindValue(1, $firstName);
     $stmt->bindValue(2, $lastName);
     $stmt->bindValue(3, $isComing);
     $stmt->bindValue(4, $message);
     $stmt->execute();

     echo "First: $firstName </br>";
     echo "Last: $lastName </br>";
     echo "Coming?: $isComing </br>";
     echo "Comments: $message </br>";
     echo "Date Registered: $dateRegistered </br>";
 }
 catch(Exception $e) {
     die(var_dump($e));
 }
 echo "<h3>Thanks for confirming, $firstName!</h3>";
 }
?>