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
            echo "<p>Uh oh! Looks like you're not registered with us...<p>";
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
<style>
    body{
        background-image: url("bglog.png");
        background-size: 100%;
        background-blend-mode: lighten;
    }
    .log1{
        height: 300px;
        width: 380px;
        background-color: bisque;
        border-style: double;
        border-color: blue;
        margin-top: 150px;
        margin-left: 150px;
        margin-right: 30px;
        padding-top: 50px;
        text-align: center;
        font-family: Impact, Haettenschweiler, 'Arial Narrow Bold', sans-serif;
        font-style: italic;
    }
    .head1{
        background-color: orange;
        border-color: blue;
        border-style: double;
        
    }
    .ht1{
        margin-left: 700px;
        height: 75px;
        
    }
    .line1{
        font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
        font-style: italic;
        font-size: 50px;
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
    
 
</style>

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
<table style="width: 100%;">
    <tr>
        <td>
            <form class="log1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" name="loginForm">
                <h1>LOGIN</h1>
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required ng-model="username">
                <br>
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required ng-model="password">
                <br>
                <input type="submit" value="Submit" ng-disabled="!loginForm.$valid || !username || !password">
            </form>
        </td>
        <td>
            <p class="line1"><b>WELCOME TO THE WORLDS BEST AIRLINES</b></p>
        </td>
    </tr> 
</table>


<script>
    function validateLoginForm() {
        //Redundant. Replaced with AngularJS.
        return true;
    }
</script>

</body>


</html>
