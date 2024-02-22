<?php
require_once '../../Modelo/conexion.php';

$conexion = Conexion::obtenerConexion();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["id"];
    $nombre = $_POST["title"];
    $precio = $_POST["price"];
    $stock = $_POST["available_quantity"];
    $categoria = $_POST["category_id"];
    $imagen = $_POST["image_url"];

    // Insertar el nuevo producto en la base de datos
    $sql = "INSERT INTO products (title, price, available_quantity, category_id, image_url) VALUES ('$nombre', '$precio','$stock', '$categoria', '$imagen')";

    if ($conexion->query($sql) === TRUE) {
        // Redirigir a la página principal
        header("Location: ../crud.php");
        exit();
    } else {
        echo "Error al agregar el producto: " . $conexion->error;
    }
}

$conexion->close();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Agregar Producto</title>
    <link rel="stylesheet" href="../../css/styles_crud.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body>

  <header>
    <h1>Tienda de Relojes</h1>
  </header>

  <nav>
    <a href="#">Productos</a>
    <a href="#">Contacto</a>
  </nav>
  <br><br><br>


    <div class="container">
        <h1>Agregar Producto</h1>
        <form action="" method="POST">
            <input type="hidden" name="id" value="<?php echo $producto["id"]; ?>">
            <div class="form-group">
                <label for="title">Nombre:</label>
                <input type="text" class="form-control" id="title" name="title" required>
            </div>
            <div class="form-group">
                <label for="price">Precio:</label>
                <input type="number" class="form-control" id="price" name="price" step="0.01" required>
            </div>
            <div class="form-group">
                <label for="available_quantity">Stock:</label>
                <input type="number" class="form-control" id="available_quantity" name="available_quantity">
            </div>
            <div class="form-group">
                <label for="category_id">Categoria:</label>
                <input type="text" class="form-control" id="category_id" name="category_id">
            </div>
            <div class="form-group">
                <label for="image_url">Imagen (URL):</label>
                <br>
                <input type="text" class="form-control" id="image_url" name="image_url" required>
            </div>
            <button type="submit" class="btn btn-primary">Crear</button>
            <a href="../crud.php" class="btn btn-secondary">Atras</a>
        </form>
    </div>
    <br><br><br>
</body>
</html>
