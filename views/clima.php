<?php

session_start();
$usuario = $_SESSION['username'];


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:200,300,400,600,700">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans+Condensed:300">

    
    <link rel="stylesheet" href="../css/clima.css">
    <title>Clima</title>
</head>

<body>

    <div class="container">
        <div class="weather-side">
            <div class="weather-gradient"></div>
            <div class="date-container">
                <h2 class="date-dayname"></h2>
                <span class="date-day"></span>
                <i class="fa-solid fa-location-dot"></i>
                <span class="location"></span>
            </div>
            <div class="weather-container">
                <span class="weather-icon"></span>
                <h1 class="weather-temp"></h1>
                <h3 class="weather-desc"></h3>
            </div>
        </div>
        <div class="info-side">
            <div class="today-info-container">
                <div class="today-info">
                    <div class="humidity">
                        <span class="title"><i class="fa-solid fa-droplet"></i>Humedad</span>
                        <span class="value"></span>
                        <div class="clear"></div>
                    </div>
                    <div class="wind">
                        <span class="title"><i class="fa-solid fa-wind"></i> Viento</span>
                        <span class="value"></span>
                        <div class="clear"></div>
                    </div>
                </div>
            </div>
            <div class="week-container">
                <ul class="week-list">
                    <li>
                        <span class="day-name"></span>
                        <span class="day-temp"></span>
                        <span class="day-icon"></span>
                    </li>
                    <li>
                        <span class="day-name"></span>
                        <span class="day-temp"></span>
                        <span class="day-icon"></span>
                    </li>
                    <li>
                        <span class="day-name"></span>
                        <span class="day-temp"></span>
                        <span class="day-icon"></span>
                    </li>
                    <li>
                        <span class="day-name"></span>
                        <span class="day-temp"></span>
                        <span class="day-icon"></span>
                    </li>
                    <div class="clear"></div>
                </ul>
            </div>
            <div class="location-container">

                <input class="location-input" type="text" id="city" value="Cali">
            </div>
        </div>

    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="../js/clima.js"></script>

</body>

</html>
