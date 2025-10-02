<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Reclamos Registrados</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <style>
    :root {
      --verde-agua:        #20c997;
      --verde-agua-dark:   #17ad7f;
      --turquesa:          #37d1b1;
      --gris-fondo:        #f5f5f5;
      --texto:             #333;
      --gris-claro:        #ffffff;
      --rojo-aris:         #cc0000;
      --gris-texto:        #555;
      --radio:             6px;
      --espacio:           16px;
    }
    * { box-sizing: border-box; margin:0; padding:0 }
    body {
      font-family: 'Segoe UI', sans-serif;
      background: var(--gris-fondo);
      color: var(--texto);
      display: flex;
      flex-direction: column;
      min-height: 100vh;
    }
    header {
      background: linear-gradient(45deg, var(--verde-agua-dark), var(--verde-agua));
      color: white;
      padding: var(--espacio);
      text-align: center;
      font-size: 24px;
      font-weight: bold;
      box-shadow: 0 3px 6px rgba(0,0,0,0.1);
    }
    .container {
      flex: 1;
      width: 90%;
      max-width: 1000px;
      margin: var(--espacio) auto;
      background: var(--gris-claro);
      border-radius: var(--radio);
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
      padding: var(--espacio);
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
      margin-top: var(--espacio);
    }
    th, td {
      padding: 12px;
      border: 1px solid #eee;
      text-align: center;
    }
    th {
      background: #f3f3f3;
      color: var(--verde-agua-dark);
    }
    .btn {
      padding: 8px 14px;
      font-size: 13px;
      border: none;
      border-radius: var(--radio);
      font-weight: bold;
      color: white;
      text-decoration: none;
      margin: 0 5px;
      transition: transform .1s, box-shadow .3s;
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
    /* botones de navegación */
    .volver-btn {
      display: inline-block;
      background: linear-gradient(45deg, var(--turquesa), var(--verde-agua));
      color: white;
      padding: 10px 15px;
      border-radius: var(--radio);
      text-decoration: none;
      font-weight: bold;
      margin: var(--espacio) 5px 0;
      transition: transform .1s, box-shadow .3s;
    }
    .volver-btn:hover {
      transform: translateY(-2px);
      box-shadow: 0 4px 12px rgba(0,0,0,0.2);
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

<header>📋 Reclamos Registrados</header>

<div class="container">
  <?php
    include("../controladores/reclamoController.php");
    $reclamos = listaReclamos();

    if (mysqli_num_rows($reclamos) > 0) {
        echo "<table>
                <tr>
                  <th>ID</th>
                  <th>DNI Cliente</th>
                  <th>Código Soli</th>
                  <th>Descripción</th>
                  <th>Fecha Reclamo</th>
                  <th>Acciones</th>
                </tr>";
        while ($row = mysqli_fetch_assoc($reclamos)) {
            echo "<tr>
                    <td>{$row['idreclamo']}</td>
                    <td>{$row['dni_cliente']}</td>
                    <td>{$row['codigo_soli']}</td>
                    <td>{$row['descripcionR']}</td>
                    <td>{$row['fecha_reclamo']}</td>
                    <td>
                      <a class='btn modificar' 
                         href='frmModificarReclamo.php?idreclamo={$row['idreclamo']}'>
                        ✏️ Modificar
                      </a>
                      <a class='btn eliminar' 
                         href='../controladores/reclamoController.php?accion=eliminar&idreclamo={$row['idreclamo']}'
                         onclick=\"return confirm('¿Eliminar este reclamo?');\">
                        🗑️ Eliminar
                      </a>
                    </td>
                  </tr>";
        }
        echo "</table>";
    } else {
        echo "<p>No hay reclamos registrados.</p>";
    }
  ?>

  <a href="frmRegistroReclamo.php" class="volver-btn">← Registrar Nuevo Reclamo</a>
  <a href="frmPrincipalAdm.php" class="volver-btn">← Volver al Panel</a>
</div>

<div class="footer">
  © 2025 ARIS Industrial. Todos los derechos reservados.
</div>

</body>
</html>
