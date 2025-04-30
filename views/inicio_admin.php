<?php if(!defined('BASE_PATH')) exit; // seguridad ?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>CARMESY – Iniciar sesión</title>
  <style>
    * { box-sizing: border-box; margin:0; padding:0; }
    html, body { height:100%; font-family: sans-serif; }
    body { display:flex; flex-direction:column; }

    /* Header rojo */
    header { background:#c00; color:#fff; padding:1rem 2rem;
             display:flex; justify-content:space-between; align-items:center; }
    header .logo { font-size:1.4rem; font-weight:bold; align-items:center;}
    header nav a { color:#fff; margin-left:1rem; text-decoration:none; }
    header nav a.active { text-decoration:underline; }

    /* Fondo claro con pattern opcional */
    main { flex:1; background:#f0f0f0 url('../public/img/pattern.png') center/cover no-repeat;
           display:flex; justify-content:center; align-items:center; }

    /* Tarjeta de login */
    .card {
      background:#fff; padding:2rem; border-radius:8px;
      box-shadow:0 4px 12px rgba(0,0,0,0.1); width:320px; text-align:left;
    }
    .card h2 { margin-bottom:1.5rem; font-size:1.5rem; }
    .card label { display:block; margin-bottom:0.2rem; font-size:0.9rem; color:#333; }
    .card input {
      width:100%; padding:.6rem; margin-bottom:1.2rem;
      border:1px solid #ccc; border-radius:4px;
    }
    .card .error { color:#c00; margin-bottom:1rem; font-size:.9rem; }

    .card button {
      width:100%; padding:.8rem; border:none; border-radius:20px;
      background:#ccc; font-size:1rem; cursor:pointer;
    }
    .card button:hover { background:#bbb; }

    /* Footer */
    footer { text-align:center; padding:.8rem; font-size:.8rem; background:#fff; }
  </style>
</head>
<body>

  <header>
    <div class="logo">CARMESY</div>
    
  </header>

  <main>
    <div class="card">
      <h2>Iniciar sesión</h2>
      <?php if (!empty($error)): ?>
        <div class="error"><?= htmlspecialchars($error) ?></div>
      <?php endif; ?>

      <form method="POST" action="index.php?controller=InicioSesion&action=login">
        <label for="correo">Usuario</label>
        <input type="email" id="correo" name="correo" placeholder="Correo electrónico" required>

        <label for="contrasena">Contraseña</label>
        <input type="password" id="contrasena" name="contrasena" placeholder="Contraseña" required>

        <button type="submit">Iniciar</button>
      </form>
    </div>
  </main>

  <footer>
    Tel (+57) 601 0000000 – Dirección – www.Carmesy.com – @carmesy
  </footer>

</body>
</html>
 