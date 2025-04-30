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

  <div class="encabezado__titulo">RADICAR SOLICITUDES</div>
  
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
    <!-- Enlace a la vista de administradores -->
    <a href="index.php?controller=InicioSesion&action=inicio" class="opcion-solicitud">
  <i class="icono">👤</i>
  <span class="texto-opcion">¿ERES ADMINISTRADOR?</span>
</a>
</div>

  </main>

  <!-- Pie de página -->
  <footer class="pie-pagina">
    Tel (+57) 601 0000000 - Dirección - www.Carmesy.com - @carmesy
  </footer>
  
  <?php if (isset($_GET['id_ticket'])): ?>
  <div id="ticketModal" class="modal">
    <div class="modal-content">
      <div class="modal-header">
        <span class="close">&times;</span>
        <h2>🎫 Ticket Generado</h2>
      </div>
      <div class="modal-body">
        <p>Tu solicitud fue registrada exitosamente.</p>
        <p><strong>ID del Ticket:</strong> <?= htmlspecialchars($_GET['id_ticket']) ?></p>
      </div>
      <div class="modal-footer">
        <button id="aceptarBtn">Aceptar</button>
      </div>
    </div>
  </div>

<?php endif; ?>

</body>
</html>
