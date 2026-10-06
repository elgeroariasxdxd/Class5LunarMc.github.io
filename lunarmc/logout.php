
<?php

// Iniciar la sesión
session_start();

// Eliminar todos los datos de la sesión
$_SESSION = [];

// Destruir la sesión
session_destroy();

// Volver al inicio de sesión
header('Location: login.php');
exit;

?>

