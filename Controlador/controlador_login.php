<?php

require_once '../modelo/modelo_login.php';

class SesionController {
    private $modelo;

    public function __construct($modelo) {
        $this->modelo = $modelo;
    }

    public function procesarInicioSesion($nombreUsuario, $contrasena) {
        // Obtener el usuario por nombre de usuario
        $usuarioBD = $this->modelo->obtenerUsuarioPorNombre($nombreUsuario);

        if ($usuarioBD && password_verify($contrasena, $usuarioBD['password'])) {
            // Iniciar la sesión y redirigir al usuario
            session_start();
            $_SESSION['usuario_id'] = $usuarioBD['id'];
            $_SESSION['usuario_nombre'] = $usuarioBD['usuario'];
            header("Location: ../Vista/articulos_relojes.php");
            exit();
        } else {
            // Credenciales incorrectas, redirigir a la página de inicio de sesión con un mensaje de error
            header("Location: ../Vista/login.php?error=1");
            exit();
        }
    }
}
