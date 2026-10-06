<?php

require_once __DIR__ . '/config.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}


/* ==========================================================
   LUNARMC - AGREGAR PRODUCTO AL CARRITO
   POST + VALIDACIÓN + PROTECCIÓN CSRF
   ========================================================== */


/* ==========================================================
   RESPUESTA JSON
   ========================================================== */

function responderJson(
    array $datos,
    int $estado = 200
): void {

    http_response_code($estado);

    header(
        'Content-Type: application/json; charset=utf-8'
    );

    echo json_encode(
        $datos,
        JSON_UNESCAPED_UNICODE |
        JSON_UNESCAPED_SLASHES
    );

    exit;

}


/* ==========================================================
   DETECTAR PETICIÓN AJAX
   ========================================================== */

$es_ajax =
    (
        isset($_POST['ajax']) &&
        $_POST['ajax'] === '1'
    ) ||
    (
        isset(
            $_SERVER['HTTP_X_REQUESTED_WITH']
        ) &&
        strtolower(
            (string)
            $_SERVER['HTTP_X_REQUESTED_WITH']
        ) === 'xmlhttprequest'
    );


/* ==========================================================
   SOLO SE PERMITE POST
   ========================================================== */

if (
    !isset($_SERVER['REQUEST_METHOD']) ||
    $_SERVER['REQUEST_METHOD'] !== 'POST'
) {

    if ($es_ajax) {

        responderJson(
            [
                'ok' => false,
                'mensaje' =>
                    'Método no permitido.'
            ],
            405
        );

    }


    http_response_code(405);

    header(
        'Allow: POST'
    );

    exit(
        'Método no permitido.'
    );

}


/* ==========================================================
   VALIDAR TOKEN CSRF
   ========================================================== */

$csrf_recibido =
    isset($_POST['csrf_token'])
        ? (string)
            $_POST['csrf_token']
        : '';


$csrf_sesion =
    isset($_SESSION['csrf_token'])
        ? (string)
            $_SESSION['csrf_token']
        : '';


if (
    $csrf_recibido === '' ||
    $csrf_sesion === '' ||
    !hash_equals(
        $csrf_sesion,
        $csrf_recibido
    )
) {

    if ($es_ajax) {

        responderJson(
            [
                'ok' => false,

                'mensaje' =>
                    'La solicitud de seguridad no es válida. Recargá la página e intentá otra vez.'
            ],
            403
        );

    }


    http_response_code(403);

    exit(
        'Solicitud no válida.'
    );

}


/* ==========================================================
   CATÁLOGO DE PRODUCTOS
   ========================================================== */

$productos = [

    'sun' => [

        'nombre' =>
            'Sun',

        'precio' =>
            2.99,

        'imagen' =>
            'sun rango.png'

    ],


    'venus' => [

        'nombre' =>
            'Venus',

        'precio' =>
            5.99,

        'imagen' =>
            'rango venus.png'

    ],


    'venus_plus' => [

        'nombre' =>
            'Venus +',

        'precio' =>
            9.99,

        'imagen' =>
            'rango venus +.png'

    ],


    'nova' => [

        'nombre' =>
            'Nova',

        'precio' =>
            14.99,

        'imagen' =>
            'rango nova.png'

    ],


    'lunar' => [

        'nombre' =>
            'Lunar',

        'precio' =>
            16.99,

        'imagen' =>
            'rango lunar.png'

    ],


    'summer' => [

        'nombre' =>
            'Summer',

        'precio' =>
            20.99,

        'imagen' =>
            'rango summer.png'

    ],


    'tags' => [

        'nombre' =>
            'Tags',

        'precio' =>
            0,

        'imagen' =>
            'imagen de tags.png'

    ],


    'kill_effects' => [

        'nombre' =>
            'Kill Effects',

        'precio' =>
            0,

        'imagen' =>
            'imagen de kill efects.png'

    ],


    'llave_todo_o_nada' => [

        'nombre' =>
            'Llave Todo o Nada',

        'precio' =>
            0,

        'imagen' =>
            'llave todo o nada.png'

    ]

];


/* ==========================================================
   PRODUCTO RECIBIDO POR POST
   ========================================================== */

$id =
    isset($_POST['producto'])
        ? trim(
            (string)
            $_POST['producto']
        )
        : '';


/* ==========================================================
   VALIDAR FORMATO DEL ID
   ========================================================== */

$estructura_valida =
    $id !== '' &&
    preg_match(
        '/^[a-z0-9_]+$/D',
        $id
    ) === 1;


/* ==========================================================
   VALIDAR CONTRA PRODUCTOS REALES
   ========================================================== */

if (
    !$estructura_valida ||
    !isset($productos[$id])
) {

    if ($es_ajax) {

        responderJson(
            [
                'ok' =>
                    false,

                'mensaje' =>
                    'Producto no válido.'
            ],
            400
        );

    }


    http_response_code(400);

    exit(
        'Producto no válido.'
    );

}


/* ==========================================================
   CREAR CARRITO SI NO EXISTE
   ========================================================== */

if (
    !isset($_SESSION['carrito']) ||
    !is_array(
        $_SESSION['carrito']
    )
) {

    $_SESSION['carrito'] = [];

}


/* ==========================================================
   AGREGAR PRODUCTO
   ========================================================== */

if (
    isset(
        $_SESSION['carrito'][$id]
    )
) {

    $_SESSION['carrito'][$id]['cantidad'] =

        (int) (
            $_SESSION['carrito'][$id]['cantidad']
            ?? 1
        ) + 1;

} else {

    $_SESSION['carrito'][$id] = [

        'nombre' =>
            $productos[$id]['nombre'],

        'precio' =>
            $productos[$id]['precio'],

        'imagen' =>
            $productos[$id]['imagen'],

        'cantidad' =>
            1

    ];

}


/* ==========================================================
   PREPARAR DATOS DEL CARRITO
   ========================================================== */

$items = [];

$total = 0;

$cantidad_total = 0;


/* ==========================================================
   RECORRER CARRITO
   ========================================================== */

foreach (
    $_SESSION['carrito']
    as $producto_id => $producto
) {

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


    if ($cantidad < 1) {
        $cantidad = 1;
    }


    $subtotal =
        $precio *
        $cantidad;


    $total +=
        $subtotal;


    $cantidad_total +=
        $cantidad;


    $items[] = [

        'id' =>
            (string)
            $producto_id,


        'nombre' =>
            (string) (
                $producto['nombre']
                ?? 'Producto'
            ),


        'precio' =>
            $precio,


        'cantidad' =>
            $cantidad,


        'subtotal' =>
            $subtotal,


        'imagen' =>
            (string) (
                $producto['imagen']
                ?? ''
            )

    ];

}


/* ==========================================================
   RESPUESTA PARA EL MINI-CARRITO
   ========================================================== */

if ($es_ajax) {

    responderJson([

        'ok' =>
            true,


        'producto_agregado' =>
            $id,


        'cantidad_total' =>
            $cantidad_total,


        'total' =>
            $total,


        'items' =>
            $items

    ]);

}


/* ==========================================================
   SIN AJAX
   REDIRECCIÓN NORMAL AL CARRITO
   ========================================================== */

header(
    'Location: carrito.php',
    true,
    303
);

exit;
