<?php
include("conexion.php");

// ✅ Insertar nuevo reporte
function insertarReporte($codigoR, $estadoR, $observacion, $fecha_seguimiento) {
    global $cn;
    $sql = "INSERT INTO TReporte (codigoR, estadoR, observacion, fecha_seguimiento) 
            VALUES ('$codigoR', '$estadoR', '$observacion', '$fecha_seguimiento')";
    
    if (mysqli_query($cn, $sql)) {
        return "✅ Reporte registrado con éxito.";
    } else {
        return "❌ Error al registrar el reporte: " . mysqli_error($cn);
    }
}

// ✅ Obtener todos los reportes
function getReportes() {
    global $cn;
    $sql = "SELECT * FROM TReporte";
    return mysqli_query($cn, $sql);
}

// ✅ Consultar un reporte por ID
function consultarReporte($idR) {
    global $cn;
    $sql = "SELECT * FROM TReporte WHERE idR = '$idR'";
    return mysqli_query($cn, $sql);
}

// ✅ Modificar datos del reporte
function modificarReporte($idR, $codigoR, $estadoR, $observacion, $fecha_seguimiento) {
    global $cn;
    $sql = "UPDATE TReporte 
            SET codigoR = '$codigoR', estadoR = '$estadoR', observacion = '$observacion', fecha_seguimiento = '$fecha_seguimiento' 
            WHERE idR = '$idR'";
    
    if (mysqli_query($cn, $sql)) {
        return "✅ Reporte actualizado correctamente.";
    } else {
        return "❌ No se pudo actualizar el reporte: " . mysqli_error($cn);
    }
}

// ✅ Eliminar reporte
function eliminarReporte($idR) {
    global $cn;
    $sql = "DELETE FROM TReporte WHERE idR = '$idR'";
    if (mysqli_query($cn, $sql)) {
        return "🗑️ Reporte eliminado exitosamente.";
    } else {
        return "❌ Error al eliminar el reporte: " . mysqli_error($cn);
    }
}
?>
