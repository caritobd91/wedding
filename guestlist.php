<?php
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

