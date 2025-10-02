<?php
include("conexion.php");

// 🔒 Insertar usuario
function insertarUsuario($username, $password, $rol) {
    global $cn;

    // Verificar si ya existe el usuario
    $verificar = "SELECT * FROM TUsers WHERE username = '$username'";
    $resultado = mysqli_query($cn, $verificar);

    if (mysqli_num_rows($resultado) > 0) {
        return "❌ El nombre de usuario ya existe.";
    }

    // Insertar nuevo usuario
    $sql = "INSERT INTO TUsers (username, password, rol) VALUES ('$username', '$password', '$rol')";
    if (mysqli_query($cn, $sql)) {
        return "✅ Usuario registrado correctamente.";
    } else {
        return "❌ Error al registrar usuario: " . mysqli_error($cn);
    }
}

// 🔎 Listar usuarios
function getUsuarios() {
    global $cn;
    $sql = "SELECT * FROM TUsers";
    return mysqli_query($cn, $sql);
}

// 🔍 Consultar usuario por ID
function consultarUsuario($id) {
    global $cn;
    $sql = "SELECT * FROM TUsers WHERE id = '$id'";
    return mysqli_query($cn, $sql);
}

// ✏️ Modificar usuario
function modificarUsuario($id, $username, $password, $rol) {
    global $cn;
    $sql = "UPDATE TUsers SET username = '$username', password = '$password', rol = '$rol' WHERE id = '$id'";
    if (mysqli_query($cn, $sql)) {
        return "✅ Usuario actualizado correctamente.";
    } else {
        return "❌ No se pudo actualizar el usuario.";
    }
}

// 🗑️ Eliminar usuario
function eliminarUsuario($id) {
    global $cn;
    $sql = "DELETE FROM TUsers WHERE id = '$id'";
    if (mysqli_query($cn, $sql)) {
        return "🗑️ Usuario eliminado correctamente.";
    } else {
        return "❌ No se pudo eliminar el usuario.";
    }
}
?>
