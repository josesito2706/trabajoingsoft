<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Modificar Reporte</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <style>
    :root {
      --verde-agua:   #20c997;
      --turquesa:     #37d1b1;
      --gris-fondo:   #eee;
      --gris-claro:   #fafafa;
      --texto:        #333;
      --gris-texto:   #555;
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
      to { opacity: 1; transform: translateY(0); }
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
    textarea,
    select {
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
    #resultadoReporte {
      margin-top: 10px;
      margin-bottom: 20px;
      font-size: 14px;
      color: var(--texto);
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
  </style>
</head>
<body>

  <div class="container">
    <h2>Modificar Reporte</h2>

    <?php
      include("../controladores/reporteController.php");
      $idR = $codigoR = $observacion = $fecha_seguimiento = $estadoR = "";

      if (isset($_GET['idR'])) {
          $datos = consultarReportePorId($_GET['idR']);
          if ($row = mysqli_fetch_array($datos)) {
              $idR               = $row['idR'];
              $codigoR           = $row['codigoR'];
              $observacion       = $row['observacion'];
              $fecha_seguimiento = $row['fecha_seguimiento'];
              $estadoR           = $row['estadoR'];
          } else {
              echo "<p class='error'>❌ Reporte no encontrado.</p>";
          }
      } else {
          echo "<p class='error'>❌ No se proporcionó un reporte válido.</p>";
      }
    ?>

    <form method="post" action="../controladores/reporteController.php">
      <input type="hidden" name="idR" value="<?= htmlspecialchars($idR) ?>">

      <label for="codigoR">Código</label>
      <input
        type="text"
        id="codigoR"
        name="codigoR"
        maxlength="4"
        value="<?= htmlspecialchars($codigoR) ?>"
        required
      >

      <div id="resultadoReporte"></div>

      <label for="observacion">Observación</label>
      <textarea
        id="observacion"
        name="observacion"
        rows="4"
        required
      ><?= htmlspecialchars($observacion) ?></textarea>

      <label for="fecha_seguimiento">Fecha de Seguimiento</label>
      <input
        type="date"
        id="fecha_seguimiento"
        name="fecha_seguimiento"
        value="<?= htmlspecialchars($fecha_seguimiento) ?>"
        required
      >

      <label for="estadoR">Estado de la Solicitud:</label>
        <select name="estadoR" id="estadoR" required>
          <option value="">-- Seleccione --</option>
          <option value="Almacenado">Almacenado</option>
          <option value="Entregado">Entregado</option>
          <option value="Cancelado">Cancelado</option>
        </select>

      <input type="submit" name="btnActualizar" value="Actualizar Reporte">
    </form>

    <a href="frmReporteSolicitudesRegistradas.php" class="back-link">
      ← Volver a lista de reportes
    </a>
  </div>

  <script>
    document.addEventListener('DOMContentLoaded', () => {
      const codigoInput = document.getElementById('codigoR');
      const resultadoDiv = document.getElementById('resultadoReporte');

      function buscarReportePorCodigo(codigo) {
        if (/^\d{4}$/.test(codigo)) {
          fetch(`../metodos/buscar_Solicitud.php?codigo=${codigo}`)
            .then(res => res.ok ? res.text() : Promise.reject())
            .then(html => resultadoDiv.innerHTML = html)
            .catch(() => resultadoDiv.innerHTML = '⚠️ No se pudo cargar el reporte.');
        } else {
          resultadoDiv.innerHTML = '';
        }
      }

      codigoInput.addEventListener('input', e => buscarReportePorCodigo(e.target.value));
    });
  </script>

</body>
</html>
