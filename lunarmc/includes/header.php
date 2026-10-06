<?php

require_once __DIR__ . '/../config.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}


/*
|--------------------------------------------------------------------------
| TOKEN CSRF
|--------------------------------------------------------------------------
*/

if (
    !isset($_SESSION['csrf_token']) ||
    !is_string($_SESSION['csrf_token']) ||
    $_SESSION['csrf_token'] === ''
) {
    $_SESSION['csrf_token'] = bin2hex(
        random_bytes(32)
    );
}

$csrf_token = $_SESSION['csrf_token'];


/*
|--------------------------------------------------------------------------
| USUARIO
|--------------------------------------------------------------------------
*/

$usuario_logueado = isset(
    $_SESSION['usuario_id']
);

$nick_usuario = $usuario_logueado
    ? ($_SESSION['nick'] ?? 'Usuario')
    : '';

$es_inicio = basename(
    $_SERVER['PHP_SELF'] ?? ''
) === 'index.php';


/*
|--------------------------------------------------------------------------
| RENDER 3D DEL JUGADOR
|--------------------------------------------------------------------------
*/

$skin_usuario = '';

if (
    $usuario_logueado &&
    $nick_usuario !== ''
) {

    $skin_usuario =
        'https://mc-heads.net/body/' .
        rawurlencode($nick_usuario) .
        '/100';

}


/*
|--------------------------------------------------------------------------
| TOTAL DEL CARRITO
|--------------------------------------------------------------------------
*/

$total_carrito_usd = 0;

if (
    $usuario_logueado &&
    !empty($_SESSION['carrito']) &&
    is_array($_SESSION['carrito'])
) {

    foreach (
        $_SESSION['carrito']
        as $producto
    ) {

        $precio = (float) (
            $producto['precio'] ?? 0
        );

        $cantidad = (int) (
            $producto['cantidad'] ?? 0
        );

        $total_carrito_usd +=
            $precio * $cantidad;

    }

}

?>


<!-- ==========================================================
     TOKEN CSRF PARA JAVASCRIPT
     ========================================================== -->

<input
    type="hidden"
    id="lunarmc-csrf-token"
    value="<?php echo htmlspecialchars(
        $csrf_token,
        ENT_QUOTES,
        'UTF-8'
    ); ?>"
>


<!-- ==========================================================
     HEADER PRINCIPAL
     ========================================================== -->

