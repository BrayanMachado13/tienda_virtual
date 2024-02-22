<?php
session_start();
require_once '../Modelo/conexion.php';
require_once '../Modelo/modelo_registro_usuario.php';
require_once '../Modelo/password_hasher.php';

$conexion = Conexion::obtenerConexion();
$passwordHasher = new PasswordHasher();
$modelo = new ModeloRegistroUsuario($conexion, $passwordHasher);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $idUsuario = $modelo->insertarUsuario($email, $password);

    // Almacena el idUsuario en una sesión
    $_SESSION['idUsuario'] = $idUsuario;

    // Cerrar la conexión
    $conexion->close();

    // Redirigir o mostrar un mensaje de éxito
    header("Location: ../Vista/registro_cliente.php");
    exit();
}
?>
