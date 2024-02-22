<?php
require_once '../../Modelo/conexion.php';

$conexion = Conexion::obtenerConexion();

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["id"])) {
    $id = $_GET["id"];
    $sql = "SELECT id, title, price, available_quantity, category_id, image_url FROM products WHERE id = $id";
    $result = $conexion->query($sql);

    if ($result->num_rows == 1) {
        $producto = $result->fetch_assoc();
    } else {
        echo "Producto no encontrado";
        exit();
    }
} else {
    echo "Parámetro ID no especificado";
    exit();
}

$conexion->close();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Producto</title>
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
        <h1>Editar Producto</h1>
        <form action="../../Modelo/modelo_editar.php" method="POST">
            <input type="hidden" name="id" value="<?php echo $producto["id"]; ?>">
            <div class="form-group">
                <label for="title">Nombre:</label>
                <input type="text" class="form-control" id="title" name="title" value="<?php echo $producto["title"]; ?>" required>
            </div>
            <div class="form-group">
                <label for="price">Precio:</label>
                <input type="number" class="form-control" id="price" name="price" step="0.01"value="<?php echo $producto["price"]; ?>" required>
            </div>
            <div class="form-group">
                <label for="available_quantity">Stock:</label>
                <input type="number" class="form-control" id="available_quantity" name="available_quantity" value="<?php echo $producto["available_quantity"]; ?>" required>
            </div>
            <div class="form-group">
                <label for="category_id">Categoria:</label>
                <input type="text" class="form-control" id="category_id" name="category_id" value="<?php echo $producto["category_id"]; ?>" required>
            </div>
            <div class="form-group">
                <label for="image_url">Imagen:</label>
                <br>
                <img src="<?php echo $producto["image_url"]; ?>" alt="Imagen del producto" style="max-width: 200px; max-height: 200px;">
            </div>
            <button type="submit" class="btn btn-primary">Editar</button>
            <a href="../crud.php" class="btn btn-secondary">Atras</a>
        </form>
    </div>

    <br><br><br>
</body>
</html>
