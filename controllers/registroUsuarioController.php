<?php
require '../conexión.php';
session_start();

if(isset($_POST["submit"])){
    $nombre= $_POST["nombre"];
    $apellido= $_POST["apellido"];
    $edad= $_POST["edad"];
    $correo_electronico= $_POST["correo_electronico"];
    $password=$_POST["password"];

    $query = "INSERT INTO usuario VALUES('','$nombre','$apellido','$edad','$correo_electronico','$password')";

    mysqli_query($conexion, $query);
    echo"
    <script> alert('Usuario ingresado Exitosamente'); </script>
    ";

}