<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Modificar Cliente</title>
  <style>
    * {
      box-sizing: border-box;
    }

    html, body {
      margin: 0;
      padding: 0;
      height: 100%;
    }

    body {
      font-family: 'Segoe UI', sans-serif;
      background: linear-gradient(to bottom right, #d3d3d3, #eeeeee);
      display: flex;
      flex-direction: column;
      min-height: 100vh;
    }

    .form-container {
      background: #fff;
      padding: 30px 40px;
      border-radius: 15px;
      box-shadow: 0 10px 25px rgba(0,0,0,0.1);
      width: 350px;
      margin: auto;
    }

    h2 {
      text-align: center;
      color: #c40000;
      margin-bottom: 10px;
    }

    label {
      font-weight: bold;
      color: #333;
      display: block;
      margin-top: 15px;
    }

    input[type="text"],
    input[type="email"] {
      width: 100%;
      padding: 10px;
      border: 1px solid #ccc;
      border-radius: 6px;
      font-size: 14px;
      margin-top: 5px;
    }

    input[type="submit"] {
      width: 100%;
      padding: 12px;
      margin-top: 25px;
      background-color: #c40000;
      color: white;
      border: none;
      border-radius: 6px;
      font-weight: bold;
      font-size: 16px;
      cursor: pointer;
    }

    input[type="submit"]:hover {
      background-color: #a00000;
    }

    .back-link {
      display: block;
      text-align: center;
      margin-top: 15px;
      text-decoration: none;
      color: #c40000;
      font-weight: bold;
    }

    .error {
      color: red;
      text-align: center;
      margin-bottom: 15px;
    }

    footer {
      margin-top: auto;
      text-align: center;
      padding: 15px;
      background-color: transparent;
      color: #555;
      font-size: 13px;
    }
  </style>
</head>
<body>

<div class="form-container">
  <h2>Modificar Cliente</h2>

  <?php
    include("../controladores/clienteController.php");

    $idC = $dni = $nombre = $correo = $telefono = "";

    if (isset($_GET['idC'])) {
        $datos = consultarClientePorId($_GET['idC']);
        if ($row = mysqli_fetch_array($datos)) {
            $idC = htmlspecialchars($row['idC']);
            $dni = htmlspecialchars($row['dni']);
            $nombre = htmlspecialchars($row['nombre']);
            $correo = htmlspecialchars($row['correo']);
            $telefono = htmlspecialchars($row['telefono']);
        } else {
            echo "<p class='error'>❌ Cliente no encontrado.</p>";
        }
    } else {
        echo "<p class='error'>❌ No se proporcionó un ID.</p>";
    }
  ?>

  <form method="post" action="../controladores/clienteController.php">
    <input type="hidden" name="idC" value="<?php echo $idC; ?>">

    <label for="dni">DNI</label>
    <input type="text" id="dni" name="dni" maxlength="8" value="<?php echo $dni; ?>" required>

    <label for="nombre">Nombre</label>
    <input type="text" id="nombre" name="nombre" maxlength="50" value="<?php echo $nombre; ?>" required>

    <label for="correo">Correo</label>
    <input type="email" id="correo" name="correo" maxlength="50" value="<?php echo $correo; ?>" required>

    <label for="telefono">Teléfono</label>
    <input type="text" id="telefono" name="telefono" maxlength="9" value="<?php echo $telefono; ?>" required>

    <input type="submit" name="btnActualizar" value="Actualizar Cliente">
  </form>

  <a href="frmClientesRegistrados.php" class="back-link">← Volver a lista de clientes</a>
</div>

<footer>
  © 2025 ARIS Industrial. Todos los derechos reservados.
</footer>

</body>
</html>
