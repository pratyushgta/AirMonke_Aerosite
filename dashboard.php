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
</head>

<body ng-app="">
    <h1>Welcome, <?php echo $_SESSION['username']; ?>!</h1>
    <p>Email: <?php echo $_SESSION['email']; ?></p>

    <h2>Your bookings</h2>
    
     
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
    
    <form method="post" action="">
        <input type="submit" name="logout" value="Log out">
        <input type="submit" name="back" value="Go to homepage">
    </form>
    <!--<form method="post" action="homepage.php">
        <input type="submit" name="back" value="Back to Home">
        <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>"/>
    </form>-->
</body>

</html>