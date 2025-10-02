<?php
include("conexion.php");

// ✅ Insertar nueva solicitud
function insertarSolicitud($codigo, $descripcion, $fecha_registro, $estado, $cliente_dni) {
    global $cn;
    $sql = "INSERT INTO TSolicitudes (codigo, descripcion, fecha_registro, estado, cliente_dni) 
            VALUES ('$codigo', '$descripcion', '$fecha_registro', '$estado', '$cliente_dni')";
    if (mysqli_query($cn, $sql)) {
        return "✅ Solicitud registrada con éxito.";
    } else {
        return "❌ Error al registrar la solicitud: "  . mysqli_error($cn);;
    }
}

// ✅ Obtener todas las solicitudes
function getSolicitudes() {
    global $cn;
    $sql = "SELECT * FROM TSolicitudes";
    return mysqli_query($cn, $sql);
}

// ✅ Consultar una solicitud por ID
function consultarSolicitud($idS) {
    global $cn;
    $sql = "SELECT * FROM TSolicitudes WHERE idS = '$idS'";
    return mysqli_query($cn, $sql);
}

// ✅ Modificar solicitud
function modificarSolicitud($idS, $codigo, $descripcion, $fecha_registro, $estado, $cliente_dni) {
    global $cn;
    $sql = "UPDATE TSolicitudes SET 
            codigo='$codigo', 
            descripcion='$descripcion', 
            fecha_registro='$fecha_registro', 
            estado='$estado', 
            cliente_dni='$cliente_dni' 
            WHERE idS='$idS'";
    return mysqli_query($cn, $sql) ? "✅ Solicitud modificada correctamente." : "❌ Error al modificar solicitud.";
}


// ✅ Eliminar solicitud
function eliminarSolicitud($idS) {
    global $cn;
    $sql = "DELETE FROM TSolicitudes WHERE idS = '$idS'";
    if (mysqli_query($cn, $sql)) {
        return "🗑️ Solicitud eliminada exitosamente.";
    } else {
        return "❌ Error al eliminar la solicitud: " . mysqli_error($cn);
    }
}
?>
