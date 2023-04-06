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
<style>
    body{
        background-image: url("bg1.png");
        background-position: center;
    }
    .head2{
        margin-top: 50px;
        font-family: Impact, Haettenschweiler, 'Arial Narrow Bold', sans-serif;
        font-style: italic;
        margin-left: 300px;
    }
    .t2{
        height: 500px;
        width: 700px;
        background-color: aquamarine;
        border-color: blue;
        border-style: double;
        margin-top: 0px;
        margin-left: 300px;
        margin-right: 500px;
    
    }
    .head1{
        background-color: orange;
        border-color: blue;
        border-style: double;
        
    }
    .ht1{
        margin-left: 700px;
        height: 75px;
        
    }
    .f1{
        height: 50px;
        width: 100%;
        margin-bottom: 0px;
        margin-top: 300px;
        background-color: orange;
    }

</style>
<body ng-app="">
    <header class="head1">
        <table class="ht1">
            <tr>
                <td style="text-align: left;width: 25%;"><button class="back1"><a href="manage.php">BACK</a></button></td>
                <td style="text-align: center; width: 50%;"><img src="AIRMONKE1-removebg-preview.png" alt="" style="height: 100px;"></td>
                <td style="text-align: right;width: 25%;"><button class="myac1"><a href="dashboard.php">MY ACCOUNT</a></button></td>
            </tr>
        
        </table>
    </header>
    <h1 class="head2"> Your Booking:</h1>
<table class="t2">
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
<footer>
        <table class="f1">
            <tr>
                <td>AIRMONKE</td>
            </tr>
        </table>
    </footer>

</body>


</html>

