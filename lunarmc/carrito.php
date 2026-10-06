<?php

require_once __DIR__ . '/config.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}


/* ==========================================================
   ACTUALIZAR CANTIDAD
   ========================================================== */

if (
    $_SERVER['REQUEST_METHOD'] === 'POST' &&
    isset($_POST['producto'], $_POST['cambio'])
) {

    $producto_id = (string) $_POST['producto'];
    $cambio = (int) $_POST['cambio'];

    if (
        isset($_SESSION['carrito'][$producto_id]) &&
        ($cambio === 1 || $cambio === -1)
    ) {

        $cantidad_actual = (int) (
            $_SESSION['carrito'][$producto_id]['cantidad'] ?? 1
        );

        $nueva_cantidad = $cantidad_actual + $cambio;

        if ($nueva_cantidad <= 0) {

            unset(
                $_SESSION['carrito'][$producto_id]
            );

        } else {

            $_SESSION['carrito'][$producto_id]['cantidad'] =
                $nueva_cantidad;

        }
    }

    header('Location: carrito.php');
    exit;
}


/* ==========================================================
   ELIMINAR PRODUCTO
   ========================================================== */

if (isset($_GET['eliminar'])) {

    $producto_id = (string) $_GET['eliminar'];

    if (
        isset($_SESSION['carrito']) &&
        isset($_SESSION['carrito'][$producto_id])
    ) {

        unset(
            $_SESSION['carrito'][$producto_id]
        );

    }

    header('Location: carrito.php');
    exit;
}


/* ==========================================================
   USUARIO
   ========================================================== */

$usuario_logueado =
    isset($_SESSION['usuario_id']);

$nick_usuario =
    $usuario_logueado
        ? ($_SESSION['nick'] ?? 'Usuario')
        : 'Invitado';


/* ==========================================================
   CARRITO
   ========================================================== */

$carrito =
    $_SESSION['carrito'] ?? [];

$total = 0;
$cantidad_total = 0;

foreach ($carrito as $producto) {

    $precio =
        (float) (
            $producto['precio'] ?? 0
        );

    $cantidad =
        (int) (
            $producto['cantidad'] ?? 1
        );

    $subtotal =
        $precio * $cantidad;

    $total +=
        $subtotal;

    $cantidad_total +=
        $cantidad;
}


/* ==========================================================
   CABEZA DEL JUGADOR
   ========================================================== */

$skin_usuario =
    'https://mc-heads.net/avatar/' .
    rawurlencode($nick_usuario) .
    '/100';

?>

<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Tu carrito - LunarMC</title>

    <link
        rel="stylesheet"
        href="index-.css?v=20261003-2"
    >

</head>


<body class="dark-mode">


<?php include __DIR__ . '/includes/header.php'; ?>


