<?php
// vistas/frmModificarReclamo.php

// 1) Incluimos el controlador/DAO para poder usar consultarReclamoPorId()
include("../controladores/reclamoController.php");

// 2) Inicializamos variables
$idreclamo     = '';
$dni_cliente   = '';
$codigo_soli   = '';
$descripcionR  = '';
$fecha_reclamo = '';

// 3) Si nos pasan idreclamo por GET, buscamos el reclamo
if (isset($_GET['idreclamo'])) {
    $idreclamo = $_GET['idreclamo'];
    $rs = consultarReclamoPorId($idreclamo);
    if ($rs && $row = mysqli_fetch_assoc($rs)) {
        $dni_cliente   = $row['dni_cliente'];
        $codigo_soli   = $row['codigo_soli'];
        $descripcionR  = $row['descripcionR'];
        $fecha_reclamo = $row['fecha_reclamo'];
    } else {
        echo "<p style='color:red; text-align:center;'>❌ Reclamo no encontrado.</p>";
        exit;
    }
} else {
    echo "<p style='color:red; text-align:center;'>❌ No se indicó qué reclamo modificar.</p>";
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Modificar Reclamo</title>
  <style>
    :root {
      --color-principal: #20c997;     /* verde agua */
      --color-secundario: #37d1b1;    /* turquesa */
      --color-fondo: #f5f5f5;
      --color-texto: #333;
      --radio: 8px;
      --espacio: 16px;
    }
    *, *::before, *::after {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
    }
    body {
      font-family: 'Segoe UI', Arial, sans-serif;
      background: var(--color-fondo);
      color: var(--color-texto);
      display: flex;
      justify-content: center;
      align-items: center;
      padding: calc(var(--espacio)*2) 0;
      min-height: 100vh;
    }
    header {
      position: absolute;
      top: 0; left: 0; right: 0;
      background: linear-gradient(45deg, var(--color-principal), var(--color-secundario));
      color: #fff;
      padding: var(--espacio);
      text-align: center;
      font-weight: bold;
      box-shadow: 0 2px 6px rgba(0,0,0,0.1);
    }
    .container {
      background: #fff;
      width: 100%;
      max-width: 480px;
      padding: calc(var(--espacio)*2);
      border-radius: var(--radio);
      box-shadow: 0 4px 12px rgba(0,0,0,0.08);
      margin-top: calc(var(--espacio)*4);
      opacity: 0;
      transform: translateY(20px);
      animation: fadeIn 0.5s forwards ease-out;
    }
    @keyframes fadeIn {
      to { opacity: 1; transform: translateY(0); }
    }
    h2 {
      text-align: center;
      color: var(--color-principal);
      margin-bottom: var(--espacio);
      font-size: 1.75rem;
    }
    .form-group {
      margin-bottom: var(--espacio);
    }
    .form-group label {
      display: block;
      font-weight: 600;
      margin-bottom: .5em;
    }
    .form-group input,
    .form-group textarea,
    .form-group select {
      width: 100%;
      padding: var(--espacio);
      border: 1px solid #ccc;
      border-radius: var(--radio);
      font-size: 1rem;
      transition: border-color .2s, box-shadow .2s;
    }
    .form-group input:focus,
    .form-group textarea:focus,
    .form-group select:focus {
      outline: none;
      border-color: var(--color-principal);
      box-shadow: 0 0 5px rgba(32,201,151,0.3);
    }
    #datosCliente,
    #resultadoSolicitud {
      font-size: .9rem;
      margin: .5em 0 var(--espacio);
      color: var(--color-texto);
    }
    .buttons {
      display: grid;
      gap: var(--espacio);
      margin-top: var(--espacio);
    }
    .btn {
      width: 100%;
      padding: var(--espacio);
      font-size: 1rem;
      font-weight: 600;
      color: #fff;
      border: none;
      border-radius: var(--radio);
      cursor: pointer;
      transition: background-color .2s, transform .1s, box-shadow .1s;
    }
    .btn-primary {
      background: var(--color-principal);
    }
    .btn-primary:hover {
      background: var(--color-principal);
      transform: translateY(-1px);
      box-shadow: 0 4px 12px rgba(0,0,0,0.2);
    }
    .btn-primary:active {
      box-shadow: inset 0 2px 6px rgba(32,201,151,0.6);
      transform: translateY(0);
    }
    .btn-secondary {
      background: var(--color-secundario);
    }
    .btn-secondary:hover {
      background: var(--color-secundario);
      transform: translateY(-1px);
      box-shadow: 0 4px 12px rgba(0,0,0,0.2);
    }
    .btn-secondary:active {
      box-shadow: inset 0 2px 6px rgba(46,166,146,0.6);
      transform: translateY(0);
    }
    .msg-success {
      text-align: center;
      color: green;
      font-weight: 600;
      margin-bottom: var(--espacio);
    }
    a.back-link {
      display: block;
      text-align: center;
      margin-top: var(--espacio);
      color: var(--color-principal);
      font-weight: bold;
      text-decoration: none;
      transition: color .3s;
    }
    a.back-link:hover {
      color: var(--color-secundario);
    }
  </style>
