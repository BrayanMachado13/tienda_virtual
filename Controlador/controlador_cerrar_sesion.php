<?php
class controllerCerrar {
    public function cerrarSesion() {
        // Inicia la sesión si aún no está iniciada
        session_start();

        // Elimina todas las variables de sesión
        session_unset();

        // Destruye la sesión
        session_destroy();
    }
}
?>
