<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Modificar Usuario</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background: #f4f4f4;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .form-container {
            background: #fff;
            padding: 35px;
            border-radius: 10px;
            box-shadow: 0 8px 25px rgba(0,0,0,0.1);
            max-width: 400px;
            width: 100%;
        }

        h2 {
            text-align: center;
            color: #20c997; /* verde agua */
            margin-bottom: 25px;
        }

        label {
            display: block;
            margin-top: 15px;
            font-weight: bold;
            color: #333;
        }

        input, select {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 6px;
            font-size: 14px;
        }

        button {
            width: 100%;
            padding: 12px;
            margin-top: 25px;
            background-color: #20c997; /* verde agua */
            color: #fff;
            border: none;
            font-weight: bold;
            border-radius: 6px;
            cursor: pointer;
            transition: background-color .2s;
        }

        button:hover {
            background-color: #17a589; /* verde agua oscuro */
        }

        a {
            display: block;
            text-align: center;
            margin-top: 15px;
            color: #20c997; /* verde agua */
            text-decoration: none;
            font-weight: bold;
            transition: color .2s;
        }
        a:hover {
            color: #17a589; /* verde agua oscuro */
        }
    </style>
</head>
<body>

<?php
include("../controladores/usuariosController.php");

$id = $username = $password = $rol = "";

if (isset($_GET['id'])) {
    $resultado = consultarUsuarioPorId($_GET['id']);
    if ($usuario = mysqli_fetch_assoc($resultado)) {
        $id = $usuario['id'];
        $username = $usuario['username'];
        $password = $usuario['password'];
        $rol = $usuario['rol'];
    } else {
        echo "<script>alert('Usuario no encontrado'); window.location.href='frmUsuariosRegistrados.php';</script>";
        exit;
    }
} else {
    echo "<script>alert('ID no válido'); window.location.href='frmUsuariosRegistrados.php';</script>";
    exit;
}
?>

<div class="form-container">
    <h2>Modificar Usuario</h2>
    <form action="../controladores/usuariosController.php" method="POST">
        <input type="hidden" name="id" value="<?php echo $id; ?>">

        <label for="username">Usuario:</label>
        <input type="text" id="username" name="username" value="<?php echo $username; ?>" required>

        <label for="password">Contraseña:</label>
        <input type="text" id="password" name="password" value="<?php echo $password; ?>" required>

        <label for="rol">Rol:</label>
        <select name="rol" id="rol" required>
            <option value="1" <?php if($rol == 1) echo "selected"; ?>>Admin</option>
            <option value="2" <?php if($rol == 2) echo "selected"; ?>>Cliente</option>
        </select>

        <button type="submit" name="btnActualizar">Actualizar Usuario</button>
    </form>

    <a href="frmUsuariosRegistrados.php">← Volver a la lista</a>
</div>

</body>
</html>
