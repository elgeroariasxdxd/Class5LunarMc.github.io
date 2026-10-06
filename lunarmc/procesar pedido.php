<?php

require_once __DIR__ . '/config.php';

date_default_timezone_set('America/Argentina/Buenos_Aires');

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}


/*
|--------------------------------------------------------------------------
| COMPROBAR QUE EL USUARIO ESTÉ LOGUEADO
|--------------------------------------------------------------------------
*/

if (!isset($_SESSION['usuario_id'])) {
    header('Location: login.php');
    exit;
}


/*
|--------------------------------------------------------------------------
| COMPROBAR QUE HAYA PRODUCTOS EN EL CARRITO
|--------------------------------------------------------------------------
*/

$carrito = $_SESSION['carrito'] ?? [];

if (empty($carrito)) {
    header('Location: carrito.php');
    exit;
}


/*
|--------------------------------------------------------------------------
| CONEXIÓN A MYSQL
|--------------------------------------------------------------------------
*/

$conexion = new mysqli(
    DB_HOST,
    DB_USER,
    DB_PASS,
    DB_NAME
);

if ($conexion->connect_error) {
    die('Error de conexión con la base de datos.');
}

$conexion->set_charset('utf8mb4');


/*
|--------------------------------------------------------------------------
| CALCULAR TOTAL
|--------------------------------------------------------------------------
*/

$total = 0;

foreach ($carrito as $producto) {

    $precio = (float) $producto['precio'];
    $cantidad = (int) $producto['cantidad'];

    $total += $precio * $cantidad;
}


/*
|--------------------------------------------------------------------------
| PRODUCTOS QUE SON RANGOS
|--------------------------------------------------------------------------
*/

$rangos = [
    'sun',
    'venus',
    'venus_plus',
    'nova',
    'lunar',
    'summer'
];


/*
|--------------------------------------------------------------------------
| PRODUCTOS QUE SON EXTRAS
|--------------------------------------------------------------------------
*/

$extras = [
    'tags',
    'kill_effects',
    'llave_todo_o_nada'
];


/*
|--------------------------------------------------------------------------
| CALCULAR AUMENTO DE LA META
|--------------------------------------------------------------------------
|
| Rango = +5%
| Extra = +3%
|
*/

$aumento_meta = 0;

foreach ($carrito as $producto_id => $producto) {

    $cantidad = (int) $producto['cantidad'];

    if ($cantidad <= 0) {
        continue;
    }


    /*
    | RANGO
    */

    if (in_array($producto_id, $rangos, true)) {

        $aumento_meta += 5 * $cantidad;
    }


    /*
    | EXTRA
    */

    elseif (in_array($producto_id, $extras, true)) {

        $aumento_meta += 3 * $cantidad;
    }
}


/*
|--------------------------------------------------------------------------
| ID DEL USUARIO
|--------------------------------------------------------------------------
*/

$usuario_id = (int) $_SESSION['usuario_id'];


/*
|--------------------------------------------------------------------------
| COMENZAR TRANSACCIÓN
|--------------------------------------------------------------------------
*/

$conexion->begin_transaction();

