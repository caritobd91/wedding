<?php
$serverName = SQLAZURECONNSTR_serverName;
$Uid = SQLAZURECONNSTR_UID;
$Password = SQLAZURECONNSTR_password;
$connectionOptions = array(
    "Database" => "Wedding",
    "Uid" => $Uid,
    "PWD" => $Password
);
//Establishes the connection
$conn = sqlsrv_connect($serverName, $connectionOptions);
$tsql= "SELECT TOP 20 [FirstName],[LastName],[IsComing],[HasGuest]
        FROM [dbo].[Attendee]";
$getResults= sqlsrv_query($conn, $tsql);
echo ("Reading data from table" . PHP_EOL);
if ($getResults == FALSE) {
    echo ("Error getting SQL results: " . sqlsrv_errors());
    echo ($getResults);
}
else {
    echo ("First Name" . " " . "Last Name" . " " . "Has A Guest Coming" . PHP_EOL);
}
while ($row = sqlsrv_fetch_array($getResults, SQLSRV_FETCH_ASSOC)) {
    echo ($row['FirstName'] . " " . $row['LastName'] . " " . $row['HasGuest'] . PHP_EOL);
}
sqlsrv_free_stmt($getResults);
?>