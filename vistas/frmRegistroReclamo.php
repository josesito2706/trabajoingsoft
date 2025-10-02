<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Registrar Reclamo</title>
  <style>
    :root {
      --color-principal: #20c997;        /* verde agua */
      --color-principal-dark: #17ad7f;
      --color-secundario: #37d1b1;      /* turquesa */
      --color-secundario-dark: #2ea692;
      --color-fondo: #f5f5f5;
      --color-texto: #333;
      --radio: 16px;
      --espacio: 16px;
    }
    * { box-sizing: border-box; margin:0; padding:0; }
    body {
      font-family: 'Segoe UI', Arial, sans-serif;
      background: var(--color-fondo);
      display: flex;
      flex-direction: column;
      align-items: center;
      min-height: 100vh;
    }
    /* ===== Encabezado fuera del contenedor ===== */
    header {
      width: 100%;
      background: linear-gradient(45deg, var(--color-principal-dark), var(--color-principal));
      color: #fff;
      padding: var(--espacio) calc(var(--espacio) * 1.5);
      display: flex;
      justify-content: space-between;
      align-items: center;
      font-weight: bold;
      box-shadow: 0 2px 5px rgba(0,0,0,0.1);
    }
    /* ===== Tarjeta ===== */
    .card {
      background: #fff;
      width: 100%;
      max-width: 480px;
      border-radius: var(--radio);
      margin: calc(var(--espacio) * 2) 0;
      box-shadow: 0 4px 12px rgba(0,0,0,0.08);
      overflow: hidden;
      opacity: 0;
      transform: translateY(20px);
      animation: fadeIn 0.6s forwards ease-out;
    }
    @keyframes fadeIn {
      to { opacity: 1; transform: translateY(0); }
    }
    .card-body {
      padding: calc(var(--espacio) * 2);
    }
    .card-body h2 {
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
      margin-bottom: .5em;
      font-weight: 600;
      color: var(--color-texto);
    }
    .form-group input,
    .form-group textarea {
      width: 100%;
      padding: var(--espacio);
      border: 1px solid #ccc;
      border-radius: var(--radio);
      font-size: 1rem;
      transition: border-color .2s;
    }
    .form-group input:focus,
    .form-group textarea:focus {
      outline: none;
      border-color: var(--color-principal);
      box-shadow: 0 0 5px rgba(32,201,151,0.3);
    }
    .form-group textarea {
      resize: vertical;
      min-height: 100px;
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
      background: linear-gradient(45deg, var(--color-principal-dark), var(--color-principal));
    }
    .btn-primary:hover {
      background: var(--color-principal-dark);
      transform: translateY(-1px);
    }
    .btn-primary:active {
      box-shadow: inset 0 2px 6px rgba(32,201,151,0.6);
    }
    .btn-secondary {
      background: linear-gradient(45deg, var(--color-secundario-dark), var(--color-secundario));
    }
    .btn-secondary:hover {
      background: var(--color-secundario-dark);
      transform: translateY(-1px);
    }
    .btn-secondary:active {
      box-shadow: inset 0 2px 6px rgba(46,166,146,0.6);
    }
    .msg-success {
      text-align: center;
      color: green;
      font-weight: 600;
      margin-bottom: var(--espacio);
    }
  </style>
</head>
<body>

  <!-- Encabezado fuera del contenedor -->
  <header>
    <span>ARIS INDUSTRIA</span>
    <span>Registro de Solicitudes</span>
  </header>

  <!-- Tarjeta principal -->
  <div class="card">
    <div class="card-body">
      <h2>Registrar Nuevo Reclamo</h2>

      <?php if (isset($_GET['ok'])): ?>
        <p class="msg-success">✔️ Reclamo registrado con éxito.</p>
      <?php endif; ?>

      <form method="post" action="../controladores/reclamoController.php">
        <div class="form-group">
          <label for="dni_cliente">DNI del Cliente</label>
          <input
            type="text"
            id="dni_cliente"
            name="dni_cliente"
            maxlength="8"
            placeholder="12345678"
            required
          >
          <div id="datosCliente"></div>
        </div>

        <div class="form-group">
          <label for="codigo_soli">Código de Solicitud</label>
          <input
            type="text"
            id="codigo_soli"
            name="codigo_soli"
            maxlength="4"
            placeholder="A123"
            required
          >
          <div id="resultadoSolicitud"></div>
        </div>

        <div class="form-group">
          <label for="descripcionR">Descripción del Reclamo</label>
          <textarea
            id="descripcionR"
            name="descripcionR"
            placeholder="Describa el reclamo…"
            required
          ></textarea>
        </div>

        <div class="form-group">
          <label for="fecha_reclamo">Fecha de Reclamo</label>
          <input
            type="date"
            id="fecha_reclamo"
            name="fecha_reclamo"
            required
          >
        </div>

        <div class="buttons">
          <button type="submit" name="btnRegistrarReclamo" class="btn btn-primary">
            Registrar Reclamo
          </button>
          <button type="button" class="btn btn-secondary" onclick="location.href='frmPrincipalAdm.php'">
            ← Panel Principal
          </button>
          <button type="button" class="btn btn-secondary" onclick="location.href='frmReclamosRegistrados.php'">
            Ver/Modificar Reclamos
          </button>
        </div>
      </form>
    </div>
  </div>

  <script>
    // búsqueda en vivo de cliente y solicitud
    document.getElementById('dni_cliente').addEventListener('input', e => {
      const out = document.getElementById('datosCliente'), v = e.target.value;
      if (/^\d{8}$/.test(v))
        fetch('../metodos/buscar_Cliente.php?dni='+v).then(r=>r.text()).then(t=>out.innerHTML=t);
      else out.innerHTML = '';
    });
    document.getElementById('codigo_soli').addEventListener('input', e => {
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
