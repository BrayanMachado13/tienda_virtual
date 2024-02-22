<?php
session_start();

require_once '../Modelo/usuarios.php';
require_once '../Controlador/controlador_cerrar_sesion.php';
require_once '../Modelo/conexion.php';

$conexion = Conexion::obtenerConexion();

$sql = "SELECT id, title, price, available_quantity, category_id, image_url FROM productos_eliminados";
$result = $conexion->query($sql);

$productos = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $productos[] = $row;
    }
}

// Verifica si se ha enviado el formulario de cerrar sesión
if (isset($_POST['cerrar_sesion'])) {
    // Crea una instancia del controlador de sesión y cierra la sesión
    $sesionController = new controllerCerrar();
    $sesionController->cerrarSesion();
    
    // Redirige al usuario a la página de inicio o a donde desees después de cerrar sesión
    header("Location: articulos_relojes.php"); 
    exit();
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Lista de Productos</title>
    <link rel="stylesheet" href="../css/styles_crud.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body>

<header>
      <nav class="inicio-sesion">
      <?php
        // Verifica si el usuario ha iniciado sesión antes de mostrar el enlace de cerrar sesión
        if (isset($_SESSION['usuario_id'])) {
          $nombreCliente = Usuario::obtenerNombreCliente($_SESSION['usuario_id']);

          echo '<p>Bienvenido, ' . $nombreCliente . '!</p>';
            echo '<form method="post" action="articulos_relojes.php">';
            echo '<button type="submit" name="cerrar_sesion">Cerrar Sesión</button>';
            echo '</form>';
        } else {
            echo '<a href="login.php">Iniciar Sesión</a>';
        }
        ?>
      </nav>
  </header>

  <header>
    <h1>Tienda de Relojes</h1>
  </header>

  <nav>
    <a href="articulos_relojes.php">Productos</a>
    <a href="#">Contacto</a>
  </nav>
  <br><br><br>
    <div class="container">
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Precio</th>
                    <th>Stock</th>
                    <th>Categoria</th>
                    <th>URL imagen</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($productos as $producto): ?>
                    <tr>
                        <td><?php echo $producto["id"]; ?></td>
                        <td><?php echo $producto["title"]; ?></td>
                        <td><?php echo $producto["price"]; ?></td>
                        <td><?php echo $producto["available_quantity"]; ?></td>
                        <td><?php echo $producto["category_id"]; ?></td>
                        <td><img src="<?php echo $producto["image_url"]; ?>" alt="Imagen del producto" style="max-width: 100px; max-height: 100px;"></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
