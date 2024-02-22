<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmación de Compra</title>
    <link rel="stylesheet" href="styles.css"> <!-- Estilo CSS personalizado -->
</head>
<body>
    <div class="container">
        <h1>¡Compra exitosa!</h1>
        <p>Gracias por tu compra. Hemos recibido tu pago correctamente.</p>
        <p>Número de orden: <?php echo $numeroOrden; ?></p>
        <p>Total: $<?php echo $total; ?></p>
        <!-- Otros detalles de la compra -->
    </div>
</body>
</html>
