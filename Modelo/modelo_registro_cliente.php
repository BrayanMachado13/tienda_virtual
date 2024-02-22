<?php
require_once 'conexion.php';
require_once '../Interfaces/InterfazRegistro.php';

class ModeloRegistroCliente implements InterfazRegistro {

    private $conexion;

    public function __construct($conexion) {
        $this->conexion = $conexion;
    }

    public function insertarCliente($cedula, $nombre, $apellido, $direccion, $email, $telefono, $idUsuario) {
        $queryCliente = "INSERT INTO clientes (id, nombre, apellido, direccion, email, telefono, usuario_id) VALUES ('$cedula', '$nombre', '$apellido', '$direccion', '$email', '$telefono', '$idUsuario')";
        $this->conexion->query($queryCliente);

        return $idClienteInsertado; // Retornar el ID del cliente insertado si es necesario
    }

    public function registrar($datos) {
        return $this->insertarCliente($datos['cedula'], $datos['nombre'], $datos['apellido'], $datos['direccion'], $datos['email'], $datos['telefono'], $datos['idUsuario']);
    }
}

?>

