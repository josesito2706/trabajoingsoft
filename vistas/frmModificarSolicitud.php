<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Modificar Solicitud</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <style>
    :root {
      --verde-agua: #20c997;
      --turquesa:   #37d1b1;
      --gris-fondo: #eee;
      --gris-claro: #fafafa;
      --texto:      #333;
    }
    * { box-sizing: border-box; margin:0; padding:0 }
    body {
      font-family: 'Segoe UI', sans-serif;
      background: var(--gris-fondo);
      height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
    }
    .container {
      background: var(--gris-claro);
      width: 100%;
      max-width: 420px;
      padding: 30px;
      border-radius: 12px;
      box-shadow: 0 10px 25px rgba(0,0,0,0.1);
      opacity: 0;
      transform: translateY(20px);
      animation: fadeIn 0.6s forwards ease-out;
    }
    @keyframes fadeIn {
      to { opacity:1; transform: translateY(0); }
    }
    h2 {
      text-align: center;
      color: var(--verde-agua);
      margin-bottom: 20px;
    }
    label {
      display: block;
      margin-top: 15px;
      font-weight: bold;
      color: var(--texto);
    }
    input[type="text"],
    input[type="date"],
    select,
    textarea {
      width: 100%;
      padding: 10px;
      margin-top: 5px;
      border: 1px solid #ccc;
      border-radius: 6px;
      font-size: 14px;
      transition: border-color 0.3s, box-shadow 0.3s;
    }
    input:focus,
    select:focus,
    textarea:focus {
      outline: none;
      border-color: var(--verde-agua);
      box-shadow: 0 0 5px rgba(32,201,151,0.3);
    }
    input[type="submit"] {
      width: 100%;
      padding: 12px;
      margin-top: 25px;
      background: linear-gradient(45deg, var(--verde-agua), var(--turquesa));
      color: white;
      border: none;
      border-radius: 6px;
      font-weight: bold;
      cursor: pointer;
      transition: transform 0.1s, box-shadow 0.3s;
    }
    input[type="submit"]:hover {
      box-shadow: 0 4px 12px rgba(0,0,0,0.2);
      transform: translateY(-2px);
    }
    a.back-link {
      display: block;
      text-align: center;
      margin-top: 20px;
      color: var(--verde-agua);
      font-weight: bold;
      text-decoration: none;
      transition: color 0.3s;
    }
    a.back-link:hover {
      color: var(--turquesa);
    }
    .error {
      color: red;
      text-align: center;
      margin-bottom: 10px;
    }
    #infoCliente {
      margin-top: 10px;
      font-size: 14px;
      color: var(--texto);
    }
  </style>
</head>
<body>

  <div class="container">
    <h2>Modificar Solicitud</h2>

    <?php
      include("../controladores/solicitudController.php");
      $idS = $codigo = $descripcion = $fecha = $estado = $cliente_dni = "";

      if (isset($_GET['idS'])) {
          $datos = consultarSolicitudPorId($_GET['idS']);
          if ($row = mysqli_fetch_array($datos)) {
              $idS = $row['idS'];
              $codigo = $row['codigo'];
              $descripcion = $row['descripcion'];
              $fecha = $row['fecha_registro'];
              $estado = $row['estado'];
              $cliente_dni = $row['cliente_dni'];
          } else {
              echo "<p class='error'>❌ Solicitud no encontrada.</p>";
          }
      } else {
          echo "<p class='error'>❌ No se proporcionó una solicitud válida.</p>";
      }
    ?>

    <form method="post" action="../controladores/solicitudController.php">
      <input type="hidden" name="idS" value="<?php echo $idS; ?>">

      <label for="codigo">Código</label>
      <input type="text" id="codigo" name="codigo" value="<?php echo $codigo; ?>" required>

      <label for="descripcion">Descripción</label>
      <textarea id="descripcion" name="descripcion" required><?php echo $descripcion; ?></textarea>

      <label for="fecha">Fecha de Registro</label>
      <input type="date" id="fecha" name="fecha_registro" value="<?php echo $fecha; ?>" required>

      <label for="estado">Estado</label>
      <select id="estado" name="estado" required>
        <option value="Activo"    <?php if($estado=='Activo')    echo "selected"; ?>>Activo</option>
        <option value="Inactivo"  <?php if($estado=='Inactivo')  echo "selected"; ?>>Inactivo</option>
        <option value="En Proceso"<?php if($estado=='En Proceso')echo "selected"; ?>>En Proceso</option>
      </select>

      <label for="cliente_dni">DNI del Cliente</label>
      <input
        type="text"
        id="cliente_dni"
        name="cliente_dni"
        maxlength="100"
        value="<?php echo $cliente_dni; ?>"
        required
        onkeyup="buscarCliente()"
      >

      <div id="infoCliente">
        <!-- Aquí se mostrará la info del cliente automáticamente -->
      </div>

      <input type="submit" name="btnActualizar" value="Actualizar Solicitud">
    </form>

    <a href="frmSolicitudesRegistradas.php" class="back-link">
      ← Volver a lista de solicitudes
    </a>
  </div>

  <script>
    function buscarCliente() {
      const dni = document.getElementById('cliente_dni').value;
      const out = document.getElementById('infoCliente');
      if (dni.length >= 8) {
        fetch("../metodos/buscar_Cliente.php?dni=" + dni)
          .then(res => res.text())
          .then(html => out.innerHTML = html)
          .catch(() => out.innerHTML = "");
      } else {
        out.innerHTML = "";
      }
    }
  </script>

</body>
</html>
