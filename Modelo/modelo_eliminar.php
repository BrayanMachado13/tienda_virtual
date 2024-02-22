<?php
require_once 'conexion.php';

$conexion = Conexion::obtenerConexion();

// Verifica si se ha enviado el ID del producto y el ID del usuario
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["id"]) && isset($_GET["usuario"])) {
    $id = $_GET["id"];
    $id_usuario = $_GET["usuario"];

    // Obtener información del producto a eliminar
    $sql_select = "SELECT * FROM products WHERE id = $id";
    $result = $conexion->query($sql_select);

    if ($result->num_rows == 1) {
        $producto = $result->fetch_assoc();

        // Insertar el producto eliminado en la tabla productos_eliminados
        $sql_insert = "INSERT INTO productos_eliminados (title, price, available_quantity, category_id, image_url, id_usuario)
                       VALUES ('{$producto["title"]}', '{$producto["price"]}', {$producto["available_quantity"]}, '{$producto["category_id"]}', '{$producto["image_url"]}', '$id_usuario')";
        if ($conexion->query($sql_insert) === TRUE) {
            // Eliminar el producto de la tabla products
            $sql_delete = "DELETE FROM products WHERE id = $id";
            if ($conexion->query($sql_delete) === TRUE) {
                // Redirigir a la página principal
                header("Location: ../Vista/crud.php");
                exit();
            } else {
                echo "Error al eliminar el producto: " . $conexion->error;
            }
        } else {
            echo "Error al mover el producto a la tabla de productos eliminados: " . $conexion->error;
        }
    } else {
        echo "Producto no encontrado";
    }
} else {
    echo "Parámetro ID o usuario no especificado";
}

$conexion->close();
?>
