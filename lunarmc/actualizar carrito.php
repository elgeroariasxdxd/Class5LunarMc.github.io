<?php

require_once __DIR__ . '/config.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}


/* ==========================================================
   VALIDAR PETICIÓN
   ========================================================== */

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {

    header('Location: carrito.php');
    exit;

}


$producto =
    isset($_POST['producto'])
        ? (string) $_POST['producto']
        : '';


$cambio =
    isset($_POST['cambio'])
        ? (int) $_POST['cambio']
        : 0;


/* ==========================================================
   VALIDAR CARRITO
   ========================================================== */

if (
    $producto === '' ||
    !isset($_SESSION['carrito']) ||
    !is_array($_SESSION['carrito']) ||
    !isset($_SESSION['carrito'][$producto])
) {

    header('Location: carrito.php');
    exit;

}


/* ==========================================================
   CANTIDAD ACTUAL
   ========================================================== */

$cantidad_actual =
    (int) (
        $_SESSION['carrito'][$producto]['cantidad']
        ?? 1
    );


/* ==========================================================
   CAMBIAR CANTIDAD
   ========================================================== */

if ($cambio > 0) {

    $cantidad_actual++;

} elseif ($cambio < 0) {

    $cantidad_actual--;

}


/* ==========================================================
   ELIMINAR SI LLEGA A CERO
   ========================================================== */

if ($cantidad_actual <= 0) {

    unset(
        $_SESSION['carrito'][$producto]
    );

} else {

    /*
     * Máximo 99 unidades para evitar cantidades absurdas.
     */

    $cantidad_actual =
        min(
            $cantidad_actual,
            99
        );


    $_SESSION['carrito'][$producto]['cantidad'] =
        $cantidad_actual;

}


/* ==========================================================
   REGRESAR AL CARRITO
   ========================================================== */

header('Location: carrito.php');
exit;