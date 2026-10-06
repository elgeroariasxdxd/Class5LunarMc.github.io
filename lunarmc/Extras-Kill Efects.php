
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

    <title>TRIDENTBOX-EXTRAS: KILL EFFECTS</title>

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
            src="imagen de kill efects.png"
            alt="Imagen de Kill Effects"
            width="300"
            class="product-image"
        >


        <h1>
            KILL EFFECTS
        </h1>


        <h2>

            ¡KILL EFFECTS - LUNARMC!

            <br>

            <small>
                Tienda oficial de LUNARMC Network, no estamos afiliados con Mojang, AB.
            </small>

        </h2>


        <div class="product-pricing">

            <span class="product-price">
                $4.99 USD
            </span>

        </div>


        <h3>

            🚀 | ¡Te presentamos los Kill Effects de LUNARMC Network!

            <br><br>

            💎 | Ahora te presentamos los KILL EFFECTS:

            <br><br>

            ✅ | Obtendrás todos los KILL EFFECTS.

            Usa el comando <code>/killeffects</code> para ver la lista completa.

        </h3>


        <div class="product-actions">

            <a
                href="agregar_carrito.php?producto=kill_effects"
                class="btn-add-cart"
            >
                🛒 Agregar al carrito
            </a>

        </div>


        <br>


        <div class="product-description">

            <p>
                <code>/betterkill set totem</code>
                - Aparecerá un totem en tu pantalla.
            </p>

            <p>
                <code>/betterkill set totem_particle</code>
                - Aparecerán las partículas del totem.
            </p>

            <p>
                <code>/betterkill set ray</code>
                - Aparecerá un rayo en tu pantalla.
            </p>

            <p>
                <code>/betterkill set angel</code>
                - Aparecerá una corona de ángel en tu cabeza.
            </p>

            <p>
                <code>/betterkill set demon</code>
                - Aparecerá una corona de demonio en tu cabeza.
            </p>

        </div>


    </section>

</main>


<?php

if (file_exists(__DIR__ . '/includes/footer.php')) {
    include __DIR__ . '/includes/footer.php';
}

?>


</body>
</html>

