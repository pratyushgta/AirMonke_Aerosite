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
<style>
    body{
        background-image: url("5387-airplane-porthole-window-overview-city-4k.jpg");
    }
    .a1{
        height: 300px;
        width: 700px;
        background-color: bisque;
        border-color: blue;
        border-style: double;
        margin-left: 200px;
        margin-right: 500px;
        margin-top: 200px;
        font-family: Impact, Haettenschweiler, 'Arial Narrow Bold', sans-serif;
        font-style: italic;
        text-align: center;
    }
    .f1{
        height: 50px;
        width: 100%;
        margin-bottom: 0px;
        margin-top: 300px;
        background-color: orange;
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
<body ng-app="">
    <header class="head1">
        <table class="ht1">
            <tr>
                <td><img src="AIRMONKE1-removebg-preview.png" alt="" style="height: 100px;"></td>
            </tr>
        </table>
    </header>
    <form class="a1" method="post" name="bookingForm">
        <h1>Your booking:</h1>
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
    <footer>
        <table class="f1">
            <tr>
                <td>AIRMONKE</td>
            </tr>
        </table>
    </footer>
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