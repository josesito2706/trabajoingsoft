<?php
// controladores/reclamoController.php
include("../modelos/reclamoDao.php");

// ✅ MODIFICAR RECLAMO
if (isset($_POST['btnModificarReclamo'])) {
    $idreclamo     = $_POST['idreclamo'];
    $dni_cliente   = $_POST['dni_cliente'];
    $codigo_soli   = $_POST['codigo_soli'];
    $descripcionR  = $_POST['descripcionR'];
    $fecha_reclamo = $_POST['fecha_reclamo'];

    $m = modificarReclamo($idreclamo, $dni_cliente, $codigo_soli, $descripcionR, $fecha_reclamo);
    header("Location: ../vistas/frmReclamosRegistrados.php?m=" . urlencode($m));
    exit();
}

// ✅ ELIMINAR RECLAMO
if (
    isset($_GET['accion']) && $_GET['accion'] === "eliminar" &&
    isset($_GET['idreclamo'])
) {
    $idreclamo = $_GET['idreclamo'];
    $m = eliminarReclamo($idreclamo);
    header("Location: ../vistas/frmReclamosRegistrados.php?m=" . urlencode($m));
    exit();
}

// ✅ REGISTRAR NUEVO RECLAMO
if (isset($_POST['dni_cliente']) && !isset($_POST['idreclamo'])) {
    $dni_cliente   = $_POST['dni_cliente'];
    $codigo_soli   = $_POST['codigo_soli'];
    $descripcionR  = $_POST['descripcionR'];
    $fecha_reclamo = $_POST['fecha_reclamo'];

    $m = insertarReclamo($dni_cliente, $codigo_soli, $descripcionR, $fecha_reclamo);
    header("Location: ../vistas/frmReclamosRegistrados.php?m=" . urlencode($m));
    exit();
}

// ✅ FUNCIONES AUXILIARES
function listaReclamos() {
    return getReclamos();
}

function consultarReclamoPorId($idreclamo) {
    return consultarReclamo($idreclamo);
}
?>
