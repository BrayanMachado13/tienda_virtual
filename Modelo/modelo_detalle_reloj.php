<?php
class DetalleRelojModelo {
    private $conexion;

    public function __construct($conexion) {
        $this->conexion = $conexion;
    }

    public function obtenerDetallesReloj($id_reloj) {
        $consulta = "SELECT * FROM products WHERE id = ?";
        $consulta_preparada = $this->conexion->prepare($consulta);

        if (!$consulta_preparada) {
            die("Error en la preparación de la consulta: " . $this->conexion->error);
        }

        $consulta_preparada->bind_param("i", $id_reloj);
        $consulta_preparada->execute();

        $resultado = $consulta_preparada->get_result();
        $detalles = [];

        if ($resultado->num_rows > 0) {
            while ($fila = $resultado->fetch_assoc()) {
                $detalles['title'] = $fila['title'];
                $detalles['description'] = $fila['description'];
                $detalles['price'] = $fila['price'];
                $detalles['image_url'] = $fila['image_url'];
                $detalles['id'] = $fila['id']; // Agrega la ruta de la imagen
            }
        }

        $consulta_preparada->close();

        return $detalles;
    }
}
?>
