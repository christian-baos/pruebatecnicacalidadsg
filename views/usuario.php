<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:400,700">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../css/usuario.css">
    <title>Registro de Usuario</title>
</head>

<body>
    <div class="container">
        <div class="center">
            <h1>Registro</h1>
            <form action="../controllers/registroUsuarioController.php" method="POST" autocomplete="off">
                <div class="txt_field">
                    <input type="text" name="nombre" required autocomplete="given-name" value="" aria-label="Nombre">
                    <span></span>
                    <label for="nombre">Nombre</label>
                </div>
                <div class="txt_field">
                    <input type="text" name="apellido" required autocomplete="family-name" value="" aria-label="Apellido">
                    <span></span>
                    <label for="apellido">Apellido</label>
                </div>
                <div class="txt_field">
                    <input type="number" name="edad" required min="1" value="" aria-label="Edad">
                    <span></span>
                    <label for="edad">Edad</label>
                </div>
                <div class="txt_field">
                    <input type="email" name="correo_electronico" required autocomplete="email" value="" aria-label="Correo Electrónico">
                    <span></span>
                    <label for="correo_electronico">Correo Electrónico</label>
                </div>
                <div class="txt_field">
                    <input type="password" name="password" required autocomplete="new-password" value="" aria-label="Contraseña">
                    <span></span>
                    <label for="password">Contraseña</label>
                </div>

                <button type="submit" name="submit">Registrarse</button>
            </form>
            <br>
            <a id="volver" href="../index.php"><button type="button">Volver</button></a>
        </div>
    </div>
</body>

</html>