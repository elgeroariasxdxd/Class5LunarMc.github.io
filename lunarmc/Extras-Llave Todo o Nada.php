
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

    <title>TRIDENTBOX-EXTRAS: LLAVE TODO O NADA</title>

    <link
        rel="stylesheet"
        href="index-.css"
    >

</head>


<body class="dark-mode">


<?php include __DIR__ . '/includes/header.php'; ?>


<main class="main-container text-center">

    <section class="product-container text-center">


        <h1>
            LLAVE TODO O NADA
        </h1>


        <h2>

            Al comprar este paquete recibirás
            <strong>1 llave TODO O NADA</strong>
            que podrás canjear en la crate todo o nada.

            <br><br>

            Recuerda, debes tener al menos 1 espacio en el inventario libre
            para poder recibir esta llave.

            <br><br>

            Rango: Summer [50%]
            |
            Nada: [50%]

        </h2>


        <div class="product-pricing">

            <span class="product-price">
                $1.99 USD
            </span>

        </div>


        <div class="product-actions">

            <a
                href="agregar_carrito.php?producto=llave_todo_o_nada"
                class="btn-add-cart"
            >
                🛒 Agregar al carrito
            </a>

        </div>


        <br>


        <img
            src="llave todo o nada.png"
            alt="Imagen de la llave todo o nada"
            width="300"
            class="product-image"
        >


        <img
            src="llave todo o nada 50%.png"
            alt="Porcentajes de la llave todo o nada"
            width="300"
            class="product-image"
        >


    </section>

</main>


<?php

if (file_exists(__DIR__ . '/includes/footer.php')) {
    include __DIR__ . '/includes/footer.php';
}

?>


</body>
</html>

