<!doctype html>
<html class="no-js" lang="">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Carolina & Clayton</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="apple-touch-icon" href="apple-touch-icon.png">
    <!-- Place favicon.ico in the root directory -->

    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/style.css">
    <link href="https://fonts.googleapis.com/css?family=Dancing+Script" rel="stylesheet">
    <script src="js/vendor/modernizr-2.8.3.min.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300" rel="stylesheet">
</head>
<body>
	<div id="navcontainer">

            <ul id="navlist">
                <li><a href="index.html">Home</a></li>
                <li><a href="rsvp.html">RSVP</a></li>
                <li><a href="directions.html">Directions</a></li>
                <li><a href="registry.html">Registry</a></li>
            </ul>
    </div>
    <div class="confirmation">
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

                $sql_select = "SELECT TOP 1* FROM Attendee WHERE FirstName = :firstName AND LastName = :lastName";
                $stmt = $conn->prepare($sql_select);
                $stmt->bindValue(':firstName', $firstName);
                $stmt->bindValue(':lastName', $lastName);
                $stmt->execute();
                $result = $stmt -> fetchAll(PDO::FETCH_ASSOC);
                $count = count($result);

                //If no records exist
                if(!($count > 0))
                {
                    // Insert data
                    $sql_insert = "INSERT INTO Attendee (firstName, lastName, isComing, message, dateRegistered) 
                                    VALUES (:firstName, :lastName, :isComing, :message, :dateRegistered)";
                    $stmt = $conn->prepare($sql_insert);
                    $stmt->bindValue(':firstName', $firstName);
                    $stmt->bindValue(':lastName', $lastName);
                    $stmt->bindValue(':isComing', $isComing);
                    $stmt->bindValue(':message', $message);
                    $stmt->bindValue(':dateRegistered', $dateRegistered);
                    $stmt->execute();

                    if($isComing == 1){
                        echo "<h1>Thanks for your confirmation, $firstName! See you on September 3rd!</h1>";
                    }
                    else {
                        echo "<h1>We are sorry you can't make it. Please give us a call if you change your mind, (502)-889-1469.</h1>";
                    }
                }
                //Person already registered
                else {
                    $previousDate = $result[0]['DateRegistered'];
                    echo "<h1>$firstName, it looks like you've already registered on $previousDate</h1>";
                }
            }
            catch(Exception $e) {
                echo "<h1>Looks like something went wrong submitting the form. Please <a href='/rsvp.html'>click here</a> to fill out the form again. Thank you.</h1>";
                die(var_dump($e));
                error_log( "Error: $e" );
            }
        }
        ?>
    </div>

    <script src="https://code.jquery.com/jquery-1.12.0.min.js"></script>
     <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.12.0.min.js"><\/script>')</script>
        <script src="js/plugins.js"></script>
        <script src="js/main.js"></script>
    </body>
</html>