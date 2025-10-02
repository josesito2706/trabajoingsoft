<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Solicitudes Registradas</title>
  <style>
    :root {
      --verde-agua: #20c997;
      --verde-agua-dark: #17ad7f;
      --gris-fondo: #f5f5f5;
      --gris-claro: #ffffff;
      --texto: #333;
    }

    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
    }

    body {
      font-family: 'Segoe UI', sans-serif;
      background-color: var(--gris-fondo);
      color: var(--texto);
      display: flex;
      flex-direction: column;
      min-height: 100vh;
    }

    header {
      background: linear-gradient(45deg, var(--verde-agua-dark), var(--verde-agua));
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
      background-color: var(--gris-claro);
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
      padding: 20px;
      opacity: 0;
      transform: translateY(20px);
      animation: fadeIn 0.6s forwards ease-out;
    }

    @keyframes fadeIn {
      to { opacity: 1; transform: translateY(0); }
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
      vertical-align: middle;
    }

    th {
      background-color: #f3f3f3;
      color: var(--verde-agua);
    }

    /* Nuevo estilo para el contenedor de botones */
    .acciones {
      display: flex;
      flex-wrap: wrap;
      justify-content: center;
      gap: 6px;
    }

    .btn {
      padding: 8px 14px;
      font-size: 13px;
      border: none;
      border-radius: 6px;
      font-weight: bold;
      color: white;
      text-decoration: none;
      transition: transform 0.1s, box-shadow 0.3s;
      white-space: nowrap;
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

    .imprimir {
      background-color: #28a745;
    }
    .imprimir:hover {
      transform: translateY(-2px);
      box-shadow: 0 4px 12px rgba(0,0,0,0.2);
    }

    .volver-btn {
      display: inline-block;
      background-color: #888;
      color: white;
      padding: 10px 15px;
      border-radius: 6px;
      text-decoration: none;
      font-weight: bold;
      margin: 20px 5px 0 0;
      transition: background-color 0.3s, transform 0.1s;
    }
    .volver-btn:hover {
      background-color: #555;
      transform: translateY(-2px);
    }

    .footer {
      text-align: center;
      padding: 12px;
      background-color: var(--gris-claro);
      color: #777;
      font-size: 14px;
      margin-top: auto;
    }
  </style>
</head>
<body>

  <header>
    📋 Solicitudes Registradas
  </header>

  <div class="container">
    <?php
    include("../controladores/solicitudController.php");
    $solicitudes = listaSolicitudes();

    if (mysqli_num_rows($solicitudes) > 0) {
        echo "<table>";
        echo "<tr>
                <th>ID</th>
                <th>Código</th>
                <th>Descripción</th>
                <th>Fecha</th>
                <th>Estado</th>
                <th>DNI Cliente</th>
                <th>Acciones</th>
              </tr>";
        while ($row = mysqli_fetch_assoc($solicitudes)) {
            echo "<tr>
                    <td>{$row['idS']}</td>
                    <td>{$row['codigo']}</td>
                    <td>{$row['descripcion']}</td>
                    <td>{$row['fecha_registro']}</td>
                    <td>{$row['estado']}</td>
                    <td>{$row['cliente_dni']}</td>
                    <td>
                      <div class='acciones'>
                        <a class='btn modificar' href='frmModificarSolicitud.php?idS={$row['idS']}'>
                          ✏️ Modificar
                        </a>
                        <a class='btn eliminar' href='../controladores/solicitudController.php?accion=eliminar&idS={$row['idS']}' onclick=\"return confirm('Estás seguro de eliminar esta solicitud?')\">
                          🗑️ Eliminar
                        </a>
                        <a class='btn imprimir' href='frmImprimirSeguimiento.php?idS={$row['idS']}' target='_blank'>
                          🖨️ Imprimir
                        </a>
                      </div>
                    </td>
                  </tr>";
        }
        echo "</table>";
    } else {
        echo "<p>No hay solicitudes registradas.</p>";
    }
    ?>

    <a href="frmRegistroSolicitud.php" class="volver-btn">← Registrar Nueva Solicitud</a>
    <a href="frmPrincipalAdm.php" class="volver-btn">← Volver al Panel</a>
  </div>

  <div class="footer">
    © 2025 ARIS Industrial. Todos los derechos reservados.
  </div>

</body>
</html>
