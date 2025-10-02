<?php
include("conexion.php");

// Insertar nuevo cliente
function insertarCliente($dni, $nombre, $correo, $telefono) {
    global $cn;
    $sql = "INSERT INTO TCliente (dni, nombre, correo, telefono) VALUES ('$dni', '$nombre', '$correo', '$telefono')";
    if (mysqli_query($cn, $sql)) {
        return "¡Cliente registrado con éxito!";
    } else {
        return "❌ Error al registrar el cliente.";
    }
}

// Obtener todos los clientes
function getClientes() {
    global $cn;
    $sql = "SELECT * FROM TCliente";
    return mysqli_query($cn, $sql);
}

// Consultar un cliente por ID
function consultarCliente($idC) {
    global $cn;
    $sql = "SELECT * FROM TCliente WHERE idC = '$idC'";
    return mysqli_query($cn, $sql);
}

// Modificar datos del cliente
function modificarCliente($idC, $dni, $nombre, $correo, $telefono) {
    global $cn;
    $sql = "UPDATE TCliente SET dni='$dni', nombre='$nombre', correo='$correo', telefono='$telefono' WHERE idC='$idC'";
    if (mysqli_query($cn, $sql)) {
        return "✅ Cliente actualizado correctamente.";
    } else {
        return "❌ No se pudo actualizar el cliente.";
    }
}

// Eliminar cliente
function eliminarCliente($idC) {
    global $cn;
    $sql = "DELETE FROM tcliente WHERE idC='$idC'";
    if (mysqli_query($cn, $sql)) {
        return "🗑️ Cliente eliminado exitosamente.";
    } else {
        return "❌ Error al eliminar el cliente.";
    }
}
?>
