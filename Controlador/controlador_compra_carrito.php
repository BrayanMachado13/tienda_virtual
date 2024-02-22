<?php
require_once '../Modelo/usuarios.php';
require_once '../Modelo/conexion.php';

session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['agregar_carrito'])) {
        if (!isset($_SESSION['usuario_id'])) {
            header("Location: login.php");
            exit();
        }

        $producto_id = $_POST['producto_id'];
        $usuario_id = $_SESSION['usuario_id'];
        $cantidad = 1;

        $conexion = Conexion::obtenerConexion();
        $query = "INSERT INTO carrito (articulo_id, usuario_id, cantidad) VALUES ('$producto_id', '$usuario_id', '$cantidad')";

        if ($conexion) {
            mysqli_query($conexion, $query);
            $_SESSION['articulo_agregado'] = true;
        } else {
            echo "Error de conexión a la base de datos.";
        }
    }
}
?>
