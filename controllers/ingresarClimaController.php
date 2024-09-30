<?php
require_once '../conexión.php'; // Usar require_once para evitar múltiples inclusiones

session_start();

// Verificar si el usuario está autenticado
if (!isset($_SESSION['id_usuario'])) {
    header("Location: ../views/clima.php");
    exit();
}

$id_usuario = $_SESSION['id_usuario'];


if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $ciudad = filter_input(INPUT_POST, 'ciudad', FILTER_SANITIZE_STRING);
    $temperatura = filter_input(INPUT_POST, 'temperatura', FILTER_VALIDATE_FLOAT);
    $descripcion_clima = filter_input(INPUT_POST, 'descripcion_clima', FILTER_SANITIZE_STRING);

    if ($ciudad && $temperatura !== false && $descripcion_clima) {
        $fecha_hora = date('Y-m-d H:i:s');

    
        $sql = "INSERT INTO ciudad (id_usuario, ciudad, temperatura, descripcion_clima, fecha_hora) VALUES (?, ?, ?, ?, ?)";
        if ($ejecutar = $datos->prepare($sql)) {

            $ejecutar->bind_param("issss", $id_usuario, $ciudad, $temperatura, $descripcion_clima, $fecha_hora);


            if ($ejecutar->execute()) {
                // Establecer el tipo de contenido a JSON
                header('Content-Type: application/json');
                echo json_encode(['status' => 'success', 'message' => 'Datos insertados correctamente']);
            } else {
                // Manejo de errores en la ejecución
                header('Content-Type: application/json');
                echo json_encode(['status' => 'error', 'message' => 'Error al insertar datos']);
            }
            $ejecutar->close(); // Cerrar la declaración
        } else {
            // Manejo de errores en la preparación
            header('Content-Type: application/json');
            echo json_encode(['status' => 'error', 'message' => 'Error al preparar la consulta']);
        }
    } else {
        // Datos no válidos
        header('Content-Type: application/json');
        echo json_encode(['status' => 'error', 'message' => 'Datos inválidos']);
    }
}

// Cerrar conexión a la base de datos
$datos->close();
?>
