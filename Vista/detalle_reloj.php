<?php
require_once '../Modelo/conexion.php'; 
require_once '../Modelo/modelo_detalle_reloj.php';
require_once '../Modelo/usuarios.php';
require_once '../Controlador/controlador_compra_carrito.php';
require_once '../Controlador/controlador_cerrar_sesion.php';

$tuConexion = Conexion::obtenerConexion();
$detalleRelojModelo = new DetalleRelojModelo($tuConexion);
$id_reloj = $_GET['id_reloj'];
$detalles = $detalleRelojModelo->obtenerDetallesReloj($id_reloj);

// Verifica si se ha enviado el formulario de cerrar sesión
if (isset($_POST['cerrar_sesion'])) {
    // Crea una instancia del controlador de sesión y cierra la sesión
    $sesionController = new controllerCerrar();
    $sesionController->cerrarSesion();
    
    // Redirige al usuario a la página de inicio o a donde desees después de cerrar sesión
    header("Location: articulos_relojes.php"); // Ajusta la ruta según tu estructura
    exit();
}


?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/styles_detalle_reloj.css">
    <title>Detalle del Reloj</title>
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
    <h1>Detalle Reloj</h1>
    </header>

    <nav>
    <a href="articulos_relojes.php">Productos</a>
    <a href="#">Contacto</a>
    <a href="carrito.php" class="carrito"><i class="bi bi-cart-check"></i></a>
    </nav>

    <?php
    // Mostrar la alerta si se ha agregado un artículo
    if (isset($_SESSION['articulo_agregado']) && $_SESSION['articulo_agregado']) {
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                Artículo añadido al carrito. ¡Listo para comprar!
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
              </div>';

        // Reinicia la variable de sesión después de mostrar la alerta
        $_SESSION['articulo_agregado'] = false;
    }
    ?>

    <br><br>

    <div class="centered-card">
    <div class="card mb-3" style="max-width: 540px;">
    <div class="row g-0">
        <div class="col-md-4">
        <img src="<?php echo $detalles['image_url']; ?>" class="img-fluid rounded-start" alt="...">
        </div>
        <div class="col-md-8">
        <div class="card-body">
            <h5 class="card-title"><?php echo $detalles['title']; ?></h5>
            <p class="card-text"><?php echo $detalles['description']; ?></p>
            <p class="card-text"><small class="text-body-secondary"><?php echo $detalles['price']; ?></small></p>
            <form method='post' action='articulos_relojes.php'>
            <input type='hidden' name='producto_id' value=<?php echo $detalles['id']; ?>>
            <button type='submit' name='agregar_carrito'>Agregar al Carrito</button>
            </form>
        </div>
        </div>
    </div>
    </div>
    </div>

    <br><br><br><br><br>
    <footer>
        <p>&copy; 2024 Tienda de Relojes. Todos los derechos reservados.</p>
    </footer>
</body>
</html>
