<?php
require_once __DIR__ . '/config.php';

/*
 * CLASE 5 - Interacción GET
 * El orden elegido viaja en la URL, por ejemplo:
 * rangos.php?orden=precio_asc
 */
$orden = filter_input(INPUT_GET, 'orden', FILTER_UNSAFE_RAW, FILTER_REQUIRE_SCALAR);
$orden = is_string($orden) ? trim($orden) : 'recomendados';

$ordenesPermitidos = [
    'recomendados',
    'precio_asc',
    'precio_desc',
    'nombre_asc',
    'nombre_desc',
];

if (!in_array($orden, $ordenesPermitidos, true)) {
    $orden = 'recomendados';
}

$rangos = [
    [
        'id' => 'sun',
        'nombre' => 'Sun',
        'imagen' => 'sun rango.png',
        'precio_anterior' => 9.97,
        'precio' => 2.99,
        'posicion' => 1,
    ],
    [
        'id' => 'venus',
        'nombre' => 'Venus',
        'imagen' => 'rango venus.png',
        'precio_anterior' => 19.97,
        'precio' => 5.99,
        'posicion' => 2,
    ],
    [
        'id' => 'venus_plus',
        'nombre' => 'Venus +',
        'imagen' => 'rango venus +.png',
        'precio_anterior' => 33.30,
        'precio' => 9.99,
        'posicion' => 3,
    ],
    [
        'id' => 'nova',
        'nombre' => 'Nova',
        'imagen' => 'rango nova.png',
        'precio_anterior' => 49.97,
        'precio' => 14.99,
        'posicion' => 4,
    ],
    [
        'id' => 'lunar',
        'nombre' => 'Lunar',
        'imagen' => 'rango lunar.png',
        'precio_anterior' => 56.63,
        'precio' => 16.99,
        'posicion' => 5,
    ],
    [
        'id' => 'summer',
        'nombre' => 'Summer',
        'imagen' => 'rango summer.png',
        'precio_anterior' => 69.97,
        'precio' => 20.99,
        'posicion' => 6,
    ],
];

switch ($orden) {
    case 'precio_asc':
        usort($rangos, fn($a, $b) => $a['precio'] <=> $b['precio']);
        break;

    case 'precio_desc':
        usort($rangos, fn($a, $b) => $b['precio'] <=> $a['precio']);
        break;

    case 'nombre_asc':
        usort($rangos, fn($a, $b) => strcasecmp($a['nombre'], $b['nombre']));
        break;

    case 'nombre_desc':
        usort($rangos, fn($a, $b) => strcasecmp($b['nombre'], $a['nombre']));
        break;

    default:
        usort($rangos, fn($a, $b) => $a['posicion'] <=> $b['posicion']);
        break;
}

function e(string $valor): string
{
    return htmlspecialchars($valor, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
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
        Tienda LunarMC - Rangos
    </title>

    <link
        rel="stylesheet"
        href="index-.css?v=20261005-clase5"
    >

</head>


<body class="dark-mode">


<?php include 'includes/header.php'; ?>


<main class="main-container text-center">


    <section
        class="rangos-section text-center"
        style="margin: 30px auto;"
    >

        <h2 class="gold-heading">
            Sección de Rangos Permanentes
        </h2>

        <p class="blue-heading">
            Aquí puedes adquirir tus rangos permanentes.
        </p>

        <br>


        <!-- ==================================================
             ORDENAMIENTO GET - CLASE 5
             ================================================== -->

        <form method="GET" action="rangos.php" class="rank-sort-form">

            <label for="orden" class="rank-sort-label">
                Ordenar rangos por:
            </label>

            <select
                name="orden"
                id="orden"
                class="rank-sort-select"
                onchange="this.form.submit()"
            >
                <option value="recomendados" <?php echo $orden === 'recomendados' ? 'selected' : ''; ?>>
                    Recomendados
                </option>

                <option value="precio_asc" <?php echo $orden === 'precio_asc' ? 'selected' : ''; ?>>
                    Precio: menor a mayor
                </option>

                <option value="precio_desc" <?php echo $orden === 'precio_desc' ? 'selected' : ''; ?>>
                    Precio: mayor a menor
                </option>

                <option value="nombre_asc" <?php echo $orden === 'nombre_asc' ? 'selected' : ''; ?>>
                    Nombre: A → Z
                </option>

                <option value="nombre_desc" <?php echo $orden === 'nombre_desc' ? 'selected' : ''; ?>>
                    Nombre: Z → A
                </option>
            </select>

            <noscript>
                <button type="submit" class="rank-sort-button">
                    Ordenar
                </button>
            </noscript>

        </form>


        <!-- ==================================================
             TIENDA DE RANGOS
             ================================================== -->

        <div class="store-grid">

            <?php foreach ($rangos as $rango): ?>

                <div class="product-card">

                    <img
                        src="<?php echo e($rango['imagen']); ?>"
                        alt="Rango <?php echo e($rango['nombre']); ?>"
                        class="product-img"
                    >

                    <h3 class="product-title">
                        <?php echo e($rango['nombre']); ?>
                    </h3>

                    <div class="product-timer">
                        3d 23:45:36
                    </div>

                    <div class="product-pricing">

                        <span class="product-price-old">
                            <?php echo number_format($rango['precio_anterior'], 2, '.', ''); ?>
                        </span>

                        <span class="product-price">
                            <?php echo number_format($rango['precio'], 2, '.', ''); ?>
                        </span>

                        <span class="product-currency">
                            USD
                        </span>

                    </div>

                    <div class="product-actions">

                        <button
                            type="button"
                            class="btn-info"
                            title="Más Información"
                            data-rango="<?php echo e($rango['id']); ?>"
                        >
                            i
                        </button>

                        <a
                            href="agregar carrito.php"
                            class="btn-add-cart"
                            data-product="<?php echo e($rango['id']); ?>"
                        >
                            Agregar
                        </a>

                    </div>

                </div>

            <?php endforeach; ?>

        </div>

    </section>


    <!-- ==================================================
         MODAL DE INFORMACIÓN
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
                        alt="Rango"
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
                        AGREGAR
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


</body>
</html>

