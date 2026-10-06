<?php

require_once __DIR__ . '/../config.php';


/* ==========================================================
   OBTENER PEDIDOS RECIENTES
   ========================================================== */

$pagos_recientes = [];


$conexion_pagos = new mysqli(
    DB_HOST,
    DB_USER,
    DB_PASS,
    DB_NAME
);


if (!$conexion_pagos->connect_error) {


    $conexion_pagos->set_charset('utf8mb4');


    $sql_pagos = "

        SELECT
            p.id,
            p.estado,
            u.nick

        FROM pedidos p

        INNER JOIN usuarios u
            ON u.id = p.usuario_id

        ORDER BY p.id DESC

        LIMIT 12

    ";


    $resultado_pagos =
        $conexion_pagos->query($sql_pagos);


    if ($resultado_pagos) {


        while (
            $fila_pago =
            $resultado_pagos->fetch_assoc()
        ) {

            $pagos_recientes[] =
                $fila_pago;

        }


        $resultado_pagos->free();

    }


    $conexion_pagos->close();

}

?>


<section class="recent-payments">


    <!-- ======================================================
         CABECERA
         ====================================================== -->

    <div class="recent-payments-header">


        <div class="recent-payments-icon">
            👥
        </div>


        <div>

            <h2 class="recent-payments-title">
                PAGOS RECIENTES
            </h2>


            <p class="recent-payments-subtitle">
                ¡Compra y aparecé acá!
            </p>

        </div>


    </div>



    <!-- ======================================================
         JUGADORES
         ====================================================== -->

    <div class="recent-payments-grid">


        <?php if (!empty($pagos_recientes)): ?>


            <?php foreach ($pagos_recientes as $pago): ?>


                <?php

                $nick_pago =
                    $pago['nick'] ?? 'Jugador';


                $skin_cabeza =
                    'https://mc-heads.net/avatar/' .
                    rawurlencode($nick_pago) .
                    '/48';

                ?>


                <div
                    class="recent-payment-user"
                    title="<?php

                    echo htmlspecialchars(
                        $nick_pago,
                        ENT_QUOTES,
                        'UTF-8'
                    );

                    ?>"
                >


                    <img
                        src="<?php

                        echo htmlspecialchars(
                            $skin_cabeza,
                            ENT_QUOTES,
                            'UTF-8'
                        );

                        ?>"
                        alt="Skin de <?php

                        echo htmlspecialchars(
                            $nick_pago,
                            ENT_QUOTES,
                            'UTF-8'
                        );

                        ?>"
                        loading="lazy"
                    >


                </div>


            <?php endforeach; ?>


        <?php else: ?>


            <div class="recent-payment-empty">

                Todavía no hay compras registradas.

            </div>


        <?php endif; ?>


    </div>


</section>