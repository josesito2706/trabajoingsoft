<?php
include("../modelos/solicitudDAO.php");

// ✅ MODIFICAR SOLICITUD
if (isset($_POST['btnActualizar'])) {
    $idS = $_POST['idS'];
    $codigo = $_POST['codigo'];
    $descripcion = $_POST['descripcion'];
    $fecha_registro = $_POST['fecha_registro'];
    $estado = $_POST['estado'];
    $cliente_dni = $_POST['cliente_dni'];

    $m = modificarSolicitud($idS, $codigo, $descripcion, $fecha_registro, $estado, $cliente_dni);
    header("Location: ../vistas/frmSolicitudesRegistradas.php?m=$m");
    exit();
}

// ✅ ELIMINAR SOLICITUD
if (isset($_GET['accion']) && $_GET['accion'] == "eliminar" && isset($_GET['idS'])) {
    $idS = $_GET['idS'];
    $m = eliminarSolicitud($idS);
    header("Location: ../vistas/frmSolicitudesRegistradas.php?m=$m");
    exit();
}

// ✅ REGISTRAR NUEVA SOLICITUD
if (isset($_POST['codigo']) && !isset($_POST['idS'])) {
    $codigo = $_POST['codigo'];
    $descripcion = $_POST['descripcion'];
    $fecha_registro = $_POST['fecha_registro'];
    $estado = $_POST['estado'];
    $cliente_dni = $_POST['cliente_dni'];

    $m = insertarSolicitud($codigo, $descripcion, $fecha_registro, $estado, $cliente_dni);
    header("Location: ../vistas/frmSolicitudesRegistradas.php?m=$m");
    exit();
}

// ✅ FUNCIONES AUXILIARES
function listaSolicitudes() {
    return getSolicitudes();
}

function consultarSolicitudPorId($idS) {
    return consultarSolicitud($idS);
}
?>
