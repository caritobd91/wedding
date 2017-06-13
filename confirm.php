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
     // Insert data
     $sql_insert = "INSERT INTO Attendee (firstName, lastName, isComing, message) 
                    VALUES (_firstName, _lastName, _isComing, _message)";
     $stmt = $conn->prepare($sql_insert);
     $stmt->bindValue('_firstName', $firstName);
     $stmt->bindValue('_lastName', $lastName);
     $stmt->bindValue('_isComing', $isComing);
     $stmt->bindValue('_message', $message);
     echo "STMT: $stmt";
     $stmt->execute();

     echo "First: $firstName </br>";
     echo "Last: $lastName </br>";
     echo "Coming?: $isComing </br>";
     echo "Comments: $message </br>";
 }
 catch(Exception $e) {
     die(var_dump($e));
 }
 echo "<h3>Thanks for confirming, $firstName!</h3>";
 }
?>