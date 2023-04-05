<?php
session_start();

if (!isset($_SESSION["ticket_details"])) {
    header("Location: manage.php");
    exit;
}

$row = $_SESSION["ticket_details"];
unset($_SESSION["ticket_details"]);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="author" content="Pratyush">
    <meta name="author" content="Aadil">
    <meta name="author" content="Vidit">
    <title>AirMonke-Your Booking</title>
    <link rel="airline-logo.jpg" type="image/x-icon" href="favicon.ico" />
    <script src="angular.min.js"></script>
</head>

<body ng-app="">
   <h1>Your Booking:</h1>
<table>
    <tr>
        <th>PNR</th>
        <td><?php echo $row["pnr"]; ?></td>
    </tr>
    <tr>
        <th>Name</th>
        <td><?php echo $row["name"]; ?></td>
    </tr>
    <tr>
        <th>Gender</th>
        <td><?php echo $row["gender"]; ?></td>
    </tr>
    <tr>
        <th>Date of Birth</th>
        <td><?php echo $row["dob"]; ?></td>
    </tr>
    <tr>
        <th>Mobile Number</th>
        <td><?php echo $row["mob_no"]; ?></td>
    </tr>
    <tr>
        <th>Flight Number</th>
        <td><?php echo $row["flight_no"]; ?></td>
    </tr>
    <tr>
        <th>Class</th>
        <td><?php echo $row["class"]; ?></td>
    </tr>
    <tr>
        <th>Date of Travel</th>
        <td><?php echo $row["dot"]; ?></td>
    </tr>
    <tr>
        <th>Total Fare</th>
        <td><?php echo $row["tot_fare"]; ?></td>
    </tr>
</table>


</body>


</html>

