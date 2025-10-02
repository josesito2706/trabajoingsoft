<?php
// Archivo de prueba para verificar que PHP funciona
echo "PHP está funcionando correctamente!<br>";
echo "Versión de PHP: " . phpversion() . "<br>";
echo "Extensiones cargadas: " . implode(", ", get_loaded_extensions()) . "<br>";

// Verificar conexión a base de datos
try {
    $host = $_ENV['MYSQL_HOST'] ?? 'localhost';
    $username = $_ENV['MYSQL_USER'] ?? 'root';
    $password = $_ENV['MYSQL_PASSWORD'] ?? '';
    $database = $_ENV['MYSQL_DATABASE'] ?? 'bdsistema';
    $port = $_ENV['MYSQL_PORT'] ?? 3306;
    
    echo "Intentando conectar a la base de datos...<br>";
    echo "Host: " . $host . "<br>";
    echo "Usuario: " . $username . "<br>";
    echo "Base de datos: " . $database . "<br>";
    
    $cn = mysqli_connect($host, $username, $password, $database, $port);
    
    if ($cn) {
        echo "✅ Conexión a la base de datos exitosa!<br>";
        mysqli_close($cn);
    } else {
        echo "❌ Error de conexión: " . mysqli_connect_error() . "<br>";
    }
} catch (Exception $e) {
    echo "❌ Error: " . $e->getMessage() . "<br>";
}

echo "<br>Variables de entorno disponibles:<br>";
foreach ($_ENV as $key => $value) {
    if (strpos($key, 'MYSQL') !== false) {
        echo $key . ": " . $value . "<br>";
    }
}
?>
