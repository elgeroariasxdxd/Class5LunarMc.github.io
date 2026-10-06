<?php
require_once __DIR__ . '/config.php';
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
        Tienda LunarMC - Extras
    </title>

    <link
        rel="stylesheet"
        href="index-.css?v=20260929-3"
    >

</head>


<body class="dark-mode extras-page">


<?php include __DIR__ . '/includes/header.php'; ?>


<main class="main-container text-center">


    <section
        class="rangos-section text-center"
        style="margin: 30px auto;"
    >

        <h2 class="gold-heading">
            Objetos Extras y Mejoras
        </h2>

        <p class="blue-heading">
            Compra llaves, cosméticos y objetos especiales para LunarMC.
        </p>

        <br>


        <!-- ==================================================
             TIENDA DE EXTRAS
             ================================================== -->

        <div class="store-grid">


            <!-- ==================================================
                 TAGS
                 ================================================== -->

            <div class="extra-card">

                <img
                    src="imagen de tags.png"
                    alt="Extras Tags"
                    class="extra-img"
                >

                <h3 class="extra-title">
                    Tags
                </h3>

                <div class="extra-subtitle">
                    TAGS - LUNARMC
                </div>

                <div class="product-actions">

                    <button
                        type="button"
                        class="btn-info btn-extra-info"
                        title="Más Información"
                        data-extra="tags"
                    >
                        i
                    </button>

                    <a
                        href="agregar carrito.php?producto=tags"
                        class="btn-add-cart"
                        data-product="tags"
                    >
                        🛒 Agregar
                    </a>

                </div>

            </div>


            <!-- ==================================================
                 KILL EFFECTS
                 ================================================== -->

            <div class="extra-card">

                <img
                    src="imagen de kill efects.png"
                    alt="Kill Effects"
                    class="extra-img"
                >

                <h3 class="extra-title">
                    Kill Effects
                </h3>

                <div class="extra-subtitle">
                    KILL EFFECTS - LUNARMC
                </div>

                <div class="product-actions">

                    <button
                        type="button"
                        class="btn-info btn-extra-info"
                        title="Más Información"
                        data-extra="kill_effects"
                    >
                        i
                    </button>

                    <a
                        href="agregar carrito.php?producto=kill_effects"
                        class="btn-add-cart"
                        data-product="kill_effects"
                    >
                        🛒 Agregar
                    </a>

                </div>

            </div>


            <!-- ==================================================
                 LLAVE TODO O NADA
                 ================================================== -->

            <div class="extra-card">

                <img
                    src="llave todo o nada.png"
                    alt="Llave Todo o Nada"
                    class="extra-img"
                >

                <h3 class="extra-title">
                    Llave Todo o Nada
                </h3>

                <div class="extra-subtitle">
                    CRATE TODO O NADA
                </div>

                <div class="product-actions">

                    <button
                        type="button"
                        class="btn-info btn-extra-info"
                        title="Más Información"
                        data-extra="llave_todo_o_nada"
                    >
                        i
                    </button>

                    <a
                        href="agregar carrito.php?producto=llave_todo_o_nada"
                        class="btn-add-cart"
                        data-product="llave_todo_o_nada"
                    >
                        🛒 Agregar
                    </a>

                </div>

            </div>


        </div>

    </section>


    <!-- ==================================================
         MODAL DE INFORMACIÓN DE EXTRAS
         ================================================== -->

    <div
        id="info-modal"
        class="modal-overlay"
        aria-hidden="true"
    >

        <div
            class="modal-content"
            role="dialog"
            aria-modal="true"
            aria-labelledby="modal-title"
        >

            <button
                type="button"
                class="modal-close"
                id="btn-close-modal"
                aria-label="Cerrar"
            >
                &times;
            </button>


            <div class="modal-body">


                <div class="modal-left">

                    <img
                        id="modal-img"
                        src=""
                        alt="Extra"
                        class="modal-rank-img"
                    >

                    <h2
                        id="modal-title"
                        class="modal-rank-title"
                    ></h2>


                    <div class="modal-pricing">

                        <span
                            id="modal-price-old"
                            class="product-price-old"
                        ></span>

                        <span
                            id="modal-price"
                            class="product-price"
                        ></span>

                        <span class="product-currency">
                            USD
                        </span>

                    </div>


                    <button
                        type="button"
                        class="btn-add-cart-large"
                        style="width: 100%; border: none; cursor: pointer;"
                    >
                        🛒 AGREGAR
                    </button>

                </div>


                <div
                    class="modal-right"
                    id="modal-details-content"
                ></div>


            </div>

        </div>

    </div>


</main>


<?php

if (file_exists(__DIR__ . '/includes/footer.php')) {
    include __DIR__ . '/includes/footer.php';
}

?>


<!-- ==================================================
     QUITAR LA FLECHA AUTOMÁTICA DEL CSS
     Y DEJAR EL 🛒 DEL HTML
     ================================================== -->

<style>

.extras-page .btn-add-cart::before {
    content: none !important;
    display: none !important;
}

</style>


</body>
</html>

