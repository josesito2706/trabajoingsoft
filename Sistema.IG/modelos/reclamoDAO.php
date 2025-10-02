<?php
// reclamoDao.php
include("conexion.php");

// ✅ Insertar nuevo reclamo
function insertarReclamo($dni_cliente, $codigo_soli, $descripcionR, $fecha_reclamo) {
    global $cn;
    $sql = "INSERT INTO TReclamo (dni_cliente, codigo_soli, descripcionR, fecha_reclamo)
            VALUES (
              '" . mysqli_real_escape_string($cn, $dni_cliente) . "',
              '" . mysqli_real_escape_string($cn, $codigo_soli) . "',
              '" . mysqli_real_escape_string($cn, $descripcionR) . "',
              '" . mysqli_real_escape_string($cn, $fecha_reclamo) . "'
            )";
    if (mysqli_query($cn, $sql)) {
        return "✅ Reclamo registrado con éxito.";
    } else {
        return "❌ Error al registrar el reclamo: " . mysqli_error($cn);
    }
}

// ✅ Obtener todos los reclamos
function getReclamos() {
    global $cn;
    $sql = "SELECT * FROM TReclamo";
    return mysqli_query($cn, $sql);
}

// ✅ Consultar un reclamo por ID
function consultarReclamo($idreclamo) {
    global $cn;
    $id = mysqli_real_escape_string($cn, $idreclamo);
    $sql = "SELECT * FROM TReclamo WHERE idreclamo = '$id'";
    return mysqli_query($cn, $sql);
}

// ✅ Modificar reclamo
function modificarReclamo($idreclamo, $dni_cliente, $codigo_soli, $descripcionR, $fecha_reclamo) {
    global $cn;
    $sql = "UPDATE TReclamo SET
              dni_cliente   = '" . mysqli_real_escape_string($cn, $dni_cliente) . "',
              codigo_soli   = '" . mysqli_real_escape_string($cn, $codigo_soli) . "',
              descripcionR  = '" . mysqli_real_escape_string($cn, $descripcionR) . "',
              fecha_reclamo = '" . mysqli_real_escape_string($cn, $fecha_reclamo) . "'
            WHERE idreclamo = '" . mysqli_real_escape_string($cn, $idreclamo) . "'";
    if (mysqli_query($cn, $sql)) {
        return "✅ Reclamo modificado correctamente.";
    } else {
        return "❌ Error al modificar el reclamo: " . mysqli_error($cn);
    }
}

// ✅ Eliminar reclamo
function eliminarReclamo($idreclamo) {
    global $cn;
    $id = mysqli_real_escape_string($cn, $idreclamo);
    $sql = "DELETE FROM TReclamo WHERE idreclamo = '$id'";
    if (mysqli_query($cn, $sql)) {
        return "🗑️ Reclamo eliminado exitosamente.";
    } else {
        return "❌ Error al eliminar el reclamo: " . mysqli_error($cn);
    }
}
?>
