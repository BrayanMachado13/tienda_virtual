<?php

require_once '../Modelo/modelo_compra.php';

class ComprasController {
    private $modelo;

    public function __construct($conexion) {
        $this->modelo = new ComprasModelo($conexion);
    }

    public function guardarCompra($usuario_id, $total) {
        $this->modelo->guardarCompra($usuario_id, $total);
    }
}

?>