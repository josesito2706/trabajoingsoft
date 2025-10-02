<?php
session_start();

if (
    !isset($_SESSION['rol'])
    || strcasecmp(trim($_SESSION['rol']), 'Admin') !== 0
) {
    header('Location: ../metodos/accesoDenegado.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Usuarios Registrados</title>
  <style>
    :root {
      --color-principal: #20c997;        /* verde agua */
      --color-principal-dark: #17ad7f;
      --color-secundario: #37d1b1;      /* turquesa */
      --color-secundario-dark: #2ea692;
      --fondo:           #f5f5f5;
      --texto:           #333;
      --gris-claro:      #fff;
      --radio:           6px;
      --espacio:         16px;
    }
    * { box-sizing: border-box; margin: 0; padding: 0; }
    body {
      font-family: 'Segoe UI', sans-serif;
      background: var(--fondo);
      color: var(--texto);
      display: flex;
      flex-direction: column;
      min-height: 100vh;
    }
    header {
      background: linear-gradient(45deg, var(--color-principal-dark), var(--color-principal));
      color: #fff;
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
      animation: fadeIn 0.5s forwards ease-out;
    }
    @keyframes fadeIn {
      to { opacity: 1; transform: translateY(0); }
    }
    h2 {
      text-align: center;
      margin-bottom: var(--espacio);
      color: var(--color-principal);
    }
    table {
      width: 100%;
      border-collapse: collapse;
    }
    th, td {
      padding: 12px;
      border-bottom: 1px solid #eee;
      text-align: center;
    }
    th {
      background: var(--color-principal);
      color: #fff;
    }
    tr:hover {
      background: #f9f9f9;
    }
    .acciones {
      display: flex;
      justify-content: center;
      gap: 10px;
    }
    .acciones a {
      text-decoration: none;
      font-weight: bold;
      color: #fff;
      padding: 6px 12px;
      border-radius: var(--radio);
      font-size: 13px;
    }
    .editar {
      background-color: #007bff;
    }
    .editar:hover {
      background-color: #0056b3;
    }
    .eliminar {
      background-color: #dc3545;
    }
    .eliminar:hover {
      background-color: #b02a37;
    }
    .btn-container {
      display: flex;
      justify-content: space-between;
      flex-wrap: wrap;
      gap: 10px;
      margin-top: var(--espacio);
    }
    a.btn {
      text-decoration: none;
      background: linear-gradient(45deg, var(--color-principal-dark), var(--color-principal));
      color: #fff;
      padding: 10px 16px;
      border-radius: var(--radio);
      font-weight: bold;
      transition: transform .1s, box-shadow .3s;
    }
    a.btn:hover {
      transform: translateY(-2px);
      box-shadow: 0 4px 12px rgba(0,0,0,0.2);
    }
    .footer {
      text-align: center;
      padding: 12px;
      background: var(--gris-claro);
      color: #777;
      font-size: 12px;
      margin-top: auto;
      box-shadow: inset 0 1px 3px rgba(0,0,0,0.1);
    }
  </style>
</head>
<body>

<header>📋 Usuarios Registrados</header>

<div class="container">
  <h2>Usuarios Registrados</h2>
  <table>
    <tr>
      <th>ID</th>
      <th>Usuario</th>
      <th>Contraseña</th>
      <th>Rol</th>
      <th>Acciones</th>
    </tr>
    <?php
      include("../controladores/usuariosController.php");
      $usuarios = listaUsuarios();
      if ($usuarios && mysqli_num_rows($usuarios) > 0) {
        while ($fila = mysqli_fetch_assoc($usuarios)) {
          echo "<tr>";
          echo "<td>{$fila['id']}</td>";
          echo "<td>" . htmlspecialchars($fila['username']) . "</td>";
          echo "<td>" . htmlspecialchars($fila['password']) . "</td>";
          echo "<td>" . htmlspecialchars($fila['rol']) . "</td>";
          echo "<td class='acciones'>
                  <a href='frmModificarUsuario.php?id={$fila['id']}' class='editar'>✏️ Editar</a>
                  <a href='../controladores/usuariosController.php?accion=eliminar&id={$fila['id']}' class='eliminar' onclick=\"return confirm('¿Estás seguro de eliminar este usuario?')\">🗑️ Eliminar</a>
                </td>";
          echo "</tr>";
        }
      } else {
        echo "<tr><td colspan='5'>No hay usuarios registrados.</td></tr>";
      }
    ?>
  </table>

  <div class="btn-container">
    <a class="btn" href="frmPrincipalAdm.php">← Volver al panel</a>
    <a class="btn" href="frmRegistrarUsuario.php">➕ Registrar Usuario</a>
  </div>
</div>

<div class="footer">
  © 2025 ARIS Industrial. Todos los derechos reservados.
</div>

</body>
</html>
