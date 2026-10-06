<?php
require_once __DIR__ . '/config.php';
?>

<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>
        Preguntas Frecuentes -
        <?php echo defined('APP_NAME') ? APP_NAME : 'LunarMC Network'; ?>
    </title>

  <link rel="stylesheet" href="index-.css?v=20261005-3">

</head>

<body class="dark-mode">

<?php include __DIR__ . '/includes/header.php'; ?>


<main class="faq-page">


    <!-- =====================================================
         QUIÉNES SOMOS
         ===================================================== -->

    <section class="faq-about">

        <div class="faq-section-heading">

            <span class="faq-icon">
                🌙
            </span>

            <div>

                <span class="faq-label">
                    CONOCE NUESTRA COMUNIDAD
                </span>

                <h1>
                    ¿QUIÉNES SOMOS?
                </h1>

            </div>

        </div>


        <div class="faq-about-content">

            <p>
                En LUNARMC.CC no solo vendemos rangos; creamos
                experiencias épicas. Somos una comunidad apasionada
                por Minecraft que entiende lo que los jugadores buscan:
                exclusividad, reconocimiento y, sobre todo, mucha diversión.
            </p>

            <p>
                Nuestra tienda fue diseñada para ofrecer a cada usuario
                la posibilidad de personalizar su aventura. Desde el
                brillo solar del rango SUN hasta el prestigio místico
                del rango LUNAR, nuestro objetivo es recompensar tu
                lealtad y apoyo al servidor con beneficios que realmente
                marquen la diferencia en tu gameplay.
            </p>

            <p>
                Creemos en la transparencia y en el crecimiento constante,
                por eso cada moneda invertida aquí se reinvierte directamente
                en mejorar nuestros sistemas, reducir el lag y traer
                contenido nuevo cada semana.
            </p>

            <div class="faq-thanks">
                ¡Gracias por ser parte de nuestra historia!
            </div>

        </div>

    </section>



    <!-- =====================================================
         FAQ
         ===================================================== -->

    <section class="faq-section">

        <div class="faq-title">

            <span class="faq-label">
                AYUDA Y SOPORTE
            </span>

            <h2>
                Preguntas Frecuentes
            </h2>

            <p>
                Aquí encontrarás respuestas a las dudas más comunes
                sobre rangos, compras, mejoras y soporte.
            </p>

        </div>


        <div class="faq-list">


            <!-- PREGUNTA 1 -->

            <article class="faq-item">

                <div class="faq-question">

                    <span class="faq-number">
                        01
                    </span>

                    <h3>
                        ¿Cuánto tiempo tarda en activarse mi rango
                        después de la compra?
                    </h3>

                </div>

                <div class="faq-answer">

                    <p>
                        La mayoría de los rangos (SUN, VENUS, NOVA, etc.)
                        se activan de forma automática en un plazo de
                        5 a 15 minutos. Asegúrate de estar conectado
                        al servidor al momento de realizar la compra
                        para evitar retrasos.
                    </p>

                </div>

            </article>


            <!-- PREGUNTA 2 -->

            <article class="faq-item">

                <div class="faq-question">

                    <span class="faq-number">
                        02
                    </span>

                    <h3>
                        ¿Los rangos son permanentes o mensuales?
                    </h3>

                </div>

                <div class="faq-answer">

                    <p>
                        Todos nuestros rangos principales son permanentes,
                        a excepción del rango SUMMER, que es una edición
                        especial de temporada. Una vez que adquieres un
                        rango, conservas tus beneficios para siempre.
                    </p>

                </div>

            </article>


            <!-- PREGUNTA 3 -->

            <article class="faq-item">

                <div class="faq-question">

                    <span class="faq-number">
                        03
                    </span>

                    <h3>
                        ¿Qué pasa si ya tengo VENUS y quiero comprar
                        VENUS+ o LUNAR?
                    </h3>

                </div>

                <div class="faq-answer">

                    <p>
                        ¡No hay problema! Nuestro sistema detecta
                        automáticamente tu rango actual y solo te
                        cobrará la diferencia de precio. A esto le
                        llamamos "Upgrade", y es la mejor forma de
                        escalar posiciones en el servidor.
                    </p>

                </div>

            </article>


            <!-- PREGUNTA 4 -->

            <article class="faq-item">

                <div class="faq-question">

                    <span class="faq-number">
                        04
                    </span>

                    <h3>
                        ¿Cómo funcionan las Llaves Todo o Nada?
                    </h3>

                </div>

                <div class="faq-answer">

                    <p>
                        Es nuestra modalidad más emocionante. Al usar
                        la Llave Todo o Nada, entras en un sorteo
                        instantáneo donde puedes multiplicar el valor
                        de tu compra con premios increíbles o, como
                        dice el nombre, perder la apuesta. ¡Solo para
                        los más valientes!
                    </p>

                </div>

            </article>


            <!-- PREGUNTA 5 -->

            <article class="faq-item">

                <div class="faq-question">

                    <span class="faq-number">
                        05
                    </span>

                    <h3>
                        ¿Puedo regalarle un Tag a un amigo?
                    </h3>

                </div>

                <div class="faq-answer">

                    <p>
                        ¡Sí! Al momento de realizar el pago en la tienda,
                        asegúrate de ingresar el Nick (nombre de usuario)
                        de la persona que recibirá el Tag. Es un regalo
                        perfecto para tu compañero de facción o equipo.
                    </p>

                </div>

            </article>


            <!-- PREGUNTA 6 -->

            <article class="faq-item">

                <div class="faq-question">

                    <span class="faq-number">
                        06
                    </span>

                    <h3>
                        ¿Qué hago si mi compra no llega?
                    </h3>

                </div>

                <div class="faq-answer">

                    <p>
                        No te preocupes, contamos con un equipo de
                        soporte activo. Si pasan más de 30 minutos y
                        no has recibido tu objeto o rango, abre un
                        ticket en nuestro Discord oficial con tu
                        comprobante de pago y te ayudaremos de inmediato.
                    </p>

                </div>

            </article>


        </div>

        <!-- =====================================================
     CONSULTA RÁPIDA - MÉTODO GET
     ===================================================== -->

