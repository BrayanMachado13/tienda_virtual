<?php

require_once '../Modelo/conexion.php';
require_once '../Controlador/controlador_compras_paypal.php';

// Obtener datos del formulario
$usuario_id = $_POST['usuario_id'];
$total = $_POST['total'];

// Crear instancia de la conexión
$conexion = Conexion::obtenerConexion();

// Crear instancia del controlador
$comprasController = new ComprasController($conexion);

// Llamar al método para guardar la compra
$comprasController->guardarCompra($usuario_id, $total);

// Cerrar la conexión
$conexion->close();

?>