try {


    /*
    |--------------------------------------------------------------------------
    | CREAR PEDIDO
    |--------------------------------------------------------------------------
    */

    $stmt = $conexion->prepare("
        INSERT INTO pedidos
        (usuario_id, total, estado)
        VALUES (?, ?, 'pendiente')
    ");

    if (!$stmt) {
        throw new Exception('No se pudo preparar el pedido.');
    }

    $stmt->bind_param(
        'id',
        $usuario_id,
        $total
    );

    if (!$stmt->execute()) {
        throw new Exception('No se pudo crear el pedido.');
    }

    $pedido_id = $conexion->insert_id;

    $stmt->close();


    /*
    |--------------------------------------------------------------------------
    | INSERTAR PRODUCTOS DEL PEDIDO
    |--------------------------------------------------------------------------
    */

    $stmt_producto = $conexion->prepare("
        INSERT INTO pedido_productos
        (pedido_id, producto, precio, cantidad, subtotal)
        VALUES (?, ?, ?, ?, ?)
    ");

    if (!$stmt_producto) {
        throw new Exception('No se pudo preparar los productos.');
    }


    foreach ($carrito as $producto) {

        $nombre = $producto['nombre'];
        $precio = (float) $producto['precio'];
        $cantidad = (int) $producto['cantidad'];

        $subtotal = $precio * $cantidad;


        $stmt_producto->bind_param(
            'isdid',
            $pedido_id,
            $nombre,
            $precio,
            $cantidad,
            $subtotal
        );


        if (!$stmt_producto->execute()) {
            throw new Exception('No se pudo guardar un producto.');
        }
    }


    $stmt_producto->close();


    /*
    |--------------------------------------------------------------------------
    | OBTENER MES ACTUAL
    |--------------------------------------------------------------------------
    */

    $mes_actual = date('Y-m');


    /*
    |--------------------------------------------------------------------------
    | CREAR META DEL MES SI NO EXISTE
    |--------------------------------------------------------------------------
    */

    $stmt_meta = $conexion->prepare("
        INSERT INTO meta_mensual
        (mes, porcentaje)
        VALUES (?, 0)
        ON DUPLICATE KEY UPDATE mes = mes
    ");

    if (!$stmt_meta) {
        throw new Exception('No se pudo preparar la meta mensual.');
    }

    $stmt_meta->bind_param(
        's',
        $mes_actual
    );

    if (!$stmt_meta->execute()) {
        throw new Exception('No se pudo crear la meta mensual.');
    }

    $stmt_meta->close();


    /*
    |--------------------------------------------------------------------------
    | OBTENER PORCENTAJE ACTUAL
    |--------------------------------------------------------------------------
    */

    $stmt_meta = $conexion->prepare("
        SELECT porcentaje
        FROM meta_mensual
        WHERE mes = ?
        FOR UPDATE
    ");

    if (!$stmt_meta) {
        throw new Exception('No se pudo consultar la meta mensual.');
    }

    $stmt_meta->bind_param(
        's',
        $mes_actual
    );

    if (!$stmt_meta->execute()) {
        throw new Exception('No se pudo obtener la meta mensual.');
    }

    $resultado_meta = $stmt_meta->get_result();

    $fila_meta = $resultado_meta->fetch_assoc();

    $stmt_meta->close();


    /*
    |--------------------------------------------------------------------------
    | PORCENTAJE ACTUAL
    |--------------------------------------------------------------------------
    */

    $porcentaje_actual = $fila_meta
        ? (float) $fila_meta['porcentaje']
        : 0;


    /*
    |--------------------------------------------------------------------------
    | SUMAR EL NUEVO PORCENTAJE
    |--------------------------------------------------------------------------
    */

    $nuevo_porcentaje = $porcentaje_actual + $aumento_meta;


    /*
    |--------------------------------------------------------------------------
    | NO SUPERAR 100%
    |--------------------------------------------------------------------------
    */

    if ($nuevo_porcentaje > 100) {
        $nuevo_porcentaje = 100;
    }


    /*
    |--------------------------------------------------------------------------
    | ACTUALIZAR META MENSUAL
    |--------------------------------------------------------------------------
    */

    $stmt_meta = $conexion->prepare("
        UPDATE meta_mensual
        SET porcentaje = ?
        WHERE mes = ?
    ");

    if (!$stmt_meta) {
        throw new Exception('No se pudo actualizar la meta mensual.');
    }

    $stmt_meta->bind_param(
        'ds',
        $nuevo_porcentaje,
        $mes_actual
    );

    if (!$stmt_meta->execute()) {
        throw new Exception('No se pudo actualizar la meta mensual.');
    }

    $stmt_meta->close();


    /*
    |--------------------------------------------------------------------------
    | CONFIRMAR TODA LA TRANSACCIÓN
    |--------------------------------------------------------------------------
    */

    $conexion->commit();


    /*
    |--------------------------------------------------------------------------
    | VACIAR CARRITO
    |--------------------------------------------------------------------------
    */

    unset($_SESSION['carrito']);


    /*
    |--------------------------------------------------------------------------
    | IR A PEDIDO EXITOSO
    |--------------------------------------------------------------------------
    */

    header(
        'Location: pedido_exitoso.php?id=' . $pedido_id
    );

    exit;


} catch (Exception $e) {


    /*
    |--------------------------------------------------------------------------
    | SI ALGO FALLA, DESHACER TODO
    |--------------------------------------------------------------------------
    */

    $conexion->rollback();

    die(
        'No se pudo crear el pedido. ' .
        htmlspecialchars(
            $e->getMessage(),
            ENT_QUOTES,
            'UTF-8'
        )
    );
}


$conexion->close();

?>
