
<?php

require_once __DIR__ . '/config.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}


/*
|--------------------------------------------------------------------------
| COMPROBAR SESIÓN
|--------------------------------------------------------------------------
*/

if (!isset($_SESSION['usuario_id'])) {
    header('Location: login.php');
    exit;
}


/*
|--------------------------------------------------------------------------
| OBTENER ID DEL PEDIDO
|--------------------------------------------------------------------------
*/

$pedido_id = isset($_GET['id']) ? (int) $_GET['id'] : 0;

if ($pedido_id <= 0) {
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
| BUSCAR PEDIDO
|--------------------------------------------------------------------------
*/

$usuario_id = (int) $_SESSION['usuario_id'];

$stmt = $conexion->prepare("
    SELECT id, total, estado, fecha
    FROM pedidos
    WHERE id = ?
    AND usuario_id = ?
    LIMIT 1
");

$stmt->bind_param(
    'ii',
    $pedido_id,
    $usuario_id
);

$stmt->execute();

$resultado = $stmt->get_result();

$pedido = $resultado->fetch_assoc();

$stmt->close();


/*
|--------------------------------------------------------------------------
| COMPROBAR QUE EL PEDIDO EXISTA
|--------------------------------------------------------------------------
*/

if (!$pedido) {
    $conexion->close();

    header('Location: carrito.php');
    exit;
}


/*
|--------------------------------------------------------------------------
| OBTENER PRODUCTOS DEL PEDIDO
|--------------------------------------------------------------------------
*/

$stmt = $conexion->prepare("
    SELECT producto, precio, cantidad, subtotal
    FROM pedido_productos
    WHERE pedido_id = ?
");

$stmt->bind_param(
    'i',
    $pedido_id
);

$stmt->execute();

$resultado_productos = $stmt->get_result();

$productos = [];

while ($producto = $resultado_productos->fetch_assoc()) {
    $productos[] = $producto;
}

$stmt->close();

$conexion->close();

?>

<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Pedido realizado - LunarMC</title>

    <link
        rel="stylesheet"
        href="index-.css"
    >

</head>


<body class="dark-mode">


<?php include __DIR__ . '/includes/header.php'; ?>


<main class="main-container text-center">

    <section class="cart-section">


        <div class="cart-empty">


            <h2 class="gold-heading">
                ✅ ¡Pedido creado correctamente!
            </h2>


            <p>
                Tu pedido ha sido registrado en nuestro sistema.
            </p>


            <p>
                <strong>
                    Número de pedido:
                </strong>

                #<?php echo $pedido['id']; ?>
            </p>


            <p>
                <strong>
                    Estado:
                </strong>

                <?php echo htmlspecialchars(
                    ucfirst($pedido['estado']),
                    ENT_QUOTES,
                    'UTF-8'
                ); ?>
            </p>


            <p>
                <strong>
                    Fecha:
                </strong>

                <?php echo htmlspecialchars(
                    $pedido['fecha'],
                    ENT_QUOTES,
                    'UTF-8'
                ); ?>
            </p>


        </div>


        <div class="cart-container">


            <?php foreach ($productos as $producto): ?>


                <div class="cart-item">


                    <div class="cart-item-info">

                        <h3>
                            <?php echo htmlspecialchars(
                                $producto['producto'],
                                ENT_QUOTES,
                                'UTF-8'
                            ); ?>
                        </h3>


                        <p>
                            Precio:
                            $<?php echo number_format(
                                $producto['precio'],
                                2
                            ); ?>
                            USD
                        </p>


                        <p>
                            Cantidad:
                            <?php echo $producto['cantidad']; ?>
                        </p>

                    </div>


                    <div class="cart-item-total">

                        <strong>
                            $<?php echo number_format(
                                $producto['subtotal'],
                                2
                            ); ?>
                            USD
                        </strong>

                    </div>


                </div>


            <?php endforeach; ?>


            <div class="cart-summary">


                <h3>
                    Total:
                    $<?php echo number_format(
                        $pedido['total'],
                        2
                    ); ?>
                    USD
                </h3>


                <div class="cart-actions">


                    <a
                        href="rangos.php"
                        class="btn-add-cart"
                    >
                        ← Volver a rangos
                    </a>


                    <a
                        href="panel.php"
                        class="btn-cart"
                    >
                        👤 Mi cuenta
                    </a>


                </div>


            </div>


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