<header class="header-top">


    <!-- ======================================================
         IZQUIERDA
         ====================================================== -->

    <div class="header-left">

        <button
            id="copy-ip-btn"
            class="clickable-ip"
            type="button"
            onclick="copyIP()"
        >
            IP: lunarmc.cc
        </button>

    </div>


    <!-- ======================================================
         CENTRO
         ====================================================== -->

    <div class="header-center">

        <h1 class="header-title">

            <?php

            echo defined('APP_NAME')
                ? htmlspecialchars(
                    APP_NAME,
                    ENT_QUOTES,
                    'UTF-8'
                )
                : 'LunarMC Network';

            ?>

        </h1>

    </div>


    <!-- ======================================================
         DERECHA
         ====================================================== -->

    <div class="header-right">


        <?php if ($usuario_logueado): ?>


            <!-- ==================================================
                 BOTÓN DE CUENTA
                 ================================================== -->

            <button
                type="button"
                id="open-account-menu"
                class="account-user"
                aria-label="Abrir menú de cuenta"
                aria-expanded="false"
            >


                <span class="account-skin-wrapper">

                    <img
                        src="<?php

                        echo htmlspecialchars(
                            $skin_usuario,
                            ENT_QUOTES,
                            'UTF-8'
                        );

                        ?>"
                        alt="Skin de <?php

                        echo htmlspecialchars(
                            $nick_usuario,
                            ENT_QUOTES,
                            'UTF-8'
                        );

                        ?>"
                        class="account-skin"
                    >

                </span>


                <span class="account-user-info">

                    <span class="account-user-label">
                        MI CUENTA
                    </span>


                    <span class="account-user-name">

                        <?php

                        echo htmlspecialchars(
                            $nick_usuario,
                            ENT_QUOTES,
                            'UTF-8'
                        );

                        ?>

                    </span>

                </span>


                <span class="account-arrow">
                    ▾
                </span>


            </button>


            <!-- ==================================================
                 MENÚ DESPLEGABLE DE CUENTA
                 ================================================== -->

            <div
                id="account-menu-overlay"
                class="account-menu-overlay"
                aria-hidden="true"
            >


                <div
                    class="account-menu"
                    role="dialog"
                    aria-label="Menú de cuenta"
                >


                    <!-- ==========================================
                         CABECERA DEL MENÚ
                         ========================================== -->

                    <div class="account-menu-header">


                        <div class="account-menu-profile">


                            <div class="account-menu-skin-wrapper">

                                <img
                                    src="<?php

                                    echo htmlspecialchars(
                                        $skin_usuario,
                                        ENT_QUOTES,
                                        'UTF-8'
                                    );

                                    ?>"
                                    alt="Skin"
                                    class="account-menu-skin"
                                >

                            </div>


                            <div class="account-menu-user-info">

                                <span class="account-menu-label">
                                    CUENTA
                                </span>


                                <strong>

                                    <?php

                                    echo htmlspecialchars(
                                        $nick_usuario,
                                        ENT_QUOTES,
                                        'UTF-8'
                                    );

                                    ?>

                                </strong>

                            </div>

                        </div>


                        <button
                            type="button"
                            id="close-account-menu"
                            class="account-menu-close"
                            aria-label="Cerrar menú"
                        >
                            ×
                        </button>


                    </div>


                    <!-- ==========================================
                         CUERPO DEL MENÚ
                         ========================================== -->

                    <div class="account-menu-body">


                        <!-- CARRITO -->

                        <a
                            href="carrito.php"
                            class="account-menu-item"
                        >

                            <span class="account-menu-item-icon">
                                🛒
                            </span>


                            <span class="account-menu-item-text">

                                <strong>
                                    Carrito
                                </strong>

                                <small>
                                    Revisar mis productos
                                </small>

                            </span>


                            <span class="account-menu-item-arrow">
                                ›
                            </span>

                        </a>


                        <!-- MI CUENTA -->

                        <a
                            href="panel.php"
                            class="account-menu-item"
                        >

                            <span class="account-menu-item-icon">
                                👤
                            </span>


                            <span class="account-menu-item-text">

                                <strong>
                                    Mi cuenta
                                </strong>

                                <small>
                                    Ver información personal
                                </small>

                            </span>


                            <span class="account-menu-item-arrow">
                                ›
                            </span>

                        </a>


                        <!-- ======================================
                             MONEDA
                             ====================================== -->

                        <div class="account-currency-item">


                            <span class="account-menu-item-icon">
                                💰
                            </span>


                            <span class="account-menu-item-text">

                                <strong>
                                    Moneda
                                </strong>

                                <small>
                                    Seleccioná cómo ver los precios
                                </small>

                            </span>


                            <select
                                id="currency-selector"
                                class="currency-selector"
                            >

                                <option value="USD">
                                    USD $
                                </option>

                                <option value="ARS">
                                    ARS $
                                </option>

                                <option value="EUR">
                                    EUR €
                                </option>

                            </select>


                        </div>


                        <!-- ======================================
                             TOTAL DEL CARRITO
                             ====================================== -->

                        <div
                            class="account-cart-summary"
                            id="account-cart-total"
                            data-usd="<?php

                            echo htmlspecialchars(
                                number_format(
                                    $total_carrito_usd,
                                    2,
                                    '.',
                                    ''
                                ),
                                ENT_QUOTES,
                                'UTF-8'
                            );

                            ?>"
                        >

                            $<?php

                            echo number_format(
                                $total_carrito_usd,
                                2,
                                '.',
                                ','
                            );

                            ?>

                            USD

                        </div>


                    </div>


                    <!-- ==========================================
                         PIE DEL MENÚ
                         ========================================== -->

                    <div class="account-menu-footer">


                        <a
                            href="logout.php"
                            class="account-menu-logout"
                        >
                            🚪 Cerrar sesión
                        </a>


                    </div>


                </div>

            </div>


        <?php else: ?>


            <!-- ==================================================
                 USUARIO NO LOGUEADO
                 ================================================== -->

            <a
                href="login.php"
                class="btn-login"
            >
                Iniciar sesión
            </a>


            <a
                href="registro.php"
                class="btn-register-link"
            >

                <span class="btn-register">
                    Regístrate 🔑
                </span>

            </a>


        <?php endif; ?>


        <!-- ======================================================
             MODO OSCURO / CLARO
             ====================================================== -->

        <button
            type="button"
            id="toggle-theme-btn"
        >
            ☀️ Modo Claro
        </button>


    </div>

