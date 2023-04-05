<?php
session_start();

require_once "database.php";

if (isset($_SESSION['user_id'])) {
    header("Location: welcome.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];
    $email = $_POST["email"];
    $f_name = $_POST["f_name"];
    $l_name = $_POST["l_name"];

    if ($username && $password && $email && $f_name && $l_name) {
        $query = "SELECT * FROM user WHERE email = '$email'";
        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) > 0) {
            echo "Email is already registered with us! Log in instead?";
            echo "<button onclick='window.location.href=\"login.php\";'>Login</button>";
        } else {
            $query = "INSERT INTO user VALUES ('$username', '$email', '$password', '$f_name','$l_name')";
            if (mysqli_query($conn, $query)) {
                echo "Hohoho! Your account has been created!";
                echo "<br><button onclick='window.location.href=\"login.php\";'>Continue</button>";
            } else {
                echo "[PHP-ERROR-1A]: You account could not be created at this moment...";
                echo "<button onclick='window.location.href=\"signup.php\";'>Retry</button>";
            }
        }
    } else {
        echo "[PHP-ERROR-1B]: Voila! You spotted a bug! Report to customer support for a free flight ticket!";
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
    <title>AirMonke-Register</title>
    <link rel="airline-logo.jpg" type="image/x-icon" href="favicon.ico" />
    <script src="angular.min.js"></script>
</head>

<body ng-app="registerApp" ng-controller="registerController">
    <h1>Sign Up!</h1>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" name="registerForm"
      ng-app="registerApp" ng-controller="registerController" novalidate>
    <label for="First Name">First Name:</label>
    <input type="text" id="f_name" name="f_name" ng-model="formData.f_name" ng-pattern="/^[a-zA-Z]+$/" required>
    <div ng-show="registerForm.f_name.$touched && registerForm.f_name.$error.required">
        Hmm are you nameless?
    </div>
    <div ng-show="registerForm.f_name.$error.pattern">
        Whattt? Your name has numbers in it? That's a first
    </div>
    <br>

    <label for="Last Name">Last Name:</label>
    <input type="text" id="l_name" name="l_name" ng-model="formData.l_name" ng-pattern="/^[a-zA-Z]+$/" required>
    <div ng-show="registerForm.l_name.$touched && registerForm.l_name.$error.required">
        Last name is required!
    </div>
    <div ng-show="registerForm.l_name.$error.pattern">
        Again, last name can contain alphabets only!
    </div>
    <br>

    <label for="username">Username:</label>
    <input type="text" id="username" name="username" ng-model="formData.username" ng-minlength="5" required>
    <div ng-show="registerForm.username.$touched && registerForm.username.$error.required">
        Please enter an username! It is used as a unique customer id!
    </div>
    <div ng-show="registerForm.username.$error.minlength">
        Username should be at least 5 characters long!
    </div>
    <br>

    <label for="email">Email:</label>
    <input type="email" id="email" name="email" ng-model="formData.email" required>
    <div ng-show="registerForm.email.$touched && registerForm.email.$error.required">
        Email is required... How are we gonna span you then?
    </div>
    <div ng-show="registerForm.email.$error.email">
        Please enter a valid email!
    </div>
    <br>

    <label for="password">Password:</label>
    <input type="password" id="password" name="password" ng-model="formData.password"
           ng-pattern="/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[!@#\$%\^&\*])(?=.{5,})/" required>
    <div ng-show="registerForm.password.$touched && registerForm.password.$error.required">
        Password is required!
    </div>
    <div ng-show="registerForm.password.$error.pattern">
        Password should be at least 5 characters long and must contain at least one uppercase letter, one special character, and one number.
    </div>
    <br>

    <input type="submit" value="Submit" ng-disabled="registerForm.$invalid">
</form>

<script>
    var app = angular.module("registerApp", []);
    app.controller("registerController", function ($scope) {
        $scope.formData = {};
    });
</script>

</body>

</html>
