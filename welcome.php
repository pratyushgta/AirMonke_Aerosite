<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="author" content="Pratyush">
    <meta name="author" content="Aadil">
    <meta name="author" content="Vidit">
    <title>Welcome to AirMonke</title>
    <link rel="airline-logo.jpg" type="image/x-icon" href="favicon.ico" />
</head>
<style>
    body{
        font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
        font-style: italic;
        background-color: aqua;
        background-image: url("bg1.png");
        background-position: center;
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
<body>
    <header class="head1">
        <table class="ht1">
            <tr>
                <td><img src="AIRMONKE1-removebg-preview.png" alt="" style="height: 100px;"></td>
            </tr>
        </table>
    </header>
    
    <div class="a1">
        <h1>Hello There!</h1>
        <form  action="" name="welcomeForm">
            <label for="Login">Returning User?</label>
            <a href="login.php" title="Login">Login!</a>
            <br>
            <br>
            <label for="Register">First Time?</label>
            <a href="signup.php" title="SignUp">Sign Up!</a>
        </form>
    </div>
</body>

</html>