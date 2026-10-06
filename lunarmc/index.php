<?php

require_once __DIR__ . '/config.php';

date_default_timezone_set(
    'America/Argentina/Buenos_Aires'
);


/*
|--------------------------------------------------------------------------
| OBTENER META MENSUAL DESDE MYSQL
|--------------------------------------------------------------------------
*/

$meta_mensual = 0;


$conexion_meta = new mysqli(
    DB_HOST,
    DB_USER,
    DB_PASS,
    DB_NAME
);


if (!$conexion_meta->connect_error) {

    $conexion_meta->set_charset(
        'utf8mb4'
    );


    $mes_actual = date('Y-m');


    $stmt_meta =
        $conexion_meta->prepare("

            SELECT porcentaje

            FROM meta_mensual

            WHERE mes = ?

        ");


    if ($stmt_meta) {

        $stmt_meta->bind_param(
            's',
            $mes_actual
        );


        $stmt_meta->execute();


        $resultado_meta =
            $stmt_meta->get_result();


        if (
            $fila_meta =
            $resultado_meta->fetch_assoc()
        ) {

            $meta_mensual =
                (float)
                $fila_meta['porcentaje'];

        }


        $stmt_meta->close();

    }


    $conexion_meta->close();

}


$meta_mensual =
    min(
        100,
        max(
            0,
            $meta_mensual
        )
    );

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

        Tienda Minecraft -

        <?php

        echo defined('APP_NAME')
            ? htmlspecialchars(
                APP_NAME,
                ENT_QUOTES,
                'UTF-8'
            )
            : 'LunarMC';

        ?>

    </title>


    <link
        rel="stylesheet"
        href="index-.css?v=20261002-7"
    >


</head>



<body class="dark-mode home-page">



<?php

include __DIR__ .
    '/includes/header.php';

?>



<main class="home-main">



    <!-- ==================================================
         PROMOCIÓN PRINCIPAL
         ================================================== -->

    <section class="home-promo">


        <div class="promo-text">


            <span class="promo-small">

                OFERTAS LUNARMC

            </span>


            <h2>

                DESCUENTOS

                <strong>
                    ESPECIALES
                </strong>

            </h2>


            <p>

                Aprovechá nuestras promociones
                y conseguí tus productos favoritos
                para LunarMC.

            </p>


            <a
                href="rangos.php"
                class="promo-button"
            >
                VER RANGOS
            </a>


        </div>



        <div class="promo-image">

            <img
                src="imagen del servidor lunar.png"
                alt="LunarMC"
            >

        </div>



        <div class="promo-decoration">

            <span>✦</span>

            <span>✧</span>

            <span>✦</span>

        </div>


    </section>



    <!-- ==================================================
         CONTENIDO PRINCIPAL
         ================================================== -->

    <section class="home-layout">



        <!-- ==================================================
             COLUMNA IZQUIERDA
             ================================================== -->

        <aside class="home-sidebar">



            <!-- ==================================================
                 CATEGORÍAS
                 ================================================== -->

            <div class="category-card">


                <span class="category-small">

                    TIENDA LUNARMC

                </span>


                <h2>

                    SELECCIONÁ

                    <br>

                    UNA CATEGORÍA

                </h2>


                <img
                    src="rango lunar.png"
                    alt="Rango LunarMC"
                    class="category-image"
                >


                <div class="category-buttons">


                    <a
                        href="rangos.php"
                        class="category-button"
                    >
                        🏆 RANGOS
                    </a>


                    <a
                        href="extras.php"
                        class="category-button"
                    >
                        ✦ EXTRAS
                    </a>


                </div>


            </div>



            <!-- ==================================================
                 PAGOS RECIENTES
                 ================================================== -->

            <?php

            if (
                file_exists(
                    __DIR__ .
                    '/includes/pagos_recientes.php'
                )
            ) {

                include __DIR__ .
                    '/includes/pagos_recientes.php';

            }

            ?>



            <!-- ==================================================
                 COMUNIDAD
                 ================================================== -->

            <div class="sidebar-card">


                <div class="sidebar-card-title">


                    <span class="sidebar-icon">
                        👥
                    </span>


                    <span>
                        COMUNIDAD
                    </span>


                </div>


                <p>

                    Unite a nuestra comunidad
                    de LunarMC y mantenete al
                    tanto de las novedades.

                </p>


                <a
                    href="<?php

                    echo defined('DISCORD_URL')

                        ? htmlspecialchars(
                            DISCORD_URL,
                            ENT_QUOTES,
                            'UTF-8'
                        )

                        : 'https://discord.gg/BdbZcmjm';

                    ?>"
                    target="_blank"
                    rel="noopener noreferrer"
                    class="sidebar-discord"
                >

                    💬 UNIRME AL DISCORD

                </a>


            </div>



            <!-- ==================================================
                 COMPRA SEGURA
                 ================================================== -->

            <div class="sidebar-card">


                <div class="sidebar-card-title">


                    <span class="sidebar-icon">
                        🛡️
                    </span>


                    <span>
                        COMPRA SEGURA
                    </span>


                </div>


                <p>

                    Tus compras quedan registradas
                    de forma segura y se procesan
                    mediante nuestro sistema.

                </p>


            </div>



        </aside>



        <!-- ==================================================
             COLUMNA DERECHA
             ================================================== -->

        <section class="home-content">



            <!-- ==================================================
                 BIENVENIDA
                 ================================================== -->

            <div class="welcome-card">


                <div class="welcome-header">


                    <div class="welcome-title">


                        <span class="welcome-icon">
                            🌙
                        </span>


                        <div>


                            <span class="welcome-small">

                                BIENVENIDO A LA TIENDA
                                OFICIAL DE

                            </span>


                            <h1>

                                <?php

                                echo defined('APP_NAME')

                                    ? htmlspecialchars(
                                        APP_NAME,
                                        ENT_QUOTES,
                                        'UTF-8'
                                    )

                                    : 'LUNARMC NETWORK';

                                ?>

                            </h1>


                        </div>


                    </div>



                    <!-- ==================================================
                         META MENSUAL
                         ================================================== -->

                    <div class="goal-box">


                        <div class="goal-header">


                            <span>
                                META MENSUAL
                            </span>


                            <strong>

                                <?php

                                echo
                                    number_format(
                                        $meta_mensual,
                                        0
                                    )
                                    . '%';

                                ?>

                            </strong>


                        </div>


                        <div class="goal-bar">


                            <span
                                style="width: <?php
                                echo $meta_mensual;
                                ?>%;"
                            ></span>


                        </div>


                    </div>


                </div>



                <!-- ==================================================
                     BENEFICIOS
                     ================================================== -->

                <div class="benefits-grid">


                    <div class="benefit">


                        <div class="benefit-icon">
                            ⚡
                        </div>


                        <h3>
                            ENTREGA RÁPIDA
                        </h3>


                        <p>

                            Tus compras son procesadas
                            mediante nuestro sistema
                            de forma rápida.

                        </p>


                    </div>



                    <div class="benefit">


                        <div class="benefit-icon">
                            ✓
                        </div>


                        <h3>
                            COMPRA SEGURA
                        </h3>


                        <p>

                            Tus pedidos quedan registrados
                            y asociados a tu cuenta LunarMC.

                        </p>


                    </div>



                    <div class="benefit">


                        <div class="benefit-icon">
                            🛒
                        </div>


                        <h3>
                            GRAN VARIEDAD
                        </h3>


                        <p>

                            Encontrá rangos,
                            objetos, cosméticos y extras.

                        </p>


                    </div>



                    <div class="benefit">


                        <div class="benefit-icon">
                            💜
                        </div>


                        <h3>
                            APOYÁ LUNARMC
                        </h3>


                        <p>

                            Tus compras ayudan al
                            mantenimiento y desarrollo
                            del servidor.

                        </p>


                    </div>


                </div>



                <div class="welcome-separator"></div>



                <!-- ==================================================
                     DESCRIPCIÓN
                     ================================================== -->

                <div class="home-description">


                    <p>

                        Te damos la bienvenida al portal
                        de compras oficial de

                        <strong>
                            LunarMC Network
                        </strong>.

                        Acá podrás adquirir rangos,
                        objetos y mejoras para disfrutar
                        aún más de tu experiencia en
                        nuestro servidor.

                    </p>


                    <p>

                        Para recibir correctamente
                        cualquier producto, asegurate
                        de utilizar exactamente el mismo
                        nick con el que jugás en

                        <span class="server-badge">
                            lunarmc.cc
                        </span>.

                    </p>


                </div>



                <!-- ==================================================
                     TÉRMINOS
                     ================================================== -->

                <div class="terms-box">


                    <p>

                        Todas las compras realizadas
                        en la tienda son definitivas
                        y no reembolsables.

                    </p>


                    <p>

                        LunarMC no está afiliado,
                        asociado ni respaldado por
                        Mojang Studios o Microsoft.

                    </p>


                    <div class="terms-buttons">


                        <a
                            href="Acerca de Nosotros.php"
                        >
                            INFORMACIÓN
                        </a>


                        <a
                            href="index.php"
                        >
                            PÁGINA PRINCIPAL
                        </a>


                    </div>


                </div>


            </div>



            <!-- ==================================================
                 GALERÍA
                 ================================================== -->

            <?php

            if (
                file_exists(
                    __DIR__ .
                    '/includes/gallery.php'
                )
            ) {

                include __DIR__ .
                    '/includes/gallery.php';

            }

            ?>



            <!-- ==================================================
                 FAQ
                 ================================================== -->

            <?php

            if (
                file_exists(
                    __DIR__ .
                    '/includes/faq.php'
                )
            ) {

                include __DIR__ .
                    '/includes/faq.php';

            }

            ?>


        </section>


    </section>


</main>


<?php

if (
    file_exists(
        __DIR__ .
        '/includes/footer.php'
    )
) {

    include __DIR__ .
        '/includes/footer.php';

}

?>