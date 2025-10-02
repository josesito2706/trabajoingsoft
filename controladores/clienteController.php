<?php
    include("../modelos/clienteDAO.php");

    // ✅ MODIFICAR CLIENTE
    if (isset($_POST['btnActualizar'])) {
        $idC = $_POST['idC'];
        $dni = $_POST['dni'];
        $nombre = $_POST['nombre'];
        $correo = $_POST['correo'];
        $telefono = $_POST['telefono'];

        $m = modificarCliente($idC, $dni, $nombre, $correo, $telefono);
        header("Location: ../vistas/frmClientesRegistrados.php?m=$m");

    // ✅ ELIMINAR CLIENTE SOLO SI VIENE CON accion=eliminar
    } else if (isset($_GET['accion']) && $_GET['accion'] == "eliminar" && isset($_GET['idC'])) {
        $idC = $_GET['idC'];
        $m = eliminarCliente($idC);
        header("Location: ../vistas/frmClientesRegistrados.php?m=$m");

    // ✅ REGISTRAR CLIENTE
    } else if (isset($_POST['dni'])) {
        $dni = $_POST['dni'];
        $nombre = $_POST['nombre'];
        $correo = $_POST['correo'];
        $telefono = $_POST['telefono'];

        $m = insertarCliente($dni, $nombre, $correo, $telefono);
        header("Location: ../vistas/frmClientesRegistrados.php?m=$m");
    }

    // ✅ FUNCIONES AUXILIARES
    function consultarClientePorId($idC) {
        return consultarCliente($idC);
    }

    function listaClientes() {
        return getClientes();
    }
?>
