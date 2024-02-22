<?php

interface CarritoModeloInterface {
    public function obtenerCarrito($usuario_id);
    public function eliminarProducto($producto_id, $usuario_id);
}
?>