<main class="lunarmc-cart-page">


    <!-- ======================================================
         TÍTULO
         ====================================================== -->

    <div class="lunarmc-cart-heading">

        <h1>
            Tu carrito
        </h1>

        <p>
            Revisá tus productos antes de finalizar la compra.
        </p>

    </div>


    <?php if (empty($carrito)): ?>


        <!-- ==================================================
             CARRITO VACÍO
             ================================================== -->

        <div class="lunarmc-cart-box lunarmc-empty">

            <div class="lunarmc-empty-icon">
                🛒
            </div>

            <h2>
                Tu carrito está vacío
            </h2>

            <p>
                Todavía no agregaste ningún producto.
            </p>

            <a href="rangos.php">
                Ver productos
            </a>

        </div>


    <?php else: ?>


        <!-- ==================================================
             CARRITO CON PRODUCTOS
             ================================================== -->

        <div class="lunarmc-cart-layout">


            <!-- ==============================================
                 PRODUCTOS
                 ============================================== -->

            <section class="lunarmc-cart-box">


                <div class="lunarmc-cart-box-title">

                    <h2>
                        Productos
                    </h2>

                    <span class="lunarmc-cart-count">

                        <?php echo (int) $cantidad_total; ?>

                        <?php
                        echo $cantidad_total === 1
                            ? 'producto'
                            : 'productos';
                        ?>

                    </span>

                </div>


                <div class="lunarmc-products">


                    <?php foreach ($carrito as $id => $producto): ?>


                        <?php

                        $precio =
                            (float) (
                                $producto['precio']
                                ?? 0
                            );

                        $cantidad =
                            (int) (
                                $producto['cantidad']
                                ?? 1
                            );

                        $subtotal =
                            $precio * $cantidad;

                        $nombre =
                            $producto['nombre']
                            ?? 'Producto';

                        $imagen =
                            $producto['imagen']
                            ?? '';

                        ?>


                        <article class="lunarmc-cart-item">


                            <!-- IMAGEN -->

                            <div class="lunarmc-product-image">

                                <?php if ($imagen !== ''): ?>

                                    <img
                                        src="<?php
                                        echo htmlspecialchars(
                                            $imagen,
                                            ENT_QUOTES,
                                            'UTF-8'
                                        );
                                        ?>"
                                        alt="<?php
                                        echo htmlspecialchars(
                                            $nombre,
                                            ENT_QUOTES,
                                            'UTF-8'
                                        );
                                        ?>"
                                    >

                                <?php else: ?>

                                    <span>📦</span>

                                <?php endif; ?>

                            </div>


                            <!-- INFORMACIÓN -->

                            <div class="lunarmc-product-info">

                                <h3>

                                    <?php
                                    echo htmlspecialchars(
                                        $nombre,
                                        ENT_QUOTES,
                                        'UTF-8'
                                    );
                                    ?>

                                </h3>


                                <span class="lunarmc-product-category">
                                    Producto LunarMC Network
                                </span>


                                <div class="lunarmc-product-unit-price">

                                    Precio unitario:

                                    <strong>

                                        $<?php
                                        echo number_format(
                                            $precio,
                                            2
                                        );
                                        ?>

                                        USD

                                    </strong>

                                </div>

                            </div>


                            <!-- CANTIDAD / TOTAL -->

                            <div class="lunarmc-product-actions">


                                <div class="lunarmc-product-total">

                                    $<?php
                                    echo number_format(
                                        $subtotal,
                                        2
                                    );
                                    ?>

                                    USD

                                </div>


                                <div class="lunarmc-quantity-box">


                                    <button
                                        type="button"
                                        class="lunarmc-quantity-btn"
                                        onclick="cambiarCantidad(
                                            '<?php
                                            echo htmlspecialchars(
                                                (string) $id,
                                                ENT_QUOTES,
                                                'UTF-8'
                                            );
                                            ?>',
                                            -1
                                        )"
                                        aria-label="Disminuir cantidad"
                                    >
                                        −
                                    </button>


                                    <span class="lunarmc-quantity-number">

                                        <?php echo $cantidad; ?>

                                    </span>


                                    <button
                                        type="button"
                                        class="lunarmc-quantity-btn"
                                        onclick="cambiarCantidad(
                                            '<?php
                                            echo htmlspecialchars(
                                                (string) $id,
                                                ENT_QUOTES,
                                                'UTF-8'
                                            );
                                            ?>',
                                            1
                                        )"
                                        aria-label="Aumentar cantidad"
                                    >
                                        +
                                    </button>


                                </div>


                                <a
                                    href="carrito.php?eliminar=<?php
                                    echo urlencode(
                                        (string) $id
                                    );
                                    ?>"
                                    class="lunarmc-remove"
                                >
                                    Eliminar
                                </a>


                            </div>


                        </article>


                    <?php endforeach; ?>


                </div>


            </section>


            <!-- ==============================================
                 RESUMEN
                 ============================================== -->

            <aside class="lunarmc-cart-box">


                <!-- ==========================================
                     JUGADOR
                     ========================================== -->

                <div class="lunarmc-player-card">


                    <div class="lunarmc-player-info">

                        <span class="lunarmc-player-label">
                            Comprando para
                        </span>


                        <strong class="lunarmc-player-name">

                            <?php
                            echo htmlspecialchars(
                                $nick_usuario,
                                ENT_QUOTES,
                                'UTF-8'
                            );
                            ?>

                        </strong>


                        <span class="lunarmc-player-description">

                            Los productos serán entregados
                            a esta cuenta.

                        </span>

                    </div>


                    <img
                        src="<?php
                        echo htmlspecialchars(
                            $skin_usuario,
                            ENT_QUOTES,
                            'UTF-8'
                        );
                        ?>"
                        alt="Cabeza de <?php
                        echo htmlspecialchars(
                            $nick_usuario,
                            ENT_QUOTES,
                            'UTF-8'
                        );
                        ?>"
                        class="lunarmc-player-skin"
                    >


                </div>


                <!-- ==========================================
                     RESUMEN DE PRECIOS
                     ========================================== -->

                <div class="lunarmc-summary">


                    <div class="lunarmc-summary-line">

                        <span>
                            Productos
                        </span>

                        <strong>
                            <?php echo (int) $cantidad_total; ?>
                        </strong>

                    </div>


                    <div class="lunarmc-summary-line">

                        <span>
                            Subtotal
                        </span>

                        <strong>

                            $<?php
                            echo number_format(
                                $total,
                                2
                            );
                            ?>

                            USD

                        </strong>

                    </div>


                    <div class="lunarmc-summary-line">

                        <span>
                            Descuento
                        </span>

                        <strong id="cart-discount">
                            $0.00 USD
                        </strong>

                    </div>


                    <div class="lunarmc-summary-divider"></div>


                    <div class="lunarmc-summary-total">

                        <span>
                            Total
                        </span>

                        <strong id="cart-final-total">

                            $<?php
                            echo number_format(
                                $total,
                                2
                            );
                            ?>

                            USD

                        </strong>

                    </div>


                    <!-- ======================================
                         CUPÓN
                         ====================================== -->

                    <div class="lunarmc-coupon">


                        <label for="coupon-code">
                            ¿Tenés un código de descuento?
                        </label>


                        <div class="lunarmc-coupon-row">

                            <input
                                type="text"
                                id="coupon-code"
                                placeholder="Código"
                                autocomplete="off"
                            >

                            <button
                                type="button"
                                id="apply-coupon"
                            >
                                Aplicar
                            </button>

                        </div>


                        <small
                            id="coupon-message"
                            class="lunarmc-coupon-message"
                        ></small>


                    </div>


                    <!-- ======================================
                         CONFIRMACIONES
                         ====================================== -->

                    <div class="lunarmc-checkout-options">


                        <label class="lunarmc-check">

                            <input
                                type="checkbox"
                                id="confirm-account"
                            >

                            <span>

                                Confirmo que estoy comprando para

                                <strong class="lunarmc-confirm-user">

                                    <?php
                                    echo htmlspecialchars(
                                        $nick_usuario,
                                        ENT_QUOTES,
                                        'UTF-8'
                                    );
                                    ?>

                                </strong>.

                            </span>

                        </label>


                        <label class="lunarmc-check">

                            <input
                                type="checkbox"
                                id="confirm-terms"
                            >

                            <span>

                                Confirmo que revisé mi pedido
                                y acepto los términos de compra.

                            </span>

                        </label>


                    </div>


                    <!-- ======================================
                         CHECKOUT
                         ====================================== -->

                    <a
                        href="procesar pedido.php"
                        id="checkout-button"
                        class="lunarmc-checkout-button disabled"
                    >
                        CONTINUAR AL PAGO
                    </a>


                    <a
                        href="rangos.php"
                        class="lunarmc-continue"
                    >
                        ← Continuar comprando
                    </a>


                    <br>


                    <a
                        href="vaciar carrito.php"
                        class="lunarmc-clear-cart"
                        onclick="
                            return confirm(
                                '¿Seguro que querés vaciar todo el carrito?'
                            );
                        "
                    >
                        Vaciar carrito
                    </a>


                </div>


            </aside>


        </div>


    <?php endif; ?>


</main>


<?php

if (
    file_exists(
        __DIR__ .
        '/includes/footer.php'
    )
) {

    include
        __DIR__ .
        '/includes/footer.php';

}

?>


</body>

</html>