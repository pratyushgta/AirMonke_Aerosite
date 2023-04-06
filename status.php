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

$flight_no = "";
$org = "";
$flight_data = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $flight_no = $_POST["flight_no"];
    $org = $_POST["org"];

    if ($flight_no && $org) {
        $query = "SELECT f.flight_no, f.ac_reg, f.org, f.dest, f.dept_t, f.arr_t, fl.type_code, fl.name, fl.seat_config 
FROM flight f 
JOIN fleet fl ON f.ac_reg = fl.ac_reg 
WHERE f.flight_no = '$flight_no' AND f.org = '$org';";

        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) > 0) {
            $flight_data = mysqli_fetch_assoc($result);
        } else {
            $flight_data = "No flight data found for given flight no and org";
        }
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
    <header class="head1">
        <table class="ht1">
            <tr>
                <td style="text-align: left;width: 25%;"><button class="back1">BACK</button></td>
                <td style="text-align: center; width: 50%;"><img src="AIRMONKE1-removebg-preview.png" alt="" style="height: 100px;"></td>
                <td style="text-align: right;width: 25%;"><button class="myac1"><a href="dashboard.php">MY ACCOUNT</a></button></td>
            </tr>
        
        </table>
    </header>
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
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <input type="submit" name="logout" value="Logout">
    </form>

    <?php
    if ($flight_data) {
        if (is_array($flight_data)) {
            echo "<h2>Flight Details for {$flight_data['flight_no']}</h2>";
            echo "<p>Ac Reg: {$flight_data['ac_reg']}</p>";
            echo "<p>Org: {$flight_data['org']}</p>";
            echo "<p>Dest: {$flight_data['dest']}</p>";
            echo "<p>Dept Time: {$flight_data['dept_t']}</p>";
            echo "<p>Arr Time: {$flight_data['arr_t']}</p>";
            echo "<p>Type Code: {$flight_data['type_code']}</p>";
            echo "<p>Name: {$flight_data['name']}</p>";
            echo "<p>Seat Config: {$flight_data['seat_config']}</p>";
        } else {
            echo "<p>$flight_data</p>";
        }
    }
    ?>

<script>
    function validateLoginForm() {
        //Redundant. Replaced with AngularJS.
        return true;
    }
</script>

</body>


</html>