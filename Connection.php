// PHP Data Objects(PDO) Sample Code:
try {
    $conn = new PDO("sqlsrv:server = tcp:carolinaclaytonwedding.database.windows.net,1433; Database = Wedding", "orman112", "{your_password_here}");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch (PDOException $e) {
    print("Error connecting to SQL Server.");
    die(print_r($e));
}

// SQL Server Extension Sample Code:
$connectionInfo = array("UID" => "orman112@carolinaclaytonwedding", "pwd" => "{your_password_here}", "Database" => "Wedding", "LoginTimeout" => 30, "Encrypt" => 1, "TrustServerCertificate" => 0);
$serverName = "tcp:carolinaclaytonwedding.database.windows.net,1433";
$conn = sqlsrv_connect($serverName, $connectionInfo);


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