<?php
session_start();

require_once "database.php";

if (isset($_SESSION['username'])) {
    header("Location: homepage.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    if ($username && $password) {
        $query = "SELECT * FROM user WHERE username = '$username'";
        $result = mysqli_query($conn, $query);
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            if ($row['username'] == $username && $row['password'] == $password) {
                // username and password match
                $_SESSION['username'] = $row['username'];
                $_SESSION['password'] = $row['password'];
                $_SESSION['email'] = $row['email'];
                $_SESSION['f_name'] = $row['f_name'];
                $_SESSION['l_name'] = $row['l_name'];
                header("Location: homepage.php");
                exit;
            } else {
                // username and/or password don't match
                echo '<script>alert("I am afraid... username or password do not match our records!")</script>';
            }

        } else {
            echo "Uh oh! Looks like you're not registered with us...";
            echo "<button onclick='window.location.href=\"signup.php\";'>Sign up!</button>";
        }
    } else {
        echo "[PHP-ERROR-2A]: Voila! You spotted a bug! Report to customer support for a free flight ticket!";
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
    <title>AirMonke-Login</title>
    <link rel="airline-logo.jpg" type="image/x-icon" href="favicon.ico" />
    <script src="angular.min.js"></script>
</head>

<body ng-app="">
   <h1>LOGIN</h1>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" name="loginForm" ng-app>
    <label for="username">Username:</label>
    <input type="text" id="username" name="username" required ng-model="username">
    <br>
    <label for="password">Password:</label>
    <input type="password" id="password" name="password" required ng-model="password">
    <br>
    <input type="submit" value="Submit" ng-disabled="!loginForm.$valid || !username || !password">
</form>

<script>
    function validateLoginForm() {
        //Redundant. Replaced with AngularJS.
        return true;
    }
</script>

</body>


</html>