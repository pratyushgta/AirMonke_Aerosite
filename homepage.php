<?php
session_start();

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
    <title>AirMonke-Search</title>
    <link rel="airline-logo.jpg" type="image/x-icon" href="favicon.ico" />
</head>

<body>
    <h3 class="card-title">WELCOME
        <?php echo $_SESSION['f_name'] ?>
        !
    </h3>
    <h3 class="card-text">Email :
        <?php echo $_SESSION['email'] ?>
    </h3>

    <h1>Book Now!</h1>

    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="username">Username:</label>
        <input type="text" id="Origin" name="origin" required>
        <br>
        <input type="text" id="Destination" name="dest" required>
        <br>
        <input type="numerical" id="pax" name="pax" required>
        <br>
        <input type="date" id="dot" name="pax" required>
        <br>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>
        <br>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>
        <br>
        <input type="submit" value="Submit">
    </form>

    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <input type="submit" name="logout" value="Logout">
    </form>

</body>

</html>
