<?php
require_once '../Modelo/conexion.php'; 
require_once 'controlador_login.php';
require_once '../Modelo/modelo_login.php'; 

// Crear instancia de la conexión
$conexion = Conexion::obtenerConexion();

// Crear instancias del modelo y controlador
$modelo = new UsuarioModelo($conexion);
$controlador = new SesionController($modelo);

// Procesar inicio de sesión
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombreUsuario = $_POST['username'];
    $contrasena = $_POST['password'];
    $controlador->procesarInicioSesion($nombreUsuario, $contrasena);
}

// Cerrar la conexión al final del script
if ($conexion) {
    mysqli_close($conexion);
}
?>
