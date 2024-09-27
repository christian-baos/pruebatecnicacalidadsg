<?php
require '../conexión.php';
session_start();


$correo = $_POST['correo'];
$clave = $_POST['password'];


$query = "SELECT COUNT(*) as contar from usuario where correo_electronico = '$correo' AND password = '$clave'";

$consulta = mysqli_query($conexion, $query);
$array = mysqli_fetch_array($consulta);

if ($array['contar'] > 0) {

    $_SESSION['username'] = $correo;
    header("location: ../views/clima.php");

} else {
    echo "<script> alert('El Usuario no existe. Por favor ingresar nuevamente'); </script>";

}


?>