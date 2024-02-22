<?php

class ComprasModelo {
    private $conexion;

    public function __construct($conexion) {
        $this->conexion = $conexion;
    }

    public function guardarCompra($usuario_id, $total) {
        $consulta = "INSERT INTO compras (usuario_id, total) VALUES (?, ?)";
        $stmt = $this->conexion->prepare($consulta);
        $stmt->bind_param("id", $usuario_id, $total);
        $stmt->execute();
        $stmt->close();
    }
}

?>