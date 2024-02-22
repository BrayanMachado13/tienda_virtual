<?php
require_once 'conexion.php';

$conexion = Conexion::obtenerConexion();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["id"];
    $nombre = $_POST["title"];
    $precio = $_POST["price"];
    $stock = $_POST["available_quantity"];
    $categoria = $_POST["category_id"];

    // Actualizar el producto en la base de datos
    $sql = "UPDATE products SET title = '$nombre', price = '$precio', available_quantity = '$stock' , category_id = '$categoria' WHERE id = $id";

    if ($conexion->query($sql) === TRUE) {
        // Redirigir a la página principal
        header("Location: ../Vista/crud.php");
        exit();
    } else {
        echo "Error al actualizar el producto: " . $conexion->error;
    }
}

$conexion->close();
?>
