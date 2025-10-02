<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <title>Login | Atención al Cliente ARIS</title>
  <style>
    :root {
      --gris-fondo: #f4f4f4;
      /* Cambiamos el “rojo” de ARIS por un verde agua */
      --rojo-aris: #20c997;
      --negro-aris: #1a1a1a;
      --overlay: rgba(20, 40, 60, 0.55);
    }

    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
      font-family: 'Segoe UI', sans-serif;
    }

    body {
      min-height: 100vh;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center; 
      background: url("img/banner.jpg") no-repeat center/cover fixed;
      position: relative;
    }

    .overlay {
      position: absolute;
      inset: 0;
      background: var(--overlay);
      backdrop-filter: blur(2px);
      z-index: 0;
    }

    .logo {
      position: absolute;
      top: 20px;
      left: 30px;
      z-index: 2;
    }

    .logo img {
      height: 70px;
    }

    h1 {
      z-index: 2;
      color: #fff;
      font-size: 2.3rem;
      font-weight: 700;
      letter-spacing: 1px;
      text-transform: uppercase;
      margin-bottom: 50px;
      text-align: center;
      text-shadow: 1px 1px 4px rgba(0, 0, 0, .45);
    }

    .login-box {
      z-index: 2;
      width: 340px;
      background: #fff;                    /* contenedor sigue blanco */
      border-radius: 14px;
      box-shadow: 0 8px 30px rgba(0, 0, 0, .2);
      padding: 45px 35px 40px;
      border-top: 6px solid var(--rojo-aris);  /* ahora verde agua */
      transition: 0.3s;
    }

    .login-box h2 {
      margin-bottom: 26px;
      color: var(--negro-aris);
      font-size: 1.4rem;
      font-weight: 600;
      text-align: center;
    }

    .login-box input {
      width: 100%;
      padding: 12px 14px;
      margin-bottom: 20px;
      font-size: .95rem;
      border: 1px solid #bbb;
      border-radius: 6px;
      transition: 0.3s;
    }

    .login-box input:focus {
      border-color: var(--rojo-aris);      /* verde agua al enfocar */
      outline: none;
      box-shadow: 0 0 0 3px rgba(32, 201, 151, 0.25);
    }

    .btn-group {
      display: flex;
      flex-direction: column;
      gap: 10px;
      margin-top: 10px;
    }

    .btn-group input[type="submit"] {
      width: 100%;
      padding: 12px;
      font-size: 1rem;
      border-radius: 6px;
      font-weight: 600;
      text-align: center;
      transition: 0.3s;
      background: var(--rojo-aris);        /* botón verde agua */
      color: #fff;
      border: none;
      cursor: pointer;
    }

    .btn-group input[type="submit"]:hover {
      background: var(--negro-aris);
    }

    footer {
      z-index: 2;
      margin-top: 30px;
      font-size: .75rem;
      color: #ddd;
      text-align: center;
    }

    @media (max-width: 480px) {
      .login-box {
        width: 90%;
        padding: 32px 25px;
      }

      h1 {
        font-size: 1.7rem;
        margin-bottom: 35px;
      }

      .logo img {
        height: 55px;
      }
    }
  </style>
</head>
<body>
  <!-- Capa oscura -->
  <div class="overlay"></div>

  <!-- Logo -->
  <div class="logo"><img src="img/ARIS-logo.png" alt="Logo ARIS"></div>

  <!-- Título -->
  <h1>Atención al Cliente ARIS</h1>

  <!-- Formulario de login -->
  <form class="login-box" action="controladores/loginController.php" method="post">
    <h2>Iniciar sesión</h2>
    <input type="text" name="username" placeholder="Ej: admin" required>
    <input type="password" name="password" placeholder="Contraseña" required>

    <?php
    if (isset($_GET['error'])) {
      echo "<p style='color:red; text-align:center;'>❌ Usuario o contraseña incorrectos.</p>";
    }
    ?>

    <!-- Botón de ingreso -->
    <div class="btn-group">
      <input type="submit" value="Ingresar">
    </div>
  </form>

  <!-- Pie -->
  <footer>© 2025 ARIS Industrial — Todos los derechos reservados</footer>
</body>
</html>
