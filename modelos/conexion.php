<?php
// Configuración de base de datos para Railway
$host = $_ENV['MYSQL_HOST'] ?? 'localhost';
$username = $_ENV['MYSQL_USER'] ?? 'root';
$password = $_ENV['MYSQL_PASSWORD'] ?? '';
$database = $_ENV['MYSQL_DATABASE'] ?? 'bdsistema';
$port = $_ENV['MYSQL_PORT'] ?? 3306;

$cn = mysqli_connect($host, $username, $password, $database, $port);

if (!$cn) {
    die("❌ Error de conexión: " . mysqli_connect_error());
}

// Configurar charset UTF-8
mysqli_set_charset($cn, "utf8");
?>