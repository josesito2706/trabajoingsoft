<?php
include("../modelos/reporteDAO.php");

// ✅ MODIFICAR REPORTE
if (isset($_POST['btnActualizar'])) {
    $idR = $_POST['idR'];
    $codigoR = $_POST['codigoR'];
    $estadoR = $_POST['estadoR'];
    $observacion = $_POST['observacion'];
    $fecha_seguimiento = $_POST['fecha_seguimiento'];

    $m = modificarReporte($idR, $codigoR, $estadoR, $observacion, $fecha_seguimiento);
    header("Location: ../vistas/frmReporteSolicitudesRegistradas.php?m=$m");
    exit();
}

// ✅ ELIMINAR REPORTE
if (isset($_GET['accion']) && $_GET['accion'] == "eliminar" && isset($_GET['idR'])) {
    $idR = $_GET['idR'];
    $m = eliminarReporte($idR);
    header("Location: ../vistas/frmReporteSolicitudesRegistradas.php?m=$m");
    exit();
}

// ✅ REGISTRAR NUEVO REPORTE
if (isset($_POST['codigoR']) && !isset($_POST['idR'])) {
    $codigoR = $_POST['codigoR'];
    $estadoR = $_POST['estadoR'];
    $observacion = $_POST['observacion'];
    $fecha_seguimiento = $_POST['fecha_seguimiento'];

    $m = insertarReporte($codigoR, $estadoR, $observacion, $fecha_seguimiento);
    header("Location: ../vistas/frmReporteSolicitudesRegistradas.php?m=$m");
    exit();
}

// ✅ FUNCIONES AUXILIARES
function listaReportes() {
    return getReportes();
}

function consultarReportePorId($idR) {
    return consultarReporte($idR);
}
?>
