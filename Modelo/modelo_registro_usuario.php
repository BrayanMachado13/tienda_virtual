<?php
//modelo_registro_usuario.php
require_once '../interfaces/modelo_registro_usuario_interface.php';
require_once 'password_hasher.php';

class ModeloRegistroUsuario implements ModeloRegistroUsuarioInterface {
    private $conexion;
    private $passwordHasher;

    public function __construct($conexion, PasswordHasherInterface $passwordHasher) {
        $this->conexion = $conexion;
        $this->passwordHasher = $passwordHasher;
    }

    public function insertarUsuario($email, $password) {
        $hashedPassword = $this->passwordHasher->hashPassword($password);

        $queryUsuario = "INSERT INTO usuarios (usuario, password) VALUES ('$email', '$hashedPassword')";
        $this->conexion->query($queryUsuario);
        return $this->conexion->insert_id;
    }
}
?>
