
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>CARMESY - Radicar Solicitudes</title>
  <!-- Conexión al CSS externo -->
  <link rel="stylesheet" href="../public/css/radicar_solicitudes.css">
  <link rel="stylesheet" href="../public/css/principal.css">
  <link rel="stylesheet" href="../public/css/modal_ticket.css">
  <script src="../public/js/modal_ticket.js"></script>

</head>
<body>

  <!-- Encabezado -->
  <header class="encabezado">
  <div class="encabezado__logo">
    <img src="../public/img/logo.png" alt="Logo">
    <span class="marca">CARMESY</span>
  </div>

  <div class="encabezado__titulo">RADICAR TICKETS</div>

  <div class="encabezado__acciones">
    <a href="index.php?controller=InicioSesion&action=logout" class="btn-header">Cerrar sesión</a>
  </div>
</header>

  <!-- Contenido principal con enlaces a otras vistas -->
  <main class="contenido-principal">
  <div class="contenedor-botones">
    <!-- Enlace a la vista del formulario para nueva solicitud -->
    <a href="index.php?controller=solicitud&action=ver" class="opcion-solicitud">
      <i class="icono">📄➕</i>
      <span class="texto-opcion">NUEVA SOLICITUD</span>
    </a>

    <!-- Enlace a la vista de consulta de solicitudes -->
    <a href="../controllers/ConsultaController.php" class="opcion-solicitud">
      <i class="icono">📄🔍</i>
      <span class="texto-opcion">CONSULTAR SOLICITUD</span>
    </a>
    <a href="index.php?controller=gestionar&action=ver" class="opcion-solicitud">
      <i class="icono">📄➕</i>
      <span class="texto-opcion">GESTIONAR TICKETS</span>
    </a>
    <!-- Enlace a la vista de consulta de solicitudes -->
    <?php if (isset($rol) && $rol === 'super_admin'): ?>
<a href="index.php?controller=admin&action=inicio" class="opcion-solicitud">
  <i class="icono">📄🔍</i>
  <span class="texto-opcion">GESTIONAR ADMINIS</span>
</a>
<?php endif; ?>

    </div>
  </main>

  <!-- Pie de página -->
  <footer class="pie-pagina">
    Tel (+57) 601 0000000 - Dirección - www.Carmesy.com - @carmesy
  </footer>
  
</body>
</html>
