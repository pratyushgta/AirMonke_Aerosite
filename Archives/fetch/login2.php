<?php
session_start();

require_once "database.php";

if (isset($_SESSION['user_id'])) {
    header("Location: homepage.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    $query = "SELECT * FROM user WHERE email = '$email'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        if (password_verify($password, $row['password'])) {
            $_SESSION['user_id'] = $row['uid'];
            $_SESSION['user_name'] = $row['name'];
            $_SESSION['user_email'] = $row['email'];
            $_SESSION['user_mobile'] = $row['mobile'];
            header("Location: homepage.php");
            exit;
        } else {
            echo '<script>alert("Incorrect Email or Password!!!")</script>';
        }
    } else {
        echo '<script>alert("Incorrect Email or Password!!!")</script>';
    }
}
?>