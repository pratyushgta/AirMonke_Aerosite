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

require_once "database.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $org = $_POST["org"];
    $dest = $_POST["dest"];
    $dept_t = null;
    $arr_t = null;
    $dot = $_POST["dot"];
    $_SESSION['dot'] = $dot;

    if ($org && $dest && $dot) {
        $query = "SELECT * FROM flight WHERE org = '$org' AND dest = '$dest'";

        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) > 0) {
            // Store all the flight details in the session
            $_SESSION["search-results"] = array();
            while ($row = mysqli_fetch_assoc($result)) {
                $_SESSION["search-results"][] = $row;
            }
            mysqli_free_result($result);
            mysqli_close($conn);
            header("Location: search-results.php");
            exit;
        } else {
            // No flights found
            echo "No flights found for the given origin and destination.";
        }
    } else {
        // Missing search criteria
        echo "<script>alert('Please provide both origin, destination, and date of travel.')</script>";
    }
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
    <h1>Book Now!</h1>
    <div id="home">
        <form class="search-form" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <ul class="nav-menu2">
                <li><a href="#">Search Flights</a></li>
                <li><a href="manage.php">Manage</a></li>
                <li><a href="status.php">Flight Status</a></li>
            </ul>

            <h3>Search Flights</h3>
            <span class="pax-type"><label for="flight-type">Flight type:</label></span>
            <select id="flight-type" name="flight-type">
                <option value="one-way">One-way</option>
                <option value="round-trip">Round-trip</option>
                <option value="multi-city">Multi-city</option>
            </select>

            <span class="pax-type"><label for="passengers">Passengers:</label></span>
            <input type="number" id="passengers" name="passengers" class="drop" step="1" min="1" max="10">

            <div class="from-to-date-container">
                <div class="from-to-container">
                    <label for="org">From:</label>
                    <select id="org" name="org">
                        <option value="Origin">Origin</option>
                        <option value="Mumbai">Mumbai</option>
                        <option value="Delhi">Delhi</option>
                        <option value="Banglore">Banglore</option>
                        <option value="Kolkata">Kolkata</option>
                    </select>

                    <select id="dest" name="dest">
                        <option value="dest">Destination</option>
                        <option value="Mumbai">MUMBAI</option>
                        <option value="Delhi">Delhi</option>
                        <option value="Banglore">Banglore</option>
                        <option value="Kolkata">Kolkata</option>
                    </select>
                </div>
                <div class="dates-container">
                    <label for="dot">Departure date:</label>
                    <input type="date" id="dot" name="dot" required />

                    <label for="return-date">Return date:</label>
                    <input type="date" id="return-date" name="return-date disabled" disabled>
                </div>
            </div>

            <button type="submit">Search</button>
        </form>
    </div>
    <script>
        function validateLoginForm() {
            //Redundant. Replaced with AngularJS.
            return true;
        }


        const flightType = document.querySelector('#flight-type');
        const returnDate = document.querySelector('#return-date');

        flightType.addEventListener('change', () => {
            if (flightType.value === 'one-way') {
                returnDate.disabled = true;
                returnDate.value = '';
            } else {
                returnDate.disabled = false;
            }
        });
    </script>


</body>


</html>

