<?php

class Usuario {
    public static function obtenerNombreCliente($usuario_id) {
        $conexion = Conexion::obtenerConexion();
        $query_info_cliente = "SELECT c.nombre AS nombre_cliente
                               FROM clientes c
                               INNER JOIN usuarios u ON c.usuario_id = u.id
                               WHERE u.id = ?";

        $stmt = $conexion->prepare($query_info_cliente);
        $stmt->bind_param("i", $usuario_id);
        $stmt->execute();
        $result_info_cliente = $stmt->get_result();

        if ($result_info_cliente->num_rows > 0) {
            $fila_info_cliente = $result_info_cliente->fetch_assoc();
            return $fila_info_cliente['nombre_cliente'];
        }

        $stmt->close();
        return '';
    }
}

?>