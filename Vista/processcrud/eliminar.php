<?php
session_start();
require_once '../../Modelo/conexion.php';
require_once '../../Modelo/usuarios.php';
require_once '../../Controlador/controlador_cerrar_sesion.php';

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
    <title>Confirmar Eliminación</title>
    <link rel="stylesheet" href="../../css/styles_crud.css">
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
    <a href="#">Productos</a>
    <a href="#">Contacto</a>
  </nav>
  <br><br><br>
    <div class="container">
        <h1>Confirmar Eliminación</h1>
        <p>¿Estás seguro de que deseas eliminar este producto?</p>
        <a href="../../Modelo/modelo_eliminar.php?id=<?php echo $_GET["id"]; ?>&usuario=<?php echo $_SESSION["usuario_id"]; ?>" class="btn btn-danger">Eliminar</a>
        <a href="../crud.php" class="btn btn-secondary">Cancelar</a>
    </div>
</body>
</html>
