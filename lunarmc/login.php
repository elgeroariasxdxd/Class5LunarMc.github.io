
<?php

// Mostrar errores durante el desarrollo
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

require_once 'config.php';

// Comprobar que las variables necesarias existan
if (
    !defined('DB_HOST') ||
    !defined('DB_USER') ||
    !defined('DB_PASS') ||
    !defined('DB_NAME')
) {
    die(
        'Error: faltan las variables de conexión a la base de datos. '
        . 'Revisá tu archivo .env.'
    );
}

$mensaje = '';
$tipo_mensaje = '';

$nick = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $nick = trim($_POST['nick'] ?? '');
    $password = $_POST['password'] ?? '';

    if ($nick === '' || $password === '') {

        $mensaje = 'Completá todos los campos.';
        $tipo_mensaje = 'error';

    } else {

        // Conexión con MySQL
        $conexion = new mysqli(
            DB_HOST,
            DB_USER,
            DB_PASS,
            DB_NAME
        );

        if ($conexion->connect_error) {
            die(
                'Error de conexión con la base de datos: '
                . htmlspecialchars(
                    $conexion->connect_error,
                    ENT_QUOTES,
                    'UTF-8'
                )
            );
        }

        $conexion->set_charset('utf8mb4');

        // Buscar al usuario por nick
        $sql = "
            SELECT
                id,
                nick,
                email,
                password,
                gender,
                fecha_registro
            FROM usuarios
            WHERE nick = ?
            LIMIT 1
        ";

        $stmt = $conexion->prepare($sql);

        if (!$stmt) {
            die(
                'Error al preparar la consulta: '
                . htmlspecialchars(
                    $conexion->error,
                    ENT_QUOTES,
                    'UTF-8'
                )
            );
        }

        $stmt->bind_param('s', $nick);

        if (!$stmt->execute()) {
            die(
                'Error al ejecutar la consulta: '
                . htmlspecialchars(
                    $stmt->error,
                    ENT_QUOTES,
                    'UTF-8'
                )
            );
        }

        $resultado = $stmt->get_result();

        if ($resultado->num_rows === 1) {

            $usuario = $resultado->fetch_assoc();

            // Comprobar contraseña
            if (password_verify($password, $usuario['password'])) {

                // Regenerar sesión por seguridad
                session_regenerate_id(true);

                // Guardar datos del usuario
                $_SESSION['usuario_id'] = $usuario['id'];
                $_SESSION['nick'] = $usuario['nick'];
                $_SESSION['email'] = $usuario['email'];
                $_SESSION['gender'] = $usuario['gender'];

                // Ir al panel
                header('Location: panel.php');
                exit;

            } else {

                $mensaje = 'Nick o contraseña incorrectos.';
                $tipo_mensaje = 'error';
            }

        } else {

            $mensaje = 'Nick o contraseña incorrectos.';
            $tipo_mensaje = 'error';
        }

        $stmt->close();
        $conexion->close();
    }
}

?>

<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Iniciar sesión - LunarMC</title>

    <link rel="stylesheet" href="index-.css">

</head>

<body class="dark-mode">

    <main class="login-container">

        <section class="login-box">

            <h1>Iniciar sesión</h1>

            <p>
                Ingresá a tu cuenta de LunarMC.
            </p>

            <?php if ($mensaje !== ''): ?>

                <div class="login-message <?php echo htmlspecialchars(
                    $tipo_mensaje,
                    ENT_QUOTES,
                    'UTF-8'
                ); ?>">

                    <?php echo htmlspecialchars(
                        $mensaje,
                        ENT_QUOTES,
                        'UTF-8'
                    ); ?>

                </div>

            <?php endif; ?>

            <form method="POST" action="login.php">

                <div class="form-group">

                    <label for="nick">
                        Nick de Minecraft
                    </label>

                    <input
                        type="text"
                        id="nick"
                        name="nick"
                        maxlength="50"
                        required
                        autocomplete="username"
                        value="<?php echo htmlspecialchars(
                            $nick,
                            ENT_QUOTES,
                            'UTF-8'
                        ); ?>"
                    >

                </div>

                <div class="form-group">

                    <label for="password">
                        Contraseña
                    </label>

                    <input
                        type="password"
                        id="password"
                        name="password"
                        required
                        autocomplete="current-password"
                    >

                </div>

                <button type="submit">
                    Iniciar sesión
                </button>

            </form>

            <p>

                ¿Todavía no tenés una cuenta?

                <a href="registro.php">
                    Registrate
                </a>

            </p>

            <p>

                <a href="index.php">
                    Volver al inicio
                </a>

            </p>

        </section>

    </main>

</body>

</html>

