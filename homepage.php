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
    <style>
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
    
    </style>
    
</head>

<body ng-app="">
    <header class="head1">
        <table class="ht1">
            <tr>
                <td style="text-align: left;width: 25%;"><button class="back1"><a href="welcome.php">BACK</a></button></td>
                <td style="text-align: center; width: 50%;"><img src="AIRMONKE1-removebg-preview.png" alt="" style="height: 100px;"></td>
                <td style="text-align: right;width: 25%;"><button class="myac1"><a href="dashboard.php">MY ACCOUNT</a></button></td>
            </tr>
        
        </table>
    </header>
        <section class="slideshow">
        <img src="5502286.webp" alt="Slide 1" />
        <img src="2123210.webp" alt="Slide 1" />
        <div class="slide-text"></div>
        <button class="prev">&#8249;</button>
        <button class="next">&#8250;</button>
    </section>
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


       const slideshow = document.querySelector('.slideshow');
        const prevButton = document.querySelector('.prev');
        const nextButton = document.querySelector('.next');
        const slides = slideshow.querySelectorAll('img');
        let currentSlide = 0;

        // Hide all slides except the first one
        for (let i = 1; i < slides.length; i++) {
            slides[i].style.display = 'none';
        }

        // Add click event listeners to the buttons
        prevButton.addEventListener('click', showPreviousSlide);
        nextButton.addEventListener('click', showNextSlide);

        function showPreviousSlide() {
            // Hide the current slide
            slides[currentSlide].style.display = 'none';
            // Decrement the current slide index
            currentSlide--;

            // Wrap around to the last slide if necessary
            if (currentSlide < 0) {
                currentSlide = slides.length - 1;
            }

            // Show the new current slide
            slides[currentSlide].style.display = 'block';
        }

        function showNextSlide() {
            // Hide the current slide
            slides[currentSlide].style.display = 'none';
            // Increment the current slide index
            currentSlide++;

            // Wrap around to the first slide if necessary
            if (currentSlide >= slides.length) {
                currentSlide = 0;
            }

            // Show the new current slide
            slides[currentSlide].style.display = 'block';
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

