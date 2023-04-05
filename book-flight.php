<?php
session_start();
// Clear session data if the "back" button was pressed
if (isset($_POST['back'])) {
    unset($_SESSION['search-results']);
}

if (empty($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

if (isset($_POST['logout'])) {
    session_unset();
    session_destroy();
    header("Location: login.php");
    exit();
}

require_once "database.php";

function generateRandomString($length = 10)
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $flight_no = $_POST['flight_no'];
    $dot = $_POST['dot'];
    $pnr = generateRandomString(5);
    $pax_id = $_POST["pax_id"];
    $class = $_POST["class"];
    $tot_fare = 1540;
    $name = $_POST["name"];
    $gender = $_POST["gender"];
    $dob = $_POST["dob"];
    $mob_no = $_POST["mob_no"];
    $email = $_POST["email"];

    $query1 = "INSERT INTO pax VALUES('$pax_id','$name','$gender','$dob','$mob_no','$email')";
    $query2 = "INSERT INTO ticket VALUES('$pnr','$pax_id','$flight_no','$class','$dot','$tot_fare')";

    $result1 = mysqli_query($conn, $query1);
    $result2 = mysqli_query($conn, $query2);

    echo "PNR: " . $pnr . "<br>";
    echo "Name: " . $name . "<br>";
    echo "Gender: " . $gender . "<br>";
    echo "DOB: " . $dob . "<br>";
    echo "Mobile No.: " . $mob_no . "<br>";
    echo "Email: " . $email . "<br>";
    echo "Flight No.: " . $flight_no . "<br>";
    echo "Class: " . $class . "<br>";
    echo "DOT: " . $dot . "<br>";
    echo "Total Fare: " . $tot_fare . "<br>";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="author" content="Pratyush">
    <meta name="author" content="Aadil">
    <meta name="author" content="Vidit">
    <title>AirMonke- Book</title>
    <link rel="icon" type="image/x-icon" href="favicon.ico" />
    <script src="angular.min.js"></script>
    <link rel="stylesheet" type="text/css" href="homepage.css">
</head>

<body ng-app="">
    <h1>Your booking:</h1>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER[" PHP_SELF"]); ?>" name="bookingForm">
        <label for="name">Your name:</label>
        <input type="text" id="name" name="name" required ng-model="name">
        <br>
        <label for="gender">Gender:</label>
        <label><input type="radio" name="gender" value="male" required> Male</label>
        <label><input type="radio" name="gender" value="female" required> Female</label>
        <br>
        <label for="dob">DOB:</label>
        <input type="date" id="dob" name="dob" required ng-model="dob">
        <br>
        <label for="mob_no">Mobile number:</label>
        <input type="tel" id="mob_no" name="mob_no" required ng-model="mob_no">
        <br>
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required ng-model="email">
        <br>
        <label for="class">Class:</label>
        <select id="class" name="class" required>
            <option value="">Select class</option>
            <option value="economy">Economy</option>
            <option value="business">Business</option>
            <option value="first">First</option>
        </select>
        <br>
        <label for="pax_id">Pax ID:</label>
        <input type="numerical" id="pax_id" name="pax_id" required ng-model="pax_id">
        <br>
        <input type="submit" value="Submit" ng-disabled="!bookingForm.$valid">
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