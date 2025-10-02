<?php
session_start();
include("../modelos/conexion.php");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // 1) Leer y limpiar
    $username = trim($_POST['username'] ?? '');
    $password = trim($_POST['password'] ?? '');

    // 2) Preparar y ejecutar
    $sql = "SELECT username, rol FROM TUsers WHERE username = ? AND password = ?";
    $stmt = $cn->prepare($sql);
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $stmt->store_result();

    // 3) Si hay un usuario
    if ($stmt->num_rows === 1) {
        $stmt->bind_result($dbUser, $dbRole);
        $stmt->fetch();

        // 4) Guardar en sesión y normalizar rol a minúsculas
        $_SESSION['usuario'] = $dbUser;
        $_SESSION['rol']     = strtolower(trim($dbRole)); 

        // 5) Redirigir y salir
        header("Location: ../vistas/frmPrincipalAdm.php");
        exit;
    } else {
        header("Location: ../index.php?error=1");
        exit;
    }
}
?>
