<?php

require_once '../Modelo/conexion.php';
require_once '../Modelo/usuarios.php';
require_once '../Controlador/controlador_compra_carrito.php';
require_once '../Controlador/controlador_cerrar_sesion.php';

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
  <link rel="stylesheet" href="../css/styles_inicio_relojes.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
  <title>Tienda de Relojes</title>
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
    <a href="crud.php">CRUD</a>
    <a href="productos_eliminados.php">Productos Elimidados</a>
    <a href="../Modelo/modelo_api_mercadolibre.php" class="carrito">cargar datos</a>
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


  <div class="product-container">

    <?php
  
    $conexion = Conexion::obtenerConexion();
    $sql = "SELECT * FROM products";
    $resultado = $conexion->query($sql);

    if ($resultado->num_rows > 0) {
      while ($fila = $resultado->fetch_assoc()) {


        echo '<article class="product-item">';
        echo '<a href="detalle_reloj.php?id_reloj=' . $fila['id'] . '" >';
        echo '<img src="' . $fila['image_url'] . '" alt="Reloj 2">';
        echo '</a>';
        echo '<h6 style="font-size:12px">' . $fila['title'] . '</h6>';
        echo '<p> Stock: ' . $fila['available_quantity'] . '</p>';
        echo '<p>Precio: $' . $fila['price'] . '</p>';
        echo "<form method='post' action='articulos_relojes.php'>";
        echo "<input type='hidden' name='producto_id' value='{$fila['id']}'>";
        echo "<button type='submit' name='agregar_carrito'>Agregar al Carrito</button>";
        echo "</form>";
        echo '</article>';


      }
    } else {
      echo 'No se encontraron relojes.';
    }

    $conexion->close();
    ?>
    
  </div>

  <footer>
    <p>&copy; 2024 Tienda de Telefonos. Todos los derechos reservados.</p>
  </footer>


    <!-- Scripts de Bootstrap -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>


</body>

</html>