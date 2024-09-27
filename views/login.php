<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:400,700">
    <link rel="stylesheet" href="../css/login.css">
    <title>Login</title>
</head>

<body>

    <center>
        <div id="login">
            <form name="form-login" action="../controllers/loginController.php" method="POST">
                <h1>INICIAR SESIÓN</h1>
                <span class="fontawesome-user"></span>
                <input type="email" name="correo" id="" placeholder="Correo Electronico">
                <br> <br>
                <span class="fontawesome-lock"></span>
                <input type="password" name="password" id="" placeholder="Contraseña">
                <br> <br>
                <button type="submit" value="login">Ingresar</button>
            </form>
            <form action="usuario.php">
                <button id="registro"type="submit">Registrarse</button>
            </form>
        </div>
    </center>

</body>

</html>