<?php
session_start();
if (isset($_SESSION['username']) == "") {
    header("Location: login.php");
}

/*if (!isset($_SESSION['csrf_token'])) {
$_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}*/


if (isset($_POST['logout'])) {
    session_unset();
    session_destroy();
    header("Location: login.php");
    exit();
}
?>
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
<!DOCTYPE html>
<html>
<head>
    <title>Search Results</title>
</head>
<body>
    <header class="head1">
        <table class="ht1">
            <tr>
                <td style="text-align: left;width: 25%;"><button class="back1"><a href="homepage.php">BACK</a></button></td>
                <td style="text-align: center; width: 50%;"><img src="AIRMONKE1-removebg-preview.png" alt="" style="height: 100px;"></td>
                <td style="text-align: right;width: 25%;"><button class="myac1"><a href="dashboard.php">MY ACCOUNT</a></button></td>
            </tr>
        
        </table>
    </header>
    <h1>Search Results</h1>
    <?php
    if (isset($_SESSION["search-results"])) {
        $results = $_SESSION["search-results"];
        if (count($results) > 0) {
            echo "<table>";
            echo "<tr><th>Flight No</th><th>Aircraft Reg</th><th>Origin</th><th>Destination</th><th>Departure Time</th><th>Arrival Time</th></tr>";
            foreach ($results as $result) {
                echo "<tr>
                <td>" . $result["flight_no"] .
                    "</td>
                <td>" . $result["ac_reg"] .
                    "</td>
                <td>" . $result["org"] .
                    "</td>
                <td>" . $result["dest"] .
                    "</td>
                <td>" . $result["dept_t"] .
                    "</td>
                <td>" . $result["arr_t"] .
                    "</td>
                <td>
                
                <form method='post' action='book-flight.php'>
                <input type='hidden' name='flight_no' value='" . $result["flight_no"] . "'/>
                <input type='hidden' name='dot' value='" . $_SESSION["dot"] . "'/>
                <input type='submit' name='book_now' value='Book Now'></form></td></tr>";
            }
            echo "</table>";
        } else {
            echo "No flights found for the given origin and destination.";
        }
        unset($_SESSION["search-results"]);
    } else {
        header("Location: homepage.php");
        exit;
    }
    ?>
    <br>
    <!--<form method="post" action="homepage.php">
        <input type="submit" name="back" value="Back to Home">
        <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>"/>
    </form>-->
</body>
</html>
