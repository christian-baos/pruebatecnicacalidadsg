<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:400,700">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="./css/login.css">
    <title>Login</title>
    <script>
        // Ejemplo de validación simple en el lado del cliente
        function validateForm() {
            let email = document.forms["form-login"]["correo"].value;
            let password = document.forms["form-login"]["password"].value;
            if (!email || !password) {
                alert("Por favor, completa todos los campos.");
                return false;
            }
            return true;
        }
    </script>
</head>

<body>
    <center>
        <div id="login">
            <form name="form-login" action="./controllers/loginController.php" method="POST" onsubmit="return validateForm();">
                <h1>INICIAR SESIÓN</h1>
                <span class="fa fa-user"></span>
                <input type="email" name="correo" placeholder="&#128273; Ingresar usuario" required autocomplete="username">
                <br><br>
                <span class="fa fa-lock"></span>
                <input type="password" name="password" placeholder="&#128274; Ingresar contraseña" required autocomplete="current-password">
                <br><br>
                <button type="submit">Ingresar</button>
            </form>
            <form action="views/usuario.php">
                <button id="registro" type="submit">Registrarse</button>
            </form>
        </div>
    </center>
</body>

</html>
