<?php
/*
 * CLASE 5 - INTERACCIÓN GET
 * El usuario selecciona el tipo de ayuda.
 * Ejemplo:
 * index.php?faq=compra_no_llego#preguntas-frecuentes
 */

$faqSeleccionada = filter_input(
    INPUT_GET,
    'faq',
    FILTER_UNSAFE_RAW,
    FILTER_REQUIRE_SCALAR
);

$faqSeleccionada = is_string($faqSeleccionada)
    ? trim($faqSeleccionada)
    : '';

$faqPermitidas = [
    'compra_no_llego',
    'comprar_rango',
    'problema_rango',
    'duda_compra',
    'otro'
];

/*
 * Lista blanca:
 * si alguien modifica manualmente ?faq= con un valor
 * que no permitimos, se descarta.
 */
if (
    $faqSeleccionada !== '' &&
    !in_array($faqSeleccionada, $faqPermitidas, true)
) {
    $faqSeleccionada = '';
}

/*
 * Función para escapar texto antes de mostrarlo en HTML.
 * Ayuda a prevenir XSS.
 */
if (!function_exists('faqEscapar')) {
    function faqEscapar(string $valor): string
    {
        return htmlspecialchars(
            $valor,
            ENT_QUOTES | ENT_SUBSTITUTE,
            'UTF-8'
        );
    }
}

$faqInfo = [
    'compra_no_llego' => [
        'titulo' => 'Mi compra todavía no llegó',
        'descripcion' => 'Si realizaste una compra y todavía no apareció en el servidor, completá los datos de abajo para revisar tu caso.'
    ],

    'comprar_rango' => [
        'titulo' => '¿Cómo comprar un rango?',
        'descripcion' => 'Seleccioná el rango que quieras en la tienda, agregalo al carrito y continuá con el proceso de compra.'
    ],

    'problema_rango' => [
        'titulo' => 'Tengo un problema con mi rango',
        'descripcion' => 'Si tu rango no se activó correctamente o presenta algún inconveniente, completá los datos para identificar tu cuenta.'
    ],

    'duda_compra' => [
        'titulo' => 'Tengo una duda sobre una compra',
        'descripcion' => 'Podés indicarnos tu nick y explicar qué duda tenés sobre tu compra.'
    ],

    'otro' => [
        'titulo' => 'Tengo otro problema',
        'descripcion' => 'Si tu problema no aparece entre las opciones anteriores, contanos brevemente qué sucede.'
    ]
];
?>

<section
    id="preguntas-frecuentes"
    class="faq-help-section"
>

    <h3 class="faq-help-title">
        Preguntas Frecuentes
    </h3>

    <p class="faq-help-intro">
        Seleccioná el tipo de consulta con el que necesitás ayuda.
    </p>

    <!-- FORMULARIO GET -->
    <form
        method="GET"
        action=""
        class="faq-get-form"
    >

        <div class="faq-form-group">

            <label for="faq" class="faq-form-label">
                ¿Con qué necesitás ayuda?
            </label>

            <select
                name="faq"
                id="faq"
                class="faq-select"
                required
            >

                <option value="">
                    Seleccioná una opción...
                </option>

                <option
                    value="compra_no_llego"
                    <?php echo $faqSeleccionada === 'compra_no_llego' ? 'selected' : ''; ?>
                >
                    Mi compra todavía no llegó
                </option>

                <option
                    value="comprar_rango"
                    <?php echo $faqSeleccionada === 'comprar_rango' ? 'selected' : ''; ?>
                >
                    ¿Cómo comprar un rango?
                </option>

                <option
                    value="problema_rango"
                    <?php echo $faqSeleccionada === 'problema_rango' ? 'selected' : ''; ?>
                >
                    Tengo un problema con mi rango
                </option>

                <option
                    value="duda_compra"
                    <?php echo $faqSeleccionada === 'duda_compra' ? 'selected' : ''; ?>
                >
                    Tengo una duda sobre una compra
                </option>

                <option
                    value="otro"
                    <?php echo $faqSeleccionada === 'otro' ? 'selected' : ''; ?>
                >
                    Otro problema
                </option>

            </select>

        </div>

        <button
            type="submit"
            class="faq-get-button"
        >
            Ver ayuda
        </button>

    </form>


    <?php if (
        $faqSeleccionada !== '' &&
        isset($faqInfo[$faqSeleccionada])
    ): ?>

        <?php
        $informacion = $faqInfo[$faqSeleccionada];
        ?>

        <div class="faq-result">

            <h4 class="faq-result-title">
                <?php echo faqEscapar($informacion['titulo']); ?>
            </h4>

            <p class="faq-result-description">
                <?php echo faqEscapar($informacion['descripcion']); ?>
            </p>


            <?php if (
                in_array(
                    $faqSeleccionada,
                    [
                        'compra_no_llego',
                        'problema_rango',
                        'duda_compra',
                        'otro'
                    ],
                    true
                )
            ): ?>

                <div class="faq-support-box">

                    <h5 class="faq-support-title">
                        Contanos tu problema
                    </h5>

                    <div class="faq-support-group">

                        <label
                            for="faq-nick"
                            class="faq-support-label"
                        >
                            Nick de Minecraft
                        </label>

                        <input
                            type="text"
                            id="faq-nick"
                            class="faq-support-input"
                            placeholder="Ej: Elzeta"
                            maxlength="16"
                        >

                    </div>

                    <div class="faq-support-group">

                        <label
                            for="faq-duda"
                            class="faq-support-label"
                        >
                            ¿Cuál es tu duda?
                        </label>

                        <textarea
                            id="faq-duda"
                            class="faq-support-textarea"
                            placeholder="Explicá brevemente qué ocurrió..."
                            maxlength="500"
                        ></textarea>

                    </div>

                    <p class="faq-support-note">
                        Estos campos aparecen según la opción seleccionada.
                    </p>

                </div>

            <?php endif; ?>

        </div>

    <?php endif; ?>

</section>