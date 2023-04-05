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

<!DOCTYPE html>
<html>
<head>
    <title>Search Results</title>
</head>
<body>
    <h1>Search Results</h1>
    <?php
    if (isset($_SESSION["search-results"])) {
        $results = $_SESSION["search-results"];
        if (count($results) > 0) {
            echo "<table>";
            echo "<tr><th>Flight No</th><th>Aircraft Reg</th><th>Origin</th><th>Destination</th><th>Departure Time</th><th>Arrival Time</th></tr>";
            foreach ($results as $result) {
                echo "<tr><td>" . $result["flight_no"] . "</td><td>" . $result["ac_reg"] . "</td><td>" . $result["org"] . "</td><td>" . $result["dest"] . "</td><td>" . $result["dept_t"] . "</td><td>" . $result["arr_t"] . "</td></tr>";
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
