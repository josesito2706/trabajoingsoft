<?php
include("../modelos/usuariosDAO.php");

// ✅ REGISTRAR USUARIO
if (isset($_POST['btnRegistrar'])) {
    // Recibe los valores correctamente
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';
    $rol = $_POST['rol'] ?? '';

    // Validación simple
    if ($username !== '' && $password !== '' && $rol !== '') {
        $m = insertarUsuario($username, $password, $rol);
    } else {
        $m = "❌ Faltan datos del formulario.";
    }

    // Redirige con mensaje
    header("Location: ../vistas/frmUsuariosRegistrados.php?m=" . urlencode($m));
    exit();

// ✅ ACTUALIZAR USUARIO
} elseif (isset($_POST['btnActualizar'])) {
    $id = $_POST['id'] ?? '';
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';
    $rol = $_POST['rol'] ?? '';

    $m = modificarUsuario($id, $username, $password, $rol);
    header("Location: ../vistas/frmUsuariosRegistrados.php?m=" . urlencode($m));
    exit();

// ✅ ELIMINAR USUARIO
} elseif (isset($_GET['accion']) && $_GET['accion'] === "eliminar" && isset($_GET['id'])) {
    $id = $_GET['id'];
    $m = eliminarUsuario($id);
    header("Location: ../vistas/frmUsuariosRegistrados.php?m=" . urlencode($m));
    exit;
}

// ✅ FUNCIONES AUXILIARES
function listaUsuarios() {
    return getUsuarios();
}

function consultarUsuarioPorId($id) {
    return consultarUsuario($id);
}
?>