</head>
<body>

  <header>Modificar Reclamo</header>

  <div class="container">
    <?php if (isset($_GET['m'])): ?>
      <p class="msg-success"><?= htmlspecialchars($_GET['m']) ?></p>
    <?php endif; ?>

    <form method="post" action="../controladores/reclamoController.php">
      <input type="hidden" name="idreclamo" value="<?= htmlspecialchars($idreclamo) ?>" />

      <div class="form-group">
        <label for="dni_cliente">DNI del Cliente</label>
        <input
          type="text"
          id="dni_cliente"
          name="dni_cliente"
          maxlength="8"
          value="<?= htmlspecialchars($dni_cliente) ?>"
          required
        />
        <div id="datosCliente"></div>
      </div>

      <div class="form-group">
        <label for="codigo_soli">Código de Solicitud</label>
        <input
          type="text"
          id="codigo_soli"
          name="codigo_soli"
          maxlength="4"
          value="<?= htmlspecialchars($codigo_soli) ?>"
          required
        />
        <div id="resultadoSolicitud"></div>
      </div>

      <div class="form-group">
        <label for="descripcionR">Descripción del Reclamo</label>
        <textarea id="descripcionR" name="descripcionR" required><?= htmlspecialchars($descripcionR) ?></textarea>
      </div>

      <div class="form-group">
        <label for="fecha_reclamo">Fecha de Reclamo</label>
        <input
          type="date"
          id="fecha_reclamo"
          name="fecha_reclamo"
          value="<?= htmlspecialchars($fecha_reclamo) ?>"
          required
        />
      </div>

      <div class="buttons">
        <button type="submit" name="btnModificarReclamo" class="btn btn-primary">
          Guardar Cambios
        </button>
        <button type="button" class="btn btn-secondary" onclick="location.href='frmPrincipalAdm.php'">
          ← Panel Principal
        </button>
        <button type="button" class="btn btn-secondary" onclick="location.href='frmReclamosRegistrados.php'">
          Ver Reclamos
        </button>
      </div>
    </form>

  <script>
    document.getElementById('dni_cliente')
      .addEventListener('input', e => {
        const out = document.getElementById('datosCliente'), v = e.target.value;
        if (/^\d{8}$/.test(v))
          fetch('../metodos/buscar_Cliente.php?dni='+v).then(r=>r.text()).then(t=>out.innerHTML=t);
        else out.innerHTML = '';
      });
    document.getElementById('codigo_soli')
      .addEventListener('input', e => {
        const out = document.getElementById('resultadoSolicitud'), v = e.target.value;
        if (/^\d{4}$/.test(v))
          fetch('../metodos/buscar_Solicitud.php?codigo='+v)
            .then(r=>r.text()).then(t=>out.innerHTML=t)
            .catch(_=>out.innerHTML='Error al buscar la solicitud.');
        else out.innerHTML = '';
      });
  </script>

</body>
</html>
