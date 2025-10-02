<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Clientes Registrados</title>
  <style>
    :root {
      --primary: #20c997;
      --primary-dark: #17ad7f;
      --gris-fondo: #d3d3d3;
      --gris-claro: #eeeeee;
      --texto-oscuro: #333;
      --gris-texto: #555;
      /* rojo ARIS para los botones */
      --aris-red: #c40000;
      --aris-red-dark: #a60000;
    }
    * { box-sizing: border-box; margin:0; padding:0; }
    body {
      font-family: 'Segoe UI', sans-serif;
      background: linear-gradient(to bottom right, var(--gris-fondo), var(--gris-claro));
      color: var(--texto-oscuro);
      display: flex;
      flex-direction: column;
      min-height: 100vh;
    }
    header {
      background: linear-gradient(to right, var(--primary-dark), var(--primary));
      color: #fff;
      padding: 20px;
      display: flex;
      justify-content: space-between;
      align-items: center;
      flex-wrap: wrap;
      box-shadow: 0 3px 6px rgba(0,0,0,0.1);
    }
    h1 { font-size: 26px; }
    .btn-group {
      display: flex;
      gap: 10px;
      flex-wrap: wrap;
    }
    /* Botones de registrar/volver conservan su estilo rojo original */
    .nuevo-btn,
    .volver-btn {
      background-color: #fff;
      color: var(--aris-red);
      font-weight: bold;
      text-decoration: none;
      padding: 10px 15px;
      border-radius: 8px;
      border: 2px solid #fff;
      transition: background 0.3s ease, color 0.3s ease, border-color 0.3s ease;
    }
    .nuevo-btn:hover,
    .volver-btn:hover {
      background-color: #f8f8f8;
      color: var(--aris-red-dark);
      border-color: var(--aris-red-dark);
    }
    table {
      width: 90%;
      margin: 40px auto;
      border-collapse: collapse;
      background: var(--gris-claro);
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
      border-radius: 10px;
      overflow: hidden;
    }
    th, td {
      padding: 15px;
      font-size: 14px;
      text-align: center;
      border-bottom: 1px solid #eee;
    }
    th {
      background-color: #f6f6f6;
      color: var(--primary);
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
      box-shadow: 0 2px 6px rgba(0,0,0,0.2);
      transition: all 0.3s ease;
    }
    /* Los botones de acción siguen en azul y rojo según tu código original */
    .modificar {
      background-color: #007bff;
    }
    .modificar:hover {
      background-color: #0056b3;
      transform: translateY(-1px);
    }
    .eliminar {
      background-color: #dc3545;
    }
    .eliminar:hover {
      background-color: #a71d2a;
      transform: translateY(-1px);
    }
    .footer {
      margin-top: auto;
      text-align: center;
      font-size: 12px;
      padding: 15px;
      color: var(--gris-texto);
      background: var(--gris-claro);
    }
  </style>
</head>
<body>

<header>
  <h1>📋 Clientes Registrados</h1>
  <div class="btn-group">
    <a class="nuevo-btn" href="frmRegistrarCliente.php">➕ Registrar nuevo cliente</a>
    <a class="volver-btn" href="frmPrincipalAdm.php">← Volver al Panel Principal</a>
  </div>
</header>

<?php
include("../controladores/clienteController.php");
$clientes = listaClientes();
?>

<table>
  <thead>
    <tr>
      <th>ID</th>
      <th>DNI</th>
      <th>Nombre</th>
      <th>Correo</th>
      <th>Teléfono</th>
      <th>Acciones</th>
    </tr>
  </thead>
  <tbody>
    <?php while($row = mysqli_fetch_assoc($clientes)): ?>
      <tr>
        <td><?= htmlspecialchars($row['idC']) ?></td>
        <td><?= htmlspecialchars($row['dni']) ?></td>
        <td><?= htmlspecialchars($row['nombre']) ?></td>
        <td><?= htmlspecialchars($row['correo']) ?></td>
        <td><?= htmlspecialchars($row['telefono']) ?></td>
        <td>
          <a class="btn modificar" href="frmModificarCliente.php?idC=<?= $row['idC'] ?>">✏️ Modificar</a>
          <a class="btn eliminar" href="../controladores/clienteController.php?accion=eliminar&idC=<?= $row['idC'] ?>" onclick="return confirm('¿Estás seguro de eliminar este cliente?')">🗑️ Eliminar</a>
        </td>
      </tr>
    <?php endwhile; ?>
  </tbody>
</table>

<div class="footer">
  © 2025 ARIS Industrial. Todos los derechos reservados.
</div>

</body>
</html>
