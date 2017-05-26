<?php
$host = getenv("SQLAZURECONNSTR_serverName");
echo ("Host: " . $host . "<br />");
$user = getenv("SQLAZURECONNSTR_UID");
echo ("User: " . $user . "<br />");
$pwd = getenv("SQLAZURECONNSTR_password");
$db = "Wedding";
/*$connectionOptions = array(
    "Database" => "Wedding",
    "Uid" => $Uid,
    "PWD" => $Password
);*/
//Establishes the connection
/*$conn = sqlsrv_connect($serverName, $connectionOptions);
echo ("Connection: " . $conn . "<br />");
$tsql= "SELECT * [FirstName],[LastName],[IsComing],[HasGuest] FROM [dbo].[Attendee]";
echo ("TSQL: " . $tsql . "<br />");
$getResults= sqlsrv_query($conn, $tsql);
echo ("Reading data from table" . "<br />");
if ($getResults == FALSE) {
    if( ($errors = sqlsrv_errors() ) != null) {
        foreach( $errors as $error ) {
            echo "SQLSTATE: ".$error[ 'SQLSTATE']."<br />";
            echo "code: ".$error[ 'code']."<br />";
            echo "message: ".$error[ 'message']."<br />";
        }
       print_r( sqlsrv_errors(), true);
    }
}
else {
    echo ("First Name" . " " . "Last Name" . " " . "Has A Guest Coming" . "<br />");
}*/
 try {
     $conn = new PDO( "sqlsrv:Server= $host ; Database = $db ", $user, $pwd);
     $conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
 }
 catch(Exception $e){
     die(var_dump($e));
 }

$sql_select = "SELECT * FROM [Attendee]";
 $stmt = $conn->query($sql_select);
 $registrants = $stmt->fetchAll(); 
 if(count($registrants) > 0) {
     echo "<h2>People who are registered:</h2>";
     echo "<table>";
     echo "<tr><th>First Name</th>";
     echo "<th>Last Name</th>";
     echo "<th>Is Attending</th></tr>";
     foreach($registrants as $registrant) {
         echo "<tr><td>".$registrant['FirstName']."</td>";
         echo "<td>".$registrant['LastName']."</td>";
         echo "<td>".$registrant['IsComing']."</td></tr>";
     }
      echo "</table>";
 } else {
     echo "<h3>No one is currently attending.</h3>";
 }
?>

