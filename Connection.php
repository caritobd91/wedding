<?php
$serverName = getenv("SQLAZURECONNSTR_serverName");
echo ("Server Name: " . $serverName . "<br />");
$Uid = getenv("SQLAZURECONNSTR_UID");
echo ("UID: " . $Uid . "<br />");
$Password = getenv("SQLAZURECONNSTR_password");
$connectionOptions = array(
    "Database" => "Wedding",
    "Uid" => $Uid,
    "PWD" => $Password
);
//Establishes the connection
$conn = sqlsrv_connect($serverName, $connectionOptions);
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
}
while ($row = sqlsrv_fetch_array($getResults, SQLSRV_FETCH_ASSOC)) {
    echo ($row['FirstName'] . " " . $row['LastName'] . " " . $row['HasGuest'] . "<br />");
}
sqlsrv_free_stmt($getResults);
?>