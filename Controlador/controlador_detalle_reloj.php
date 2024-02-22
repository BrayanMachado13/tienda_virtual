<?php
require_once '../Modelo/conexion.php';
require_once '../Modelo/modelo_detalle_reloj.php';

// Obtener la conexión
$conexion = Conexion::obtenerConexion();

// Crear una instancia del modelo
$modeloDetalleReloj = new DetalleRelojModelo($conexion);

// Recuperar el ID del reloj desde la URL
$id_reloj = $_GET['id_reloj'];

// Llamar a la función del modelo para obtener detalles del reloj
$modeloDetalleReloj->obtenerDetallesReloj($id_reloj);

// Cerrar la conexión
$conexion->close();
?>
