<?php
// Conexión a tu base de datos (ajusta el nombre si no es 'clientes')
$conexion = new mysqli("localhost", "root", "", "bdsistema");

if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

if (isset($_GET['dni'])) {
    $dni = $conexion->real_escape_string($_GET['dni']);
    $sql = "SELECT * FROM TCliente WHERE dni = '$dni'";
    $resultado = $conexion->query($sql);

    if ($resultado->num_rows > 0) {
        $cliente = $resultado->fetch_assoc();
        echo "<strong>Nombre:</strong> " . htmlspecialchars($cliente['nombre']) . "<br>";
        echo "<strong>Correo:</strong> " . htmlspecialchars($cliente['correo']) . "<br>";
        echo "<strong>Teléfono:</strong> " . htmlspecialchars($cliente['telefono']);
    } else {
        echo "<span style='color:red;'>Cliente no encontrado.</span>";
    }
}

$conexion->close();
?>
