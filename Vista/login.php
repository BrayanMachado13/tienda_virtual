<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/styles_login_usuarios.css">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <title>Document</title>
</head>

<body>
    
    <?php
    require_once '../controlador/controlador_login.php';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $email = $_POST['username'];
        $contrasena = $_POST['password'];
    
        // Instancia de tu controlador
        $sesionController = new SesionController();
    
        // Llamada al método con los argumentos
        $sesionController->procesarInicioSesion($email, $contrasena);
    }
    ?>

    <?php
        // Recuperar el parámetro de la URL
    $errorInicioSesion = isset($_GET['error']) ? $_GET['error'] : '';

    // Mostrar mensaje según el parámetro
    if ($errorInicioSesion === '1') {
        echo '<p style="color: red;">Credenciales incorrectas. Inténtalo de nuevo.</p>';
    }
    ?>
    
    <?php
    session_start();
    // Verifica si hay una alerta de registro exitoso
    if (isset($_SESSION['registro_exitoso']) && $_SESSION['registro_exitoso']) {
        echo '<div class="alert alert-success" role="alert">
                Usuario registrado correctamente. ¡Bienvenido!
              </div>';

        // Reinicia la variable de sesión después de mostrar la alerta
        $_SESSION['registro_exitoso'] = false;
    }
    ?>

    <div class="login-container">
        <form action="../Controlador/controlador_procesar_inicio_sesion.php" method="post">
            <h2>Iniciar Sesión</h2>
            <label for="username">Usuario:</label>
            <input type="text" id="username" name="username" required>

            <label for="password">Contraseña:</label>
            <input type="password" id="password" name="password" required>

            <button type="submit">Iniciar Sesión</button>
            <p>¿No tienes una cuenta? <a href="registro_usuario.php">Registrarse</a></p>
        </form>
    </div>
</body>

</html>