</header>



<!-- ==========================================================
     FECHA Y HORA
     ========================================================== -->

<div
    class="datetime-banner"
    id="datetime-banner"
>

    Fecha:

    <?php echo date("d/m/Y"); ?>

    |

    Hora actual:

    <span id="clock">

        <?php echo date("H:i:s"); ?>

    </span>

</div>



<?php if ($es_inicio): ?>


    <!-- ======================================================
         MENÚ COMPACTO DEL INICIO
         ====================================================== -->

    <nav class="home-nav">


        <a
            href="index.php"
            class="home-nav-link active"
        >
            Inicio
        </a>


        <a
            href="rangos.php"
            class="home-nav-link"
        >
            🏆 Rangos
        </a>


        <a
            href="extras.php"
            class="home-nav-link"
        >
            ✦ Extras
        </a>


        <a
            href="Acerca de Nosotros.php"
            class="home-nav-link"
        >
            Acerca de Nosotros
        </a>


        <a
            href="carrito.php"
            class="home-nav-link"
        >
            🛒 Carrito
        </a>


    </nav>



<?php else: ?>


    <!-- ======================================================
         HEADER NORMAL PARA LAS DEMÁS PÁGINAS
         ====================================================== -->

    <section class="header-container text-center">


        <div class="banner-box">

            <img
                src="imagen del servidor lunar.png"
                alt="LunarMC Banner"
                class="banner-img"
            >

        </div>


        <h1 class="brand-title">

            <?php

            echo defined('APP_NAME')
                ? APP_NAME
                : 'LunarMC Network';

            ?>

        </h1>


        <div class="discord-box-wrapper">


            <div id="discord-community">


                <div class="discord-title">
                    Servidor de discord
                </div>


                <a
                    href="<?php

                    echo defined('DISCORD_URL')
                        ? DISCORD_URL
                        : 'https://discord.gg/BdbZcmjm';

                    ?>"
                    target="_blank"
                    rel="noopener noreferrer"
                >
                    Haz clic aquí para unirte
                </a>


            </div>

        </div>


        <nav class="main-nav">


            <div class="dropdown">


                <button
                    type="button"
                    class="dropdown-btn"
                >

                    Tridentbox

                    <span class="arrow">
                        ▼
                    </span>

                </button>


                <div class="dropdown-menu">


                    <a
                        href="rangos.php"
                        class="dropdown-item"
                    >
                        Rangos
                    </a>


                    <a
                        href="extras.php"
                        class="dropdown-item"
                    >
                        Extras
                    </a>


                </div>

            </div>


            <a
                href="index.php"
                class="nav-link"
            >
                Inicio
            </a>


            <a
                href="Acerca de Nosotros.php"
                class="nav-link"
            >
                Acerca de Nosotros
            </a>


        </nav>


    </section>


<?php endif; ?>