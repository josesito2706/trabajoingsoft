<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro de Usuario</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background: #f2f2f2;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .form-container {
            background-color: #fff;
            padding: 45px 35px;
            border-radius: 15px;
            box-shadow: 0 12px 35px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 420px;
        }
        h2 {
            text-align: center;
            color: #20c997; /* verde agua */
            margin-bottom: 30px;
            font-size: 24px;
        }
        label {
            font-weight: 600;
            display: block;
            margin-bottom: 8px;
            color: #333;
        }
        input[type="text"],
        input[type="password"],
        select {
            width: 100%;
            padding: 12px;
            font-size: 14px;
            border-radius: 8px;
            border: 1px solid #ccc;
            margin-bottom: 20px;
            transition: border-color 0.3s;
        }
        input:focus,
        select:focus {
            border-color: #20c997; /* verde agua */
            outline: none;
        }
        button {
            width: 100%;
            padding: 12px;
            margin-top: 10px;
            background-color: #20c997; /* verde agua */
            color: #fff;
            font-weight: bold;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            cursor: pointer;
        }
        button:hover {
            background-color: #17a589; /* verde agua oscuro */
        }
        .back {
            text-align: center;
            margin-top: 20px;
        }
        .back a {
            color: #20c997; /* verde agua */
            font-weight: bold;
            text-decoration: none;
        }
        .back a:hover {
            text-decoration: underline;
        }
        .message {
            text-align: center;
            margin-top: 15px;
            color: green;
        }
        .btn-panel {
            background-color: #555;
            color: white;
            padding: 12px;
            border-radius: 8px;
            margin-top: 15px;
            text-align: center;
            font-weight: bold;
            cursor: pointer;
            display: block;
            width: 100%;
            text-decoration: none;
        }
        .btn-panel:hover {
            background-color: #444;
        }
    </style>
</head>
<body>

<div class="form-container">
    <h2>Registro de Usuario</h2>
    <form action="../controladores/usuariosController.php" method="POST">
        <label for="username">Usuario:</label>
        <input type="text" id="username" name="username" required>

        <label for="password">Contraseña:</label>
        <input type="password" id="password" name="password" required>

        <label for="rol">Rol:</label>
        <select id="rol" name="rol" required>
            <option value="">-- Seleccione --</option>
            <option value="Admin">Admin</option>
            <option value="RR.HH">RR.HH</option>
            <option value="Supervision">Supervision</option>
            <option value="Contabilidad">Contabilidad</option>
            <option value="Personal">Personal</option>
        </select>

        <button type="submit" name="btnRegistrar">Registrar</button>
    </form>

    <div class="back">
        <a href="frmUsuariosRegistrados.php">← Ver Usuarios</a>
    </div>

    <a href="frmPrincipalAdm.php" class="btn-panel">Ir al Panel de Administración</a>

    <?php
    if (isset($_GET['m'])) {
        echo "<p class='message'>" . htmlspecialchars($_GET['m']) . "</p>";
    }
    ?>
</div>

</body>
</html>
