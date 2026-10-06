
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

    <title>TRIDENTBOX-EXTRAS: TAGS</title>

    <link
        rel="stylesheet"
        href="index-.css"
    >

</head>


<body class="dark-mode">


<?php include __DIR__ . '/includes/header.php'; ?>


<main class="main-container text-center">

    <section class="product-container text-center">


        <img
            src="imagen de tags.png"
            alt="Imagen de tags"
            width="300"
            class="product-image"
        >


        <h1>
            TAGS
        </h1>


        <h2>
            ¡TAGS - LUNARMC!
            <br>
            <small>
                Tienda oficial de LUNARMC Network, no estamos afiliados con Mojang, AB.
            </small>
        </h2>


        <div class="product-pricing">

            <span class="product-price">
                $2.99 USD
            </span>

        </div>


        <h3>

            🚀 | ¡Te presentamos los tags de LUNARMC Network!

            <br><br>

            💎 | Ahora te presentamos los TAGS:

            <br><br>

            ✅ | Obtendrás todos los TAGS.

            Usa el comando <code>/tag</code> para ver todos los tags.

        </h3>


        <div class="product-actions">

            <a
                href="agregar_carrito.php?producto=tags"
                class="btn-add-cart"
            >
                🛒 Agregar al carrito
            </a>

        </div>


        <br>


        <img
            src="tags de lunarmc 2.png"
            alt="Imagen de los tags 1"
            width="300"
            class="product-image"
        >


        <img
            src="tags de lunar mc.png"
            alt="Tags de LunarMC"
            width="300"
            class="product-image"
        >


        <h2>
            Términos y Condiciones
        </h2>


        <p>
            Al comprar este producto, automáticamente aceptas lo siguiente:
        </p>


        <p>

            ⚠️ Confirmas haber leído los términos y condiciones.

            <br>

            ⚠️ Entiendes que no se aceptarán reembolsos bajo ninguna circunstancia.

            <br>

            ⚠️ Reconoces que el producto es personal e intransferible.

            <br>

            ⚠️ Certificas haber revisado todas las funciones del producto y que cumplen tus expectativas.

        </p>


    </section>

</main>


<?php

if (file_exists(__DIR__ . '/includes/footer.php')) {
    include __DIR__ . '/includes/footer.php';
}

?>


</body>
</html>