<section class="faq-section" id="soporte-rapido">

    <div class="faq-title">

        <span class="faq-label">
            SOPORTE RÁPIDO
        </span>

        <h2>
            ¿Necesitás ayuda con algo?
        </h2>

        <p>
            Seleccioná el problema que mejor describa tu situación.
        </p>

    </div>

    <?php
    // Recibimos el valor enviado mediante GET.
    $tipoConsulta = filter_input(
        INPUT_GET,
        'consulta',
        FILTER_UNSAFE_RAW,
        FILTER_REQUIRE_SCALAR
    );

    $tipoConsulta = is_string($tipoConsulta)
        ? trim($tipoConsulta)
        : '';

    // Lista blanca de valores permitidos.
    $consultasPermitidas = [
        'compra_no_llego',
        'problema_rango',
        'duda_compra',
        'otro'
    ];

    // Validación del lado del servidor.
    if (
        $tipoConsulta !== '' &&
        !in_array($tipoConsulta, $consultasPermitidas, true)
    ) {
        $tipoConsulta = '';
    }
    ?>

    <form
        method="GET"
        action="faq pagina web.php"
        class="faq-get-form"
    >

        <div class="faq-form-group">

            <label
                for="consulta"
                class="faq-form-label"
            >
                Seleccioná una opción:
            </label>

            <select
                name="consulta"
                id="consulta"
                class="faq-select"
                required
            >

                <option value="">
                    Elegí tu problema...
                </option>

                <option
                    value="compra_no_llego"
                    <?php echo $tipoConsulta === 'compra_no_llego' ? 'selected' : ''; ?>
                >
                    Mi compra todavía no llegó
                </option>

                <option
                    value="problema_rango"
                    <?php echo $tipoConsulta === 'problema_rango' ? 'selected' : ''; ?>
                >
                    Tengo un problema con mi rango
                </option>

                <option
                    value="duda_compra"
                    <?php echo $tipoConsulta === 'duda_compra' ? 'selected' : ''; ?>
                >
                    Tengo una duda sobre una compra
                </option>

                <option
                    value="otro"
                    <?php echo $tipoConsulta === 'otro' ? 'selected' : ''; ?>
                >
                    Tengo otro problema
                </option>

            </select>

        </div>

        <button
            type="submit"
            class="faq-get-button"
        >
            Continuar
        </button>

    </form>


    <?php if ($tipoConsulta !== ''): ?>

        <div class="faq-result">

            <?php if ($tipoConsulta === 'compra_no_llego'): ?>

                <h3 class="faq-result-title">
                    Mi compra todavía no llegó
                </h3>

                <p class="faq-result-description">
                    Indicá tu nick y explicanos qué compraste y hace cuánto realizaste la compra.
                </p>


            <?php elseif ($tipoConsulta === 'problema_rango'): ?>

                <h3 class="faq-result-title">
                    Problema con un rango
                </h3>

                <p class="faq-result-description">
                    Indicá tu nick y contanos qué problema estás teniendo con tu rango.
                </p>


            <?php elseif ($tipoConsulta === 'duda_compra'): ?>

                <h3 class="faq-result-title">
                    Duda sobre una compra
                </h3>

                <p class="faq-result-description">
                    Indicá tu nick y escribí tu consulta sobre la compra.
                </p>


            <?php elseif ($tipoConsulta === 'otro'): ?>

                <h3 class="faq-result-title">
                    Otro problema
                </h3>

                <p class="faq-result-description">
                    Indicá tu nick y explicanos brevemente qué sucede.
                </p>

            <?php endif; ?>


            <div class="faq-support-box">

                <div class="faq-support-group">

                    <label
                        for="soporte-nick"
                        class="faq-support-label"
                    >
                        Nick de Minecraft
                    </label>

                    <input
                        type="text"
                        id="soporte-nick"
                        class="faq-support-input"
                        placeholder="Ej: Elzeta"
                        maxlength="16"
                    >

                </div>


                <div class="faq-support-group">

                    <label
                        for="soporte-duda"
                        class="faq-support-label"
                    >
                        Explica tu situación
                    </label>

                    <textarea
                        id="soporte-duda"
                        class="faq-support-textarea"
                        maxlength="500"
                        placeholder="Explicá brevemente qué ocurrió..."
                    ></textarea>

                </div>

            </div>

        </div>

    <?php endif; ?>

    </section>



    <!-- =====================================================
         CONTACTO
         ===================================================== -->

    <section class="faq-contact">

        <div class="faq-contact-icon">
            💬
        </div>

        <div class="faq-contact-content">

            <span class="faq-label">
                ¿NECESITAS AYUDA?
            </span>

            <h2>
                ¿Cuál es tu duda?
            </h2>

            <p>
                Si no encontraste la respuesta que buscabas,
                puedes ponerte en contacto con nosotros.
            </p>

        </div>

        <a
            href="registro.php"
            class="faq-contact-button"
        >
            Contactar
        </a>

    </section>


</main>


<?php include __DIR__ . '/includes/footer.php'; ?>

</body>
</html>