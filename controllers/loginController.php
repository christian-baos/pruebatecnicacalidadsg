<?php
require '../conexión.php';
session_start();

// Asegúrate de que la sesión sea segura
session_regenerate_id(true); // Regenerar ID de sesión para evitar secuestro de sesión

if (isset($_POST['correo']) && isset($_POST['password'])) {
    // Sanitizar y validar entradas
    $correo = filter_var(trim($_POST['correo']), FILTER_SANITIZE_EMAIL);
    $password = $_POST['password'];
    

    // Uso de declaraciones preparadas para evitar inyección SQL
    if ($consulta = mysqli_prepare($conexion, "SELECT id_usuario,nombre,correo_electronico,password FROM usuario WHERE correo_electronico = ?")) {
        mysqli_stmt_bind_param($consulta, "s", $correo); // 's' indica que el parámetro es una cadena
        mysqli_stmt_execute($consulta);
        $resultado = mysqli_stmt_get_result($consulta);

        // Verificar si se encontró el usuario
        if ($resultado && mysqli_num_rows($resultado) > 0) {

            
            $usuario = mysqli_fetch_assoc($resultado);

            



            // Verificar la contraseña
            if (password_verify($password, $usuario['password'])) {
                // Almacenar información del usuario en la sesión
                $_SESSION['username'] = $correo;
                $_SESSION['id_usuario'] = $usuario['id_usuario'];
                
                header("Location: ../views/clima.php");
                exit();
            } else {
                // Si la contraseña es incorrecta
                echo '<script> 
                        alert("Credenciales incorrectas. Por favor, inténtalo de nuevo.");
                        window.location = "../index.php";
                      </script>';
            }
        } else {
            // Si el usuario no se encuentra
            echo '<script> 
                    alert("Credenciales incorrectas. Por favor, inténtalo de nuevo.");
                    window.location = "../index.php";
                  </script>';
        }

        mysqli_stmt_close($consulta); // Cerrar la declaración
    } else {
        // Error en la consulta
        error_log("Error en la consulta: " . mysqli_error($conexion));
        echo '<script> 
                alert("Ocurrió un error. Inténtalo más tarde.");
                window.location = "../index.php";
              </script>';
    }
}

// Cerrar la conexión
mysqli_close($conexion);
?>
