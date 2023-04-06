<?php
session_start();

if (isset($_SESSION['username']) == "") {
    header("Location: homepage.php");
}

if (isset($_POST['logout'])) {
    session_unset();
    session_destroy();
    header("Location: homepage.php");
    exit();
}

require_once "database.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $pnr = $_POST["pnr"];

    if ($email && $pnr) {
        $query = "SELECT t.pnr, t.pax_id, p.name, p.gender, p.dob, p.mob_no, t.flight_no, t.class, t.dot, t.tot_fare
                  FROM ticket t
                  INNER JOIN pax p ON t.pax_id = p.pax_id
                  WHERE t.pnr = '$pnr'
                  AND p.email = '$email'";

        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) > 0) {
            // Display the ticket details in a new webapge
            $row = mysqli_fetch_assoc($result);
            $_SESSION["ticket_details"] = $row;
            header("Location: ticket_details.php");
            exit;
        } else {
            // PNR does not exist in the database
            echo "PNR does not exist in the database or email id does not match with given PNR.";
        }
    } else {
        // PNR or email not provided
        echo "Please provide both PNR and email.";
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
    <title>AirMonke-Manage</title>
    <link rel="airline-logo.jpg" type="image/x-icon" href="favicon.ico" />
    <script src="angular.min.js"></script>
    <style>
        body {
            background-color: #f2f2f2;
            font-family: Arial, sans-serif;
        }
        
        h1 {
            color: #4CAF50;
            text-align: center;
        }
        
        form {
            margin: auto;
            width: 50%;
            border: 3px solid #f2f2f2;
            padding: 10px;
        }
        
        input[type=text], input[type=email], input[type=submit] {
            width: 100%;
            padding: 12px;
            margin: 8px 0;
            display: inline-block;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
        
        input[type=submit] {
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
        }
        
        input[type=submit]:hover {
            background-color: #45a049;
        }
        
        label {
            display: block;
            font-weight: bold;
            margin-bottom: 10px;
        }
        
        span {
            color: red;
            font-weight: bold;
        }
        .a1{
        height: 200px;
        width: 300px;
        background-color: bisque;
        margin-top: 150px;
        margin-left: 600px;
        margin-right: 500px;
        border-style: double;
        border-color: blue;
        text-align: center;
        padding-top: 60px;
        opacity: 80%;
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
    </style>
</head>

<body ng-app="">
   <header class="head1">
        <table class="ht1">
            <tr>
                <td style="text-align: left;width: 25%;"><button class="back1">BACK</button></td>
                <td style="text-align: center; width: 50%;"><img src="AIRMONKE1-removebg-preview.png" alt="" style="height: 100px;"></td>
                <td style="text-align: right;width: 25%;"><button class="myac1"><a href="dashboard.php">MY ACCOUNT</a></button></td>
            </tr>
        
        </table>
    </header>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" name="manageForm">
    <label for="pnr">PNR:</label>
    <input type="text" id="pnr" name="pnr" required ng-model="pnr">
    <br>
    <label for="email">Email:</label>
    <input type="email" id="email" name="email" required ng-model="email">
    <br>
    <input type="submit" value="Submit" ng-disabled="!manageForm.$valid || !pnr || !email">
</form>

<script>
    function validateLoginForm() {
        //Redundant. Replaced with AngularJS.
        return true;
    }
</script>

</body>


</html>