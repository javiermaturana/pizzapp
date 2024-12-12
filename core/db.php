<?php
require_once __DIR__ . '/../env.php';

if (ENVIRONMENT === 'local') {
    require_once __DIR__ . '/../config.php';
}

$servername = getenv('DB_SERVERNAME');
    $dbUser = getenv('DB_USER');
    $dbPass = getenv('DB_PASS');
    $dbName = getenv('DB_NAME');

// Crear conexión
$conn = new mysqli($servername, $dbUser, $dbPass, $dbName);

if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}
?>
