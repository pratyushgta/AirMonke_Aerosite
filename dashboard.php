<?php
session_start();
// Clear session data if the "back" button was pressed
if (isset($_POST['back'])) {
    unset($_SESSION['search-results']);
}

if (isset($_SESSION['username']) == "") {
    header("Location: login.php");
}

if (isset($_POST['logout'])) {
    session_unset();
    session_destroy();
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="author" content="Pratyush">
        <meta name="author" content="Aadil">
        <meta name="author" content="Vidit">
        <title>AirMonke</title>
        <link rel="airline-logo.jpg" type="image/x-icon" href="favicon.ico" />
        <script src="angular.min.js"></script>
        <link rel="stylesheet" type="text/css" href="homepage.css">
        <style>
            body{
                background-image: url("19053-wing-plane-view-from-above-city-flight-ocean-4k.jpg");
            }
            .head1{
                background-color: orange;
                border-color: blue;
                border-style: double;
            }
            .ht1{
                width:100%;
            }
            .myac1 {
                background-color: orange;
            }
            .myac1:hover {
                background-color: red;
            }
            .back1 {
                background-color: orange;
            }
            .back1:hover {
                background-color: red;
            }
            .d1{
                height:300px;
                width:300px;
                margin-top:120px;
                margin-left:600px;
                margin-right:500px;
                background-color:bisque;
                border-color:blue;
                border-style:double;
            }
            .f1{
                height:15px;
                width:100%;
            }

        </style>
    </head>
    <body ng-app="">
        <header class="head1">
            <table class="ht1">
                <tr>
                    <td style="text-align: left;width: 25%;"><button class="back1"><a href="homepage.php">BACK</a></button></td>
                    <td style="text-align: center; width: 50%;"><img src="AIRMONKE1-removebg-preview.png" alt="" style="height: 100px;"></td>
                    <td style="text-align: right;width: 25%;"><button class="myac1"><a href="dashboard.php">MY ACCOUNT</a></button></td>
                </tr>
            </table>
        </header>
        <div class="d1">
        <h1>Welcome, <?php echo $_SESSION['username']; ?>!</h1>
        <p>Email: <?php echo $_SESSION['email']; ?></p>

        <h2>Your bookings</h2>
        </div>
        <?php
        // Check if search-results session exists
        if (isset($_SESSION['search-results']) && !empty($_SESSION['search-results'])) {
            echo "<table>";
            echo "<tr><th>PNR</th><th>Flight No.</th><th>Class</th><th>Date of Travel</th><th>Total Fare</th></tr>";
            foreach ($_SESSION['search-results'] as $booking) {
                echo "<tr>";
                echo "<td>" . $booking['pnr'] . "</td>";
                echo "<td>" . $booking['flight_no'] . "</td>";
                echo "<td>" . $booking['class'] . "</td>";
                echo "<td>" . $booking['dot'] . "</td>";
                echo "<td>" . $booking['tot_fare'] . "</td>";
                echo "</tr>";
            }
            echo "</table>";
        }
        ?>
        
        <form class="f1" method="post" action="">
            <input type="submit" name="logout" value="Log out">
            <input type="submit" name="back" value="Go to homepage">
        </form>
        </html>