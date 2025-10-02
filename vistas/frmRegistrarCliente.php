<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Registro de Cliente</title>
  <style>
    :root {
      --verde-agua: #20c997;
      --verde-agua-dark: #17ad7f;
      --gris-fondo: #d3d3d3;
      --gris-claro: #eeeeee;
      --texto-oscuro: #333;
    }
    * { box-sizing: border-box }
    html, body {
      margin: 0; padding: 0; height: 100%;
      background: linear-gradient(to bottom right, var(--gris-fondo), var(--gris-claro));
      font-family: 'Segoe UI', sans-serif;
    }
    body {
      display: flex;
      flex-direction: column;
      justify-content: space-between; /* asegura footer abajo */
      align-items: center;
    }
    .form-container {
      background: #fff;
      padding: 30px 40px;
      border-radius: 15px;
      box-shadow: 0 8px 25px rgba(0,0,0,0.1);
      width: 350px;
      opacity: 0;
      transform: translateY(20px);
      animation: fadeIn 0.8s forwards ease-out;
      margin-top: 40px; /* separa del top */
    }
    @keyframes fadeIn {
      to { opacity: 1; transform: translateY(0); }
    }
    h2 {
      text-align: center;
      color: var(--verde-agua);
      margin-bottom: 10px;
    }
    .linea {
      height: 3px;
      width: 60px;
      background-color: var(--verde-agua);
      margin: 0 auto 30px;
      border-radius: 2px;
    }
    label {
      font-weight: bold;
      color: var(--texto-oscuro);
      display: block;
      margin: 15px 0 5px;
    }
    input[type="text"],
    input[type="email"] {
      width: 100%;
      padding: 10px;
      border: 1px solid #ccc;
      border-radius: 6px;
      font-size: 14px;
      transition: border-color 0.3s, box-shadow 0.3s;
    }
    input:focus {
      outline: none;
      border-color: var(--verde-agua);
      box-shadow: 0 0 5px rgba(32,201,151,0.2);
    }
    input[type="submit"],
    .btn-regresar {
      width: 100%;
      padding: 12px;
      margin-top: 15px;
      background-color: var(--verde-agua);
      color: #fff;
      border: none;
      border-radius: 6px;
      font-weight: bold;
      font-size: 16px;
      cursor: pointer;
      text-decoration: none;
      display: inline-block;
      transition: background 0.3s, transform 0.1s;
    }
    input[type="submit"]:hover,
    .btn-regresar:hover {
      background-color: var(--verde-agua-dark);
      transform: translateY(-1px);
    }
    footer {
      width: 100%;
      text-align: center;
      padding: 15px 0;
      background: transparent;
      color: var(--texto-oscuro);
      font-size: 13px;
    }
  </style>
</head>
<body>

  <div class="form-container" data-tilt data-tilt-glare data-tilt-max-glare="0.2">
    <h2>Registrar Cliente</h2>
    <div class="linea"></div>
    <form action="frmClientesRegistrados.php" method="POST">
      <label for="dni">DNI</label>
      <input type="text" id="dni" name="dni" maxlength="8" required>
      <label for="nombre">Nombre</label>
      <input type="text" id="nombre" name="nombre" maxlength="50" required>
      <label for="correo">Correo</label>
      <input type="email" id="correo" name="correo" maxlength="50" required>
      <label for="telefono">Teléfono</label>
      <input type="text" id="telefono" name="telefono" maxlength="9" required>
      <input type="submit" value="Registrar">
    </form>
    <a href="frmPrincipalAdm.php" class="btn-regresar"> ← Volver al Panel Principal</a>
    <a href="frmClientesRegistrados.php" class="btn-regresar">📋 Ver Clientes Registrados</a>
  </div>

  <footer>
    © 2025 ARIS Industrial. Todos los derechos reservados.
  </footer>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/vanilla-tilt/1.7.2/vanilla-tilt.min.js"></script>
  <script>
    VanillaTilt.init(document.querySelectorAll(".form-container"), {
      max: 10, speed: 400, glare: true, "max-glare": 0.2
    });
  </script>
</body>
</html>
w