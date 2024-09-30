<?php

session_start();

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['username']) || !isset($_SESSION['csrf_token'])) {
    header("Location: ../index.php"); // Redirigir si no está autenticado
    exit();
}

// Regenerar el ID de sesión para prevenir ataques de fijación de sesión
session_regenerate_id(true);

// Obtener el nombre del usuario desde la sesión
$usuario = htmlspecialchars($_SESSION['username'], ENT_QUOTES, 'UTF-8');

// Generar un token CSRF
$csrf_token = bin2hex(random_bytes(32));
$_SESSION['csrf_token'] = $csrf_token;

// Cabeceras de seguridad
header("X-Content-Type-Options: nosniff");
header("X-XSS-Protection: 1; mode=block");
header("X-Frame-Options: SAMEORIGIN");

//SEGURIDAD//
//header("Content-Security-Policy: default-src 'self'; connect-src 'self' https://api.openweathermap.org; script-src 'self' https://cdnjs.cloudflare.com https://code.jquery.com https://cdn.jsdelivr.net; style-src 'self' https://fonts.googleapis.com; font-src 'self' https://fonts.gstatic.com;");

require '../controllers/climaController.php'; // Asegúrate de que esta línea apunta correctamente a tu controlador

echo "<script> alert('Bienvenido: $usuario'); </script>";
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

    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    
    <title>Clima</title>
</head>

<body>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
   <h1>Hola <?php echo $usuario; ?></h1>
    
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
                <input class="location-input" type="text" id="city" value="">  
                <div class="button-container">
                <button id="consultarBtn" onclick="consultarClima()">Consultar Clima</button>
                </div>
            </div>
            
        </div>
    </div>

    <script src="../js/geolocalización.js"></script>
    <script src="../js/clima.js"></script>


    <h2>Historial del Usuario</h2>
    <table id="miTabla" class="display">
        <thead>
            <tr>
                <th>Ciudad</th>
                <th>Temperatura</th>
                <th>Descripción del Clima</th>
                <th>Fecha de la Consulta</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($ciudades)): ?>
                <?php foreach ($ciudades as $ciudad): ?>
                    <tr>
                       
                        <td><?php echo htmlspecialchars($ciudad['ciudad'], ENT_QUOTES, 'UTF-8'); ?></td>
                        <td><?php echo htmlspecialchars($ciudad['temperatura'], ENT_QUOTES, 'UTF-8'); ?> °C</td>
                        <td><?php echo htmlspecialchars($ciudad['descripcion_clima'], ENT_QUOTES, 'UTF-8'); ?></td>
                        <td><?php echo htmlspecialchars($ciudad['fecha_hora'], ENT_QUOTES, 'UTF-8'); ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="5">No hay ciudades asociadas a este usuario.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <script>
        $(document).ready(function() {
            $('#miTabla').DataTable({
                searching: true, // Activa la barra de búsqueda
            });
        });
    </script>
    
</body>
</html>
