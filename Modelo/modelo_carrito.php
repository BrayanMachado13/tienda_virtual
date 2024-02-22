<?php

require_once '../interfaces/CarritoModeloInterface.php';

class CarritoModelo implements CarritoModeloInterface {
    private $conexion;

    public function __construct($conexion) {
        $this->conexion = $conexion;
    }

    public function obtenerCarrito($usuario_id) {
        $query_carrito = "SELECT c.id AS carrito_id, a.* FROM carrito c
                        INNER JOIN products a ON c.articulo_id = a.id
                        WHERE c.usuario_id = '$usuario_id'";
        $result_carrito = $this->conexion->query($query_carrito);

        return $result_carrito;
    }

    public function eliminarProducto($producto_id, $usuario_id) {
        $query = "DELETE FROM carrito WHERE articulo_id = '$producto_id' AND usuario_id = '$usuario_id'";
        mysqli_query($this->conexion, $query);
    }
}
?>
