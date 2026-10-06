
<?php

// Iniciar la sesión
session_start();

// Comprobar que el usuario haya iniciado sesión
if (!isset($_SESSION['usuario_id'])) {
    header('Location: login.php');
    exit;
}

// Datos del usuario guardados en la sesión
$nick = $_SESSION['nick'] ?? '';
$email = $_SESSION['email'] ?? '';
$gender = $_SESSION['gender'] ?? '';

?>

<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Mi cuenta - LunarMC</title>

    <link rel="stylesheet" href="index-.css">

</head>

<body class="dark-mode">

    <main class="panel-container">

        <section class="panel-box">

            <h1>
                👋 Bienvenido a LunarMC
            </h1>

            <p class="panel-welcome">
                Hola, <strong><?php echo htmlspecialchars($nick, ENT_QUOTES, 'UTF-8'); ?></strong>.
                Has iniciado sesión correctamente.
            </p>


            <div class="user-info">

                <h2>Información de tu cuenta</h2>

                <div class="user-info-row">

                    <span>Nick de Minecraft</span>

                    <strong>
                        <?php echo htmlspecialchars($nick, ENT_QUOTES, 'UTF-8'); ?>
                    </strong>

                </div>


                <div class="user-info-row">

                    <span>Email</span>

                    <strong>
                        <?php echo htmlspecialchars($email, ENT_QUOTES, 'UTF-8'); ?>
                    </strong>

                </div>


                <div class="user-info-row">

                    <span>Género</span>

                    <strong>
                        <?php echo htmlspecialchars($gender, ENT_QUOTES, 'UTF-8'); ?>
                    </strong>

                </div>

            </div>


            <div class="panel-actions">

                <a href="index.php" class="panel-btn panel-btn-home">
                    Volver al inicio
                </a>

                <a href="logout.php" class="panel-btn panel-btn-logout">
                    Cerrar sesión
                </a>

            </div>

        </section>

    </main>

</body>

</html>
