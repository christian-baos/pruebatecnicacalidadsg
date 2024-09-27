<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width" />
    <link rel="stylesheet" href="../css/usuario.css">
    <title>Registro de Usuario</title>
</head>

<body>
    <div class="container">
        <div class="center">
            <h1>Registro</h1>
            <form action="../controllers/registroUsuarioController.php" class="" method="POST" autocomplete="off">
                <div class="txt_field">
                    <input type="text" name="nombre" required value="">
                    <span></span>
                    <label>Nombre</label>
                </div>
                <div class="txt_field">
                    <input type="text" name="apellido" required value="">
                    <span></span>
                    <label>Apellido</label>
                </div>
                <div class="txt_field">
                    <input type="number" name="edad" required value="">
                    <span></span>
                    <label>Edad</label>
                </div>
                <div class="txt_field">
                    <input type="email" name="correo_electronico" required value="">
                    <span></span>
                    <label>Correo Electronico</label>
                </div>
                <div class="txt_field">
                    <input type="password" name="password" required value="">
                    <span></span>
                    <label>Password</label>
                </div>

                <button type="submit" name="submit">Registrarse</button>

            </form>
            <br>
            <a href="login.php"><button type="submit" name="submit">Volver</button></a>
        </div>
    </div>
</body>

</html>