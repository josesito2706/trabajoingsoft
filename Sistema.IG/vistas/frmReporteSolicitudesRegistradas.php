<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Registros de Seguimiento</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <style>
    :root {
      --verde-agua:   #20c997;
      --turquesa:     #37d1b1;
      --gris-fondo:   #f5f5f5;
      --gris-claro:   #ffffff;
      --texto:        #333;
      --gris-sec:     #adb5bd;
      --azul-claro:   #8ecae6;
      --rojo-aris:    #cc0000;
      --gris-texto:   #777;
    }
    * { box-sizing: border-box; margin:0; padding:0; }
    body {
      font-family: 'Segoe UI', sans-serif;
      background: var(--gris-fondo);
      color: var(--texto);
      display: flex;
      flex-direction: column;
      min-height: 100vh;
    }
    header {
      background: linear-gradient(45deg, var(--verde-agua), var(--turquesa));
      color: white;
      padding: 20px;
      text-align: center;
      font-size: 24px;
      font-weight: bold;
      box-shadow: 0 3px 6px rgba(0,0,0,0.1);
    }
    .container {
      flex: 1;
      width: 90%;
      max-width: 1000px;
      margin: 30px auto;
      background: var(--gris-claro);
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
      padding: 20px;
      opacity: 0;
      transform: translateY(20px);
      animation: fadeIn 0.6s forwards ease-out;
    }
    @keyframes fadeIn {
      to { opacity:1; transform: translateY(0); }
    }
    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 10px;
    }
    th, td {
      padding: 12px;
      border: 1px solid #eee;
      text-align: center;
    }
    th {
      background: #f3f3f3;
      color: var(--verde-agua);
    }
    .btn {
      padding: 8px 14px;
      font-size: 13px;
      border: none;
      border-radius: 6px;
      font-weight: bold;
      color: white;
      text-decoration: none;
      margin: 0 5px;
      transition: transform 0.1s, box-shadow 0.3s;
    }
    .modificar {
      background-color: #007bff;
    }
    .modificar:hover {
      transform: translateY(-2px);
      box-shadow: 0 4px 12px rgba(0,0,0,0.2);
    }
    .eliminar {
      background-color: #dc3545;
    }
    .eliminar:hover {
      transform: translateY(-2px);
      box-shadow: 0 4px 12px rgba(0,0,0,0.2);
    }
    .volver-btn {
      display: inline-block;
      background-color: var(--gris-sec);
      color: white;
      padding: 10px 15px;
      border-radius: 6px;
      text-decoration: none;
      font-weight: bold;
      margin: 20px 5px 0;
      transition: background-color 0.3s, transform 0.1s;
    }
    .volver-btn:hover {
      background-color: var(--azul-claro);
      transform: translateY(-2px);
    }
    .footer {
      text-align: center;
      font-size: 12px;
      padding: 15px;
      background-color: var(--gris-claro);
      color: var(--gris-texto);
      margin-top: auto;
      box-shadow: inset 0 1px 3px rgba(0,0,0,0.1);
    }
  </style>
</head>
<body>

  <header>
    📋 Registros de Seguimiento
  </header>

  <div class="container">
    <?php
    include("../controladores/reporteController.php");
    $reportes = listaReportes();

    if (mysqli_num_rows($reportes) > 0) {
        echo "<table>";
        echo "<tr>
                <th>ID</th>
                <th>Código</th>
                <th>Estado</th>
                <th>Observación</th>
                <th>Fecha de Seguimiento</th>
                <th>Acciones</th>
              </tr>";
        while($row = mysqli_fetch_assoc($reportes)) {
            echo "<tr>
                    <td>{$row['idR']}</td>
                    <td>{$row['codigoR']}</td>
                    <td>{$row['estadoR']}</td>
                    <td>{$row['observacion']}</td>
                    <td>{$row['fecha_seguimiento']}</td>
                    <td>
                      <a class='btn modificar' href='frmModificarReporte.php?idR={$row['idR']}'>✏️ Modificar</a>
                      <a class='btn eliminar' href='../controladores/reporteController.php?accion=eliminar&idR={$row['idR']}' onclick=\"return confirm('¿Seguro que quieres eliminar este registro?')\">🗑️ Eliminar</a>
                    </td>
                  </tr>";
        }
        echo "</table>";
    } else {
        echo "<p>No hay registros disponibles.</p>";
    }
    ?>

    <a href="frmReporteSolicitud.php" class="volver-btn">← Registrar Nuevo Seguimiento</a>
    <a href="frmPrincipalAdm.php" class="volver-btn">← Volver al Panel</a>
  </div>

  <div class="footer">
    © 2025 ARIS Industrial. Todos los derechos reservados.
  </div>

</body>
</html>
