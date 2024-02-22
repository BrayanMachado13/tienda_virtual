<?php

session_start();
require_once '../Modelo/conexion.php';
require_once '../Modelo/modelo_registro_cliente.php';
require_once '../interfaces/InterfazRegistro.php';

$conexion = Conexion::obtenerConexion();

if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

$modeloRegistroCliente = new ModeloRegistroCliente($conexion);

// Recibir datos del formulario
$cedula = $_POST['cedula'];
$nombre = $_POST['nombre'];
$apellido = $_POST['apellido'];
$direccion = $_POST['direccion'];
$email = $_POST['email'];
$telefono = $_POST['telefono'];

$idUsuario = (isset($_SESSION['idUsuario']) ? intval($_SESSION['idUsuario']) : 0);

// Utilizar la interfaz para registrar datos del cliente
$datosCliente = array(
    'cedula' => $cedula,
    'nombre' => $nombre,
    'apellido' => $apellido,
    'direccion' => $direccion,
    'email' => $email,
    'telefono' => $telefono,
    'idUsuario' => $idUsuario
);

$idClienteInsertado = $modeloRegistroCliente->registrar($datosCliente);

$conexion->close();

$_SESSION['registro_exitoso'] = true;
header("Location: ../Vista/login.php");
exit();

?>
