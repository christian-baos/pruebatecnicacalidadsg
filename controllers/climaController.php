<?php
require '../conexión.php';

//session_start();

if (!isset($_SESSION['id_usuario'])) {
    header("Location: ../views/clima.php"); // Redirigir al login si no está logueado
    exit();
}

if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}

$id_usuario = $_SESSION['id_usuario'];

$union = "SELECT ciudad.ciudad, ciudad.temperatura, ciudad.descripcion_clima, ciudad.fecha_hora
FROM ciudad
INNER JOIN usuario ON ciudad.id_usuario = usuario.id_usuario 
WHERE ciudad.id_usuario = $id_usuario";

$resultado = $conexion->query($union);

$ciudades = []; // Array para almacenar los datos
if ($resultado->num_rows > 0) {
    while ($fila = $resultado->fetch_assoc()) {
        $ciudades[] = $fila; // Almacenar los datos en el array
        
    }
}

$conexion->close();