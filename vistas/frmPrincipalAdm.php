<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <title>Panel de Administrador | ARIS</title>
  <style>
    :root {
      --verde-agua: #20c997;
      --verde-agua-dark: #17ad7f;
      --gris-fondo: #f7f7f7;
      --gris-claro: #f2f4f6;
      --texto-claro: #fff;
      --texto-oscuro: #222;
      --gris-texto: #555;
    }
    * { box-sizing: border-box; }
    body {
      margin: 0; padding: 0;
      font-family: 'Segoe UI', sans-serif;
      background-color: var(--gris-fondo);
      display: flex; flex-direction: column; min-height: 100vh;
    }
    header {
      position: relative;
      background: linear-gradient(to right, var(--verde-agua-dark), var(--verde-agua));
      color: var(--texto-claro);
      padding: 30px 20px 20px;
      text-align: center;
      border-bottom-left-radius: 30px;
      border-bottom-right-radius: 30px;
      box-shadow: inset 0 -4px 10px rgba(0,0,0,0.3);
    }
    .logout {
      position: absolute; top: 20px; right: 30px;
    }
    .logout a {
      background-color: var(--texto-claro);
      color: var(--verde-agua);
      padding: 8px 14px;
      text-decoration: none;
      border-radius: 6px;
      font-weight: bold;
      font-size: 13px;
      transition: background 0.3s, color 0.3s;
    }
    .logout a:hover {
      background-color: var(--texto-oscuro);
      color: var(--texto-claro);
    }
    header h1 { margin: 0; font-size: 28px; letter-spacing: 1px; font-weight: bold; text-shadow: 1px 1px 2px #333; }
    header p { margin: 5px 0 0; font-size: 14px; font-weight: 300; color: rgba(255,255,255,0.85); }

    .container { flex: 1; display: flex; justify-content: center; align-items: center; padding: 40px 20px; }
    .grid {
      display: flex; flex-wrap: wrap; gap: 25px;
      justify-content: center; max-width: 900px; width: 100%;
      opacity: 0; transform: translateY(20px);
      animation: fadeIn 0.8s forwards ease-out;
    }
    @keyframes fadeIn {
      to { opacity: 1; transform: translateY(0); }
    }

    .card {
      background: var(--gris-claro);
      border-radius: 12px;
      padding: 20px;
      text-align: center;
      box-shadow: 0 5px 10px rgba(0,0,0,0.1);
      transition: transform 0.3s ease, box-shadow 0.3s ease;
      flex: 0 1 calc(50% - 25px);
      max-width: 400px;
      will-change: transform;
    }
    .card:hover { box-shadow: 0 10px 20px rgba(0,0,0,0.15); }

    .card h3 { margin: 10px 0; font-size: 16px; color: var(--texto-oscuro); }
    .card p  { font-size: 13px; color: var(--gris-texto); min-height: 40px; }

    .card a {
      margin-top: 15px; display: inline-block;
      padding: 8px 14px; font-size: 13px;
      background-color: var(--verde-agua);
      color: var(--texto-claro);
      text-decoration: none; border-radius: 5px;
      font-weight: bold; transition: background 0.3s;
    }
    .card a:hover { background-color: var(--verde-agua-dark); }

    footer {
      text-align: center; padding: 15px;
      background: var(--gris-claro); color: #aaa; font-size: 12px;
    }
    @media (max-width: 768px) {
      .card { flex: 0 1 100%; }
    }
  </style>
</head>
<body>

  <header>
    <div class="logout">
      <a href="../index.php">Cerrar sesión</a>
    </div>
    <h1>PANEL DE ADMINISTRADOR</h1>
    <p>Atención al Cliente ARIS</p>
  </header>

  <div class="container">
    <div class="grid">
      <div class="card" data-tilt data-tilt-glare data-tilt-max-glare="0.2">
        <h3>🧑 Registro del Cliente</h3>
        <p>Agrega nuevos clientes con sus datos básicos y contacto.</p>
        <a href="frmRegistrarCliente.php">Ingresar</a>
      </div>

      <div class="card" data-tilt data-tilt-glare data-tilt-max-glare="0.2">
        <h3>📝 Registro de Solicitud</h3>
        <p>Registra solicitudes de clientes según prioridad y tipo.</p>
        <a href="frmRegistroSolicitud.php">Ingresar</a>
      </div>

      <div class="card" data-tilt data-tilt-glare data-tilt-max-glare="0.2">
        <h3>📊 Reporte de Solicitud</h3>
        <p>Consulta los reportes por estado o rango de fechas.</p>
        <a href="frmReporteSolicitud.php">Ver Reportes</a>
      </div>

      <div class="card" data-tilt data-tilt-glare data-tilt-max-glare="0.2">
        <h3>📢 Registro de Reclamos</h3>
        <p>Captura y gestiona los reclamos realizados por clientes.</p>
        <a href="frmRegistroReclamo.php">Registrar Reclamo</a>
      </div>

      <div class="card" data-tilt data-tilt-glare data-tilt-max-glare="0.2">
        <h3>🧑‍💼 Registro de Usuario</h3>
        <p>Agrega nuevos usuarios con su rol correspondiente de los Trabajadores.</p>
        <a href="frmUsuariosRegistrados.php">Usuarios Registrados</a>
      </div>
    </div>
  </div>

  <footer>
    © 2025 ARIS Industrial. Todos los derechos reservados.
  </footer>

  <!-- Vanilla Tilt (sin cambiar rutas de botones) -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/vanilla-tilt/1.7.2/vanilla-tilt.min.js"></script>
  <script>
    VanillaTilt.init(document.querySelectorAll(".card"), {
      max: 15,
      speed: 400,
      glare: true,
      "max-glare": 0.2
    });
  </script>
</body>
</html>
