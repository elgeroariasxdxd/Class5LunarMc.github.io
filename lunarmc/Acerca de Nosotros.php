<?php
require_once __DIR__ . '/config.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// ==========================================================
// CLASE 5 - FORMULARIO POST DE CONTACTO
// Sanitización, validación, mensajes y persistencia de datos
// ==========================================================

if (!isset($_SESSION['csrf_token']) || !is_string($_SESSION['csrf_token']) || $_SESSION['csrf_token'] === '') {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

$nombre = '';
$email = '';
$sexo = '';
$pregunta = '';
$errores_contacto = [];
$mensaje_contacto = '';
$contacto_exitoso = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['formulario_contacto'])) {
    $nombre = trim((string) ($_POST['nombre'] ?? ''));
    $email = trim((string) ($_POST['email'] ?? ''));
    $sexo = trim((string) ($_POST['sexo'] ?? ''));
    $pregunta = trim((string) ($_POST['pregunta'] ?? ''));
    $csrf_recibido = (string) ($_POST['csrf_token'] ?? '');

    if ($csrf_recibido === '' || !hash_equals($_SESSION['csrf_token'], $csrf_recibido)) {
        $errores_contacto[] = 'La solicitud no es válida. Recargá la página e intentá nuevamente.';
    }

    if ($nombre === '') {
        $errores_contacto[] = 'El nombre es obligatorio.';
    } elseif (mb_strlen($nombre) < 2 || mb_strlen($nombre) > 80) {
        $errores_contacto[] = 'El nombre debe tener entre 2 y 80 caracteres.';
    }

    if ($email === '') {
        $errores_contacto[] = 'El correo electrónico es obligatorio.';
    } elseif (strlen($email) > 254 || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errores_contacto[] = 'Ingresá un correo electrónico válido.';
    }

    $sexos_permitidos = ['femenino', 'masculino', 'otro'];
    if ($sexo === '' || !in_array($sexo, $sexos_permitidos, true)) {
        $errores_contacto[] = 'Seleccioná una opción válida en el campo sexo.';
    }

    if ($pregunta === '') {
        $errores_contacto[] = 'La pregunta es obligatoria.';
    } elseif (mb_strlen($pregunta) < 10 || mb_strlen($pregunta) > 1000) {
        $errores_contacto[] = 'La pregunta debe tener entre 10 y 1000 caracteres.';
    }

    if (empty($errores_contacto)) {
        $contacto_exitoso = true;
        $mensaje_contacto = 'Tu consulta fue procesada correctamente. Gracias por contactar a LunarMC.';

        // Limpiar campos únicamente cuando el envío fue válido.
        $nombre = '';
        $email = '';
        $sexo = '';
        $pregunta = '';

        // Renovar token después de un envío correcto.
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
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

    <title>
        Acerca de Nosotros - <?php echo defined('APP_NAME') ? APP_NAME : 'LunarMC Network'; ?>
    </title>

    <link
        rel="stylesheet"
        href="index-.css"
    >

</head>


<body class="dark-mode">


<?php include __DIR__ . '/includes/header.php'; ?>


<!-- ==================================================
     CONTENIDO DE ACERCA DE NOSOTROS
     ================================================== -->

<div class="about-page">


    <!-- ================================================
         ENCABEZADO DE LA PÁGINA
         ================================================ -->

    <section class="about-hero">

        <div class="about-hero-line"></div>

        <span class="about-eyebrow">
            LUNARMC NETWORK
        </span>

        <h1 class="about-main-title">
            Acerca de Nosotros
        </h1>

        <p class="about-main-description">
            Conoce más sobre nuestra comunidad, nuestros servicios
            y los recursos disponibles para todos nuestros jugadores.
        </p>

    </section>


    <!-- ================================================
         RECURSOS DE INTERÉS
         ================================================ -->

    <section class="about-card about-resources">

        <div class="section-heading">

            <span class="section-icon">◆</span>

            <div>

                <h2 class="about-title">
                    Información de Interés
                </h2>

                <p class="section-subtitle">
                    Recursos oficiales de nuestra comunidad
                </p>

            </div>

        </div>


        <p class="about-text">

            Accede a los recursos oficiales sobre cursos,
            el currículum del creador, preguntas frecuentes
            y las novedades de nuestro blog.

        </p>


        <div class="about-links">

            <a
                href="Blog Pagina Web.php"
                class="about-link"
            >

                <span class="about-link-icon">
                    ▣
                </span>

                <span>

                    <strong>
                        Blog
                    </strong>

                    <small>
                        Novedades de la página
                    </small>

                </span>

                <span class="about-link-arrow">
                    →
                </span>

            </a>


            <a
                href="Curso.php"
                class="about-link"
            >

                <span class="about-link-icon">
                    ◆
                </span>

                <span>

                    <strong>
                        Cursos
                    </strong>

                    <small>
                        Aprende y mejora tus conocimientos
                    </small>

                </span>

                <span class="about-link-arrow">
                    →
                </span>

            </a>


            <a
                href="Curriculum Pag Web.php"
                class="about-link"
            >

                <span class="about-link-icon">
                    ▤
                </span>

                <span>

                    <strong>
                        Curriculum Vitae
                    </strong>

                    <small>
                        Información del creador
                    </small>

                </span>

                <span class="about-link-arrow">
                    →
                </span>

            </a>


            <a
                href="faq pagina web.php"
                class="about-link"
            >

                <span class="about-link-icon">
                    ?
                </span>

                <span>

                    <strong>
                        Preguntas Frecuentes
                    </strong>

                    <small>
                        Respuestas a las dudas más comunes
                    </small>

                </span>

                <span class="about-link-arrow">
                    →
                </span>

            </a>

        </div>

    </section>


    <!-- ================================================
         QUIÉNES SOMOS
         ================================================ -->

    <section class="about-card">

        <div class="section-heading">

            <span class="section-icon">
                ★
            </span>

            <div>

                <h2 class="about-title">
                    ¿Quiénes Somos?
                </h2>

                <p class="section-subtitle">
                    Nuestra comunidad
                </p>

            </div>

        </div>


        <div class="about-highlight">

            <div class="about-highlight-bar"></div>

            <p class="about-text">

                En

                <strong>
                    <?php echo defined('APP_NAME') ? APP_NAME : 'LunarMC Network'; ?>
                </strong>

                no solo vendemos rangos; creamos experiencias épicas.

                Somos una comunidad apasionada por Minecraft que entiende
                lo que los jugadores buscan: exclusividad, reconocimiento
                y, sobre todo, mucha diversión.

            </p>

        </div>


        <!-- ============================================
             FAQ
             ============================================ -->

        <div class="faq-section">

            <div class="section-heading faq-heading">

                <span class="section-icon">
                    ?
                </span>

                <div>

                    <h2 class="about-title">
                        Preguntas Frecuentes
                    </h2>

                    <p class="section-subtitle">
                        Respuestas sobre nuestros rangos
                    </p>

                </div>

            </div>


            <div class="faq-grid">


                <div class="faq-box">

                    <div class="faq-number">
                        01
                    </div>

                    <div>

                        <h3>
                            ¿Cuánto tiempo tarda en activarse mi rango
                            después de la compra?
                        </h3>

                        <p>
                            La mayoría de los rangos (SUN, VENUS, NOVA, etc.)
                            se activan de forma automática en un plazo de
                            5 a 15 minutos.
                        </p>

                    </div>

                </div>


                <div class="faq-box">

                    <div class="faq-number">
                        02
                    </div>

                    <div>

                        <h3>
                            ¿Los rangos son permanentes o mensuales?
                        </h3>

                        <p>
                            Todos nuestros rangos principales son permanentes,
                            a excepción del rango SUMMER.
                        </p>

                    </div>

                </div>


                <div class="faq-box">

                    <div class="faq-number">
                        03
                    </div>

                    <div>

                        <h3>
                            ¿Qué pasa si ya tengo VENUS y quiero comprar
                            VENUS+ o LUNAR?
                        </h3>

                        <p>
                            Nuestro sistema detecta automáticamente tu rango
                            actual y solo te cobrará la diferencia de precio.
                        </p>

                    </div>

                </div>


            </div>

        </div>

    </section>


    <!-- ================================================
         FORMULARIO DE CONTACTO
         ================================================ -->

    <section class="about-card">

        <div class="section-heading">

            <span class="section-icon">
                ✉
            </span>

            <div>

                <h2 class="about-title">
                    ¿Tienes alguna duda o consulta?
                </h2>

                <p class="section-subtitle">
                    Contacta con nuestro equipo de soporte
                </p>

            </div>

        </div>


        <p class="about-text">

            Completa el siguiente formulario para enviar tu pregunta
            a nuestro equipo de soporte.

        </p>


        <?php if ($contacto_exitoso): ?>
            <div class="contact-form-message contact-form-success" role="status">
                <?php echo htmlspecialchars($mensaje_contacto, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8'); ?>
            </div>
        <?php endif; ?>

        <?php if (!empty($errores_contacto)): ?>
            <div class="contact-form-message contact-form-error" role="alert">
                <strong>No se pudo enviar la consulta:</strong>
                <ul>
                    <?php foreach ($errores_contacto as $error_contacto): ?>
                        <li><?php echo htmlspecialchars($error_contacto, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8'); ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <form
            action="Acerca de Nosotros.php#formulario-contacto"
            method="POST"
            class="about-form"
            id="formulario-contacto"
        >

            <input type="hidden" name="formulario_contacto" value="1">
            <input
                type="hidden"
                name="csrf_token"
                value="<?php echo htmlspecialchars($_SESSION['csrf_token'], ENT_QUOTES, 'UTF-8'); ?>"
            >

            <fieldset>

                <legend>
                    Formulario de Pregunta
                </legend>


                <div class="about-form-group">

                    <label for="nombre">
                        Nombre completo
                    </label>

                    <input
                        type="text"
                        id="nombre"
                        name="nombre"
                        class="input-field"
                        placeholder="Escribe tu nombre"
                        maxlength="80"
                        value="<?php echo htmlspecialchars($nombre, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8'); ?>"
                        required
                    >

                </div>


                <div class="about-form-group">

                    <label for="email">
                        Correo electrónico
                    </label>

                    <input
                        type="text"
                        id="email"
                        name="email"
                        class="input-field"
                        placeholder="ejemplo10@gmail.com"
                        maxlength="254"
                        value="<?php echo htmlspecialchars($email, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8'); ?>"
                        required
                    >

                </div>


                <div class="about-form-group">

                    <label for="sexo">
                        Sexo
                    </label>

                    <select
                        id="sexo"
                        name="sexo"
                        class="input-field select-field"
                        required
                    >

                        <option
                            value=""
                            disabled
                            <?php echo $sexo === '' ? 'selected' : ''; ?>
                        >
                            Selecciona una opción
                        </option>

                        <option value="femenino" <?php echo $sexo === 'femenino' ? 'selected' : ''; ?>>
                            Femenino
                        </option>

                        <option value="masculino" <?php echo $sexo === 'masculino' ? 'selected' : ''; ?>>
                            Masculino
                        </option>

                        <option value="otro" <?php echo $sexo === 'otro' ? 'selected' : ''; ?>>
                            Otro / Prefiero no decirlo
                        </option>

                    </select>

                </div>


                <div class="about-form-group">

                    <label for="pregunta">
                        ¿Cuál es tu pregunta?
                    </label>

                    <textarea
                        id="pregunta"
                        name="pregunta"
                        class="input-field about-textarea"
                        rows="5"
                        minlength="10"
                        maxlength="1000"
                        placeholder="Escribe aquí tu consulta..."
                        required
                    ><?php echo htmlspecialchars($pregunta, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8'); ?></textarea>

                </div>


                <div class="about-form-actions">

                    <a
                        href="index.php"
                        class="btn-cancel-link"
                    >
                        ← Volver al inicio
                    </a>


                    <button
                        type="submit"
                        class="btn-submit-register"
                    >
                        Enviar Pregunta 📩
                    </button>

                </div>

            </fieldset>

        </form>

    </section>


    <!-- ================================================
         AVISO LEGAL Y CONTACTO
         ================================================ -->

    <section class="about-card about-contact-card">

        <div class="section-heading">

            <span class="section-icon">
                ◆
            </span>

            <div>

                <h2 class="about-title">
                    Aviso Legal y Contacto
                </h2>

                <p class="section-subtitle">
                    Información oficial de LunarMC
                </p>

            </div>

        </div>


        <div class="legal-box">

            <p class="about-text">

                <strong>
                    Importante:
                </strong>

                <?php echo defined('APP_NAME') ? APP_NAME : 'LunarMC Network'; ?>

                no está afiliado, asociado ni respaldado de ninguna manera
                por Mojang Studios o Microsoft Corporation.

            </p>

        </div>


        <div class="official-contact">

            <span class="contact-label">
                CONTACTO OFICIAL
            </span>

            <p class="about-text">

                Puedes enviarnos un correo a

                <span class="highlight-badge">
                    lunarmc.ccnetwork@gmail.com
                </span>

                o abrir un ticket de soporte en Discord.

            </p>

        </div>

    </section>


</div>


<?php include __DIR__ . '/includes/footer.php'; ?>


</body>
</html>