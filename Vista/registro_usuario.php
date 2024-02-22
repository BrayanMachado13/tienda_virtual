<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/styles_registro_usuarios.css">
    <title>Registrarse</title>
    <style>
    </style>
</head>
<body>
    <form action="../Controlador/controlador_registro_usuario.php" method="post">
        <h2>Registrarse</h2>

        <label for="email">Correo Electrónico:</label>
        <input type="email" id="email" name="email" required>

        <label for="password">Contraseña:</label>
        <input type="password" name="password" required>

        <button type="submit">Siguiente</button>
    </form>
</body>
</html>
