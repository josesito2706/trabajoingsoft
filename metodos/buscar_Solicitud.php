<?php

$conexion = new mysqli("localhost", "root", "", "bdsistema");

if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}
if (isset($_GET['codigo'])) {
    $codigo = $conexion->real_escape_string($_GET['codigo']);

    $query = "SELECT descripcion, estado, cliente_dni, fecha_registro FROM TSolicitudes WHERE codigo = '$codigo'";
    $resultado = $conexion->query($query);

    if ($resultado && $resultado->num_rows > 0) {
        $solicitud = $resultado->fetch_assoc();
        echo "<strong>Descripción:</strong> " . htmlspecialchars($solicitud['descripcion']) . "<br>";
        echo "<strong>Estado:</strong> " . htmlspecialchars($solicitud['estado']) . "<br>";
        echo "<strong>DNI Cliente: </strong>" . htmlspecialchars($solicitud['cliente_dni']) . "<br>";
        echo "<strong>Fecha de Registro:</strong> " . htmlspecialchars($solicitud['fecha_registro']);
    } else {
        echo "<span style='color:red;'>Solicitud no encontrada.</span>";
    }

    $conexion->close();
} else {
    echo "<span style='color:red;'>Código no proporcionado.</span>";
}
?>
