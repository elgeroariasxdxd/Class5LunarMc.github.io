<?php

require_once __DIR__ . '/includes/database.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: registro.php');
    exit;
}


/* ==========================================
   1. RECIBIR DATOS DEL FORMULARIO
   ========================================== */

$nick = trim($_POST['username'] ?? '');
$email = trim($_POST['email'] ?? '');
$password = $_POST['password'] ?? '';
$gender = trim($_POST['gender'] ?? '');


/* ==========================================
   2. VALIDAR DATOS
   ========================================== */

if (
    $nick === '' ||
    $email === '' ||
    $password === '' ||
    $gender === ''
) {
    die('Todos los campos son obligatorios.');
}


if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    die('El correo electrónico no es válido.');
}


if (strlen($password) < 8) {
    die('La contraseña debe tener al menos 8 caracteres.');
}


if (strlen($nick) > 50) {
    die('El nombre de usuario es demasiado largo.');
}


/* ==========================================
   3. COMPROBAR SI NICK O EMAIL YA EXISTEN
   ========================================== */

$sql = "
    SELECT id
    FROM usuarios
    WHERE nick = :nick
       OR email = :email
    LIMIT 1
";

$stmt = $pdo->prepare($sql);

$stmt->execute([
    ':nick' => $nick,
    ':email' => $email
]);

$usuarioExistente = $stmt->fetch();


if ($usuarioExistente) {
    die('El nick o el correo electrónico ya están registrados.');
}


/* ==========================================
   4. ENCRIPTAR LA CONTRASEÑA
   ========================================== */

$passwordHash = password_hash(
    $password,
    PASSWORD_DEFAULT
);


/* ==========================================
   5. GUARDAR USUARIO EN MYSQL
   ========================================== */

$sql = "
    INSERT INTO usuarios (
        nick,
        email,
        password,
        gender
    )
    VALUES (
        :nick,
        :email,
        :password,
        :gender
    )
";

$stmt = $pdo->prepare($sql);

$stmt->execute([
    ':nick' => $nick,
    ':email' => $email,
    ':password' => $passwordHash,
    ':gender' => $gender
]);


/* ==========================================
   6. MOSTRAR CONFIRMACIÓN
   ========================================== */

?>

<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Registro completado - LunarMC</title>

    <link
        rel="stylesheet"
        href="index-.css"
    >

</head>

<body class="dark-mode">

    <main
        style="
            max-width: 700px;
            margin: 100px auto;
            padding: 40px;
            text-align: center;
        "
    >

        <h1 style="color: #F1C40F;">
            ¡Registro completado!
        </h1>

        <p>
            Tu cuenta fue registrada correctamente.
        </p>

        <p>
            Bienvenido a LunarMC,
            <strong>
                <?php echo htmlspecialchars($nick); ?>
            </strong>.
        </p>

        <br>

        <a
            href="registro.php"
            class="btn-submit-register"
        >
            Volver al registro
        </a>

    </main>

</body>

</html>