<?php

class CarritoController {
    private $modelo;

    public function __construct(CarritoModeloInterface $modelo) {
        $this->modelo = $modelo;
    }

    public function obtenerProductosCarrito($usuario_id) {
        return $this->modelo->obtenerCarrito($usuario_id);
    }

    public function eliminarProductoCarrito($producto_id, $usuario_id) {
        $this->modelo->eliminarProducto($producto_id, $usuario_id);
    }
}
?>
