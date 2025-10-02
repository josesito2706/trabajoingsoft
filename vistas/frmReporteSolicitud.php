<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Reporte de Solicitudes</title>
  <style>
    :root {
      --verde-agua: #20c997;
      --turquesa:   #37d1b1;
      --gris-fondo: #f3f3f3;
      --gris-claro: #ffffff;
      --texto:      #333;
      --gris-sec:   #adb5bd;
      --azul-claro: #8ecae6;
    }
    * { box-sizing: border-box; margin:0; padding:0 }
    body {
      font-family: 'Segoe UI', sans-serif;
      background-color: var(--gris-fondo);
      display: flex;
      flex-direction: column;
      min-height: 100vh;
      padding-bottom: 60px;
    }
    .navbar {
      background: linear-gradient(45deg, var(--verde-agua), var(--turquesa));
      color: white;
      padding: 12px 20px;
      display: flex;
      justify-content: space-between;
      align-items: center;
      font-size: 18px;
      box-shadow: 0 2px 5px rgba(0,0,0,0.1);
    }
    .navbar span { font-weight: bold; }
    .main-content {
      flex: 1;
      display: flex;
      justify-content: center;
      align-items: flex-start;
      padding: 20px 10px;
    }
    .form-container {
      background-color: var(--gris-claro);
      padding: 30px 20px;
      border-radius: 16px;
      box-shadow: 0 10px 30px rgba(0,0,0,0.1);
      width: 100%;
      max-width: 450px;
      opacity: 0;
      transform: translateY(20px);
      animation: fadeIn 0.6s forwards ease-out;
    }
    @keyframes fadeIn {
      to { opacity:1; transform: translateY(0); }
    }
    .form-container h2 {
      text-align: center;
      color: var(--verde-agua);
      margin-bottom: 20px;
    }
    label {
      display: block;
      margin-bottom: 5px;
      font-weight: 600;
      color: var(--texto);
    }
    input, select, textarea {
      width: 100%;
      padding: 12px;
      border: 1px solid #ccc;
      border-radius: 8px;
      margin-bottom: 15px;
      font-size: 15px;
      transition: border-color 0.3s, box-shadow 0.3s;
    }
    input:focus, select:focus, textarea:focus {
      outline: none;
      border-color: var(--verde-agua);
      box-shadow: 0 0 5px rgba(32,201,151,0.2);
    }
    #resultadoSolicitud {
      font-size: 15px;
      color: var(--texto);
      margin-top: 10px;
      margin-bottom: 20px;
    }
    /* Botón principal */
    button[type="submit"] {
      width: 100%;
      padding: 12px;
      background: linear-gradient(45deg, var(--verde-agua), var(--turquesa));
      color: white;
      border: none;
      border-radius: 8px;
      font-size: 16px;
      font-weight: bold;
      cursor: pointer;
      margin-bottom: 15px;
      transition: transform 0.1s, box-shadow 0.3s;
    }
    button[type="submit"]:hover {
      box-shadow: 0 4px 12px rgba(0,0,0,0.2);
      transform: translateY(-2px);
    }
    /* Botones secundarios */
    .btn-secondary {
      width: 100%;
      padding: 12px;
      background: linear-gradient(45deg, var(--gris-sec), var(--azul-claro));
      color: white;
      border: none;
      border-radius: 8px;
      font-size: 15px;
      font-weight: bold;
      cursor: pointer;
      margin: 8px 0;
      transition: transform 0.1s, box-shadow 0.3s;
    }
    .btn-secondary:hover {
      box-shadow: 0 4px 12px rgba(0,0,0,0.2);
      transform: translateY(-2px);
    }
    footer {
      position: fixed;
      bottom: 0; left: 0; width: 100%;
      text-align: center;
      padding: 10px;
      background-color: #e4e4e4;
      color: #555;
      font-size: 14px;
      box-shadow: 0 -2px 5px rgba(0,0,0,0.1);
    }
  </style>
</head>
<body>
  <header class="navbar">
    <span>ARIS INDUSTRIA</span>
    <div>Reporte de Solicitudes</div>
  </header>

  <section class="main-content">
    <div class="form-container">
      <h2>Registrar Reporte</h2>
      <form method="POST" action="../controladores/reporteController.php">
        <input type="hidden" name="accion" value="registrar" />

        <label for="codigoR">Código de Solicitud (4 dígitos):</label>
        <input
          type="text"
          id="codigoR"
          name="codigoR"
          maxlength="4"
          placeholder="Ej: 1234"
          required
          oninput="buscarSolicitudPorCodigo(this.value)"
        />

        <div id="resultadoSolicitud"></div>

        <label for="estadoR">Estado de la Solicitud:</label>
        <select name="estadoR" id="estadoR" required>
          <option value="">-- Seleccione --</option>
          <option value="Almacenado">Almacenado</option>
          <option value="Entregado">Entregado</option>
          <option value="Cancelado">Cancelado</option>
        </select>

        <label for="observacion">Descripción:</label>
        <textarea
          id="observacion"
          name="observacion"
          rows="3"
          placeholder="Ingrese una observación..."
          required
        ></textarea>

        <label for="fecha_seguimiento">Fecha de Registro:</label>
        <input
          type="date"
          id="fecha_seguimiento"
          name="fecha_seguimiento"
          required
        />

        <button type="submit">Registrar Reporte</button>
        <button
          type="button"
          class="btn-secondary"
          onclick="location.href='frmReporteSolicitudesRegistradas.php'"
        >
          Ver Reportes
        </button>
        <button
          type="button"
          class="btn-secondary"
          onclick="location.href='frmPrincipalAdm.php'"
        >
          Volver al Panel Principal
        </button>
      </form>
    </div>
  </section>

  <footer>
    © 2025 ARIS Industrial. Todos los derechos reservados.
  </footer>

  <script>
    function buscarSolicitudPorCodigo(codigo) {
      const out = document.getElementById('resultadoSolicitud');
      if (/^\d{4}$/.test(codigo)) {
        fetch('../metodos/buscar_Solicitud.php?codigo=' + codigo)
          .then(res => res.text())
          .then(data => out.innerHTML = data)
          .catch(() => out.innerHTML = 'Error al buscar la solicitud.');
      } else {
        out.innerHTML = '';
      }
    }
  </script>
</body>
</html>
