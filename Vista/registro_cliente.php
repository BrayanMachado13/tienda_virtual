<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/styles_registro_clientes.css">
    <title>Registro de Cliente</title>
</head>
<body>
    <h2>Registro de Cliente</h2>
    <form action="../Controlador/controlador_registro_cliente.php" method="post">

        <label for="cedula">Cedula:</label>
        <input type="text" name="cedula" required>

        <label for="nombre">Nombres:</label>
        <input type="text" name="nombre" required>

        <label for="apellido">Apellidos:</label>
        <input type="text" name="apellido" required>

        <label for="direccion">Direccion:</label>
        <input type="text" name="direccion" required>

        <label for="email">Correo:</label>
        <input type="email" name="email" required>

        <label for="telefono">Telefono:</label>
        <input type="text" name="telefono" required>
        
        <input type="hidden" name="id_usuario" value="<?php echo $idUsuario; ?>">
        
        <button type="submit">Registrar Cliente</button>
    </form>
</body>
</html>
