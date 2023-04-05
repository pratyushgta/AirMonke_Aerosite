<?php
session_start();

if (isset($_SESSION['username']) == "") {
    header("Location: homepage.php");
}

if (isset($_POST['logout'])) {
    session_unset();
    session_destroy();
    header("Location: homepage.php");
    exit();
}

require_once "database.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $flight_no = $_POST["flight_no"];
    $org = $_POST["org"];

    if ($email && $pnr) {
        $query = "SELECT t.pnr, t.pax_id, p.name, p.gender, p.dob, p.mob_no, t.flight_no, t.class, t.dot, t.tot_fare
                  FROM ticket t
                  INNER JOIN pax p ON t.pax_id = p.pax_id
                  WHERE t.pnr = '$pnr'
                  AND p.email = '$email'";

        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) > 0) {
            // Display the ticket details in a new webapge
            $row = mysqli_fetch_assoc($result);
            $_SESSION["ticket_details"] = $row;
            header("Location: ticket_details.php");
            exit;
        } else {
            // PNR does not exist in the database
            echo "PNR does not exist in the database or email id does not match with given PNR.";
        }
    } else {
        // PNR or email not provided
        echo "Please provide both PNR and email.";
    }
}

mysqli_close($conn);
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="author" content="Pratyush">
    <meta name="author" content="Aadil">
    <meta name="author" content="Vidit">
    <title>AirMonke-Manage</title>
    <link rel="airline-logo.jpg" type="image/x-icon" href="favicon.ico" />
    <script src="angular.min.js"></script>
</head>

<body ng-app="">
   <h1>Manage</h1>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" name="statusForm">
    <label for="flight_no">Flight No.:</label>
    <input type="numeric" id="flight_no" name="flight_no" required ng-model="flight_no">
    <br>
    <label for="org">Origin:</label>
    <input type="org" id="org" name="org" required ng-model="org">
    <br>
    <input type="submit" value="Submit" ng-disabled="!statusForm.$valid || !flight_no || !org">
</form>

<script>
    function validateLoginForm() {
        //Redundant. Replaced with AngularJS.
        return true;
    }
</script>

</body>


</html>