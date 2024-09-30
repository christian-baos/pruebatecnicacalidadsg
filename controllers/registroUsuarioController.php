<?php
require '../conexión.php';
session_start();

if (isset($_POST["submit"])) {

    // Validación y sanitización de entradas
    $nombre = filter_var(trim($_POST["nombre"]), FILTER_SANITIZE_STRING);
    $apellido = filter_var(trim($_POST["apellido"]), FILTER_SANITIZE_STRING);
    $edad = filter_var(trim($_POST["edad"]), FILTER_VALIDATE_INT);
    $correo_electronico = filter_var(trim($_POST["correo_electronico"]), FILTER_SANITIZE_EMAIL);
    $password = $_POST["password"];

    // VALIDACIÓN DEL CORREO ELECTRONICO
    if (!filter_var($correo_electronico, FILTER_VALIDATE_EMAIL)) {
        die("Correo electrónico no válido.");
    }

    // Hashing de la contraseña
    $pass_fuerte = password_hash($password, PASSWORD_BCRYPT);

    // Preparar la consulta SQL
    if ($conexion === false) {
        die("No ha sido posible conectarse a la Base de datos. " . mysqli_connect_error());
    }

    // Usar declaraciones preparadas
    $ingresar = mysqli_prepare($conexion, "INSERT INTO usuario (nombre, apellido, edad, correo_electronico, password) VALUES (?, ?, ?, ?, ?)");
    mysqli_stmt_bind_param($ingresar, "ssiss", $nombre, $apellido, $edad, $correo_electronico, $pass_fuerte);

    // Ejecutar la consulta
    if (mysqli_stmt_execute($ingresar)) {
        echo '
        <script> 
            alert("Usuario ingresado Exitosamente"); 
            window.location = "../index.php";
        </script>
        ';
    } else {
        error_log("No se pudo ejecutar la consulta: " . mysqli_error($conexion)); // Log error
        echo "No se pudo ejecutar la consulta.";
    }

    // Cerrar la declaración y la conexión
    mysqli_stmt_close($ingresar);
    mysqli_close($conexion);
}
?>
