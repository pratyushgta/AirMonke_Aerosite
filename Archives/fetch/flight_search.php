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
    <?php
    session_start();

    // check if user is logged in
    if (isset($_SESSION['username'])) {
        // display username
        echo "Welcome " . $_SESSION['username'] . "!";
    } else {
        // redirect to login page
        header("Location: login.php");
    }
    ?>
    
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

