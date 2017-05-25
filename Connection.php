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
$tsql= "SELECT TOP 20 at.FirstName as FirstName, at.LastName as LastName, at.HasGuest as HasGuest
        FROM [dbo].[Attendee]";
$getResults= sqlsrv_query($conn, $tsql);
echo ("Reading data from table" . PHP_EOL);
if ($getResults == FALSE)
    echo (sqlsrv_errors());
while ($row = sqlsrv_fetch_array($getResults, SQLSRV_FETCH_ASSOC)) {
    echo ($row['CategoryName'] . " " . $row['ProductName'] . PHP_EOL);
}
sqlsrv_free_stmt($getResults);
?>