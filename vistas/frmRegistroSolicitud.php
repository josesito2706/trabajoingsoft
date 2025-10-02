<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Registro de Solicitudes</title>
  <style>
    :root {
      --verde-agua: #20c997;
      --turquesa: #37d1b1;
      --gris-fondo: #f3f3f3;
      --azul-claro: #8ecae6;
      --gris-claro: #adb5bd;
      --texto: #333;
    }
    * { box-sizing: border-box; }
    body {
      margin: 0;
      font-family: 'Segoe UI', sans-serif;
      background-color: var(--gris-fondo);
      min-height: 100vh;
      display: flex;
      flex-direction: column;
    }
    .navbar {
      background-color: var(--verde-agua);
      color: white;
      padding: 15px 30px;
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
      align-items: center;
      padding: 40px 20px;
    }
    .form-container {
      background-color: white;
      padding: 40px 30px;
      border-radius: 16px;
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
      width: 100%;
      max-width: 450px;
      position: relative;
      opacity: 0;
      transform: translateY(20px);
      animation: fadeIn 0.8s forwards ease-out;
    }
    @keyframes fadeIn {
      to { opacity: 1; transform: translateY(0); }
    }
    .form-container h2 {
      text-align: center;
      color: var(--verde-agua);
      margin-bottom: 25px;
    }
    label {
      display: block;
      margin-bottom: 5px;
      font-weight: 600;
      color: var(--texto);
    }
    input[type="text"], input[type="date"], select, textarea {
      width: 100%;
      padding: 10px;
      border: 1px solid #ccc;
      border-radius: 8px;
      margin-bottom: 20px;
      font-size: 15px;
      transition: border-color 0.3s, box-shadow 0.3s;
    }
    input:focus, select:focus, textarea:focus {
      outline: none;
      border-color: var(--verde-agua);
      box-shadow: 0 0 5px rgba(32,201,151,0.2);
    }

    /* Botón principal con degradado verde-turquesa */
    button[type="submit"] {
      width: 100%;
      padding: 12px;
      background: linear-gradient(45deg, var(--verde-agua), var(--turquesa));
      color: #fff;
      border: none;
      border-radius: 8px;
      font-size: 16px;
      font-weight: bold;
      cursor: pointer;
      transition: transform 0.1s, box-shadow 0.3s;
      margin-bottom: 15px; /* espacio debajo */
    }
    button[type="submit"]:hover {
      box-shadow: 0 4px 12px rgba(0,0,0,0.2);
      transform: translateY(-2px);
    }

    /* Botones secundarios con degradado gris-azul */
    .btn-secondary {
      width: 100%;
      padding: 12px;
      background: linear-gradient(45deg, var(--gris-claro), var(--azul-claro));
      color: #fff;
      border: none;
      border-radius: 8px;
      font-size: 15px;
      font-weight: bold;
      cursor: pointer;
      transition: transform 0.1s, box-shadow 0.3s;
      margin: 8px 0; /* espacio vertical */
    }
    .btn-secondary:hover {
      box-shadow: 0 4px 12px rgba(0,0,0,0.2);
      transform: translateY(-2px);
    }

    .cliente-container {
      display: flex;
      gap: 10px;
      align-items: center;
      margin-bottom: 20px;
    }
    .cliente-container input[type="text"] {
      flex: 1;
      margin-bottom: 0;
    }

    footer {
      text-align: center;
      padding: 15px;
      background-color: #e4e4e4;
      color: #555;
      font-size: 14px;
      margin-top: auto;
    }
  </style>
</head>
<body>
  <header class="navbar">
    <span>ARIS INDUSTRIA</span>
    <div>Registro de Solicitudes</div>
  </header>

  <section class="main-content">
    <div class="form-container">
      <h2>Registrar Solicitud</h2>
      <form action="frmSolicitudesRegistradas.php" method="post">

        <label for="codigo">Código:</label>
        <input type="text" name="codigo" id="codigo" required />

        <label for="descripcion">Descripción:</label>
        <textarea name="descripcion" id="descripcion" required></textarea>

        <label for="fecha_registro">Fecha de Registro:</label>
        <input type="date" name="fecha_registro" id="fecha_registro" required />

        <label for="estado">Estado:</label>
        <select name="estado" id="estado" required>
          <option value="">-- Seleccione --</option>
          <option value="Activo">Activo</option>
          <option value="Inactivo">Inactivo</option>
          <option value="En Proceso">En Proceso</option>
        </select>

        <label for="cliente_dni">DNI del Cliente:</label>
        <div class="cliente-container">
          <input
            type="text"
            name="cliente_dni"
            id="cliente_dni"
            maxlength="8"
            placeholder="Ingresa DNI..."
            oninput="buscarClientePorDNI(this.value)"
            required
          />
        </div>
        <div id="datosCliente" style="font-size: 15px; color: var(--texto); margin-bottom: 20px;"></div>

        <button type="submit">Registrar</button>
        <button
          type="button"
          class="btn-secondary"
          onclick="location.href='frmPrincipalAdm.php'"
        >
          Volver al Panel Principal
        </button>
        <button
          type="button"
          class="btn-secondary"
          onclick="location.href='frmSolicitudesRegistradas.php'"
        >
          Ver Solicitudes Registradas
        </button>
      </form>
    </div>
  </section>

  <footer>
    © 2025 ARIS Industrial. Todos los derechos reservados.
  </footer>

  <script>
    function buscarClientePorDNI(dni) {
      const out = document.getElementById('datosCliente');
      if (/^\d{8}$/.test(dni)) {
        fetch('../metodos/buscar_Cliente.php?dni=' + dni)
          .then(res => res.text())
          .then(data => out.innerHTML = data)
          .catch(() => out.innerHTML = '');
      } else {
        out.innerHTML = '';
      }
    }
  </script>
</body>
</html>
