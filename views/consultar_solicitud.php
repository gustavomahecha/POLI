<?php
if (!isset($ticket)) $ticket = null;
if (!isset($error)) $error = null;
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Consultar Solicitud - CARMESY</title>
  <link rel="stylesheet" href="../public/css/consultar_solicitud.css">
  <link rel="stylesheet" href="../public/css/principal.css">
</head>
<body>

  <!-- Encabezado -->
  <header class="encabezado">
  <div class="encabezado__logo">
    <img src="../public/img/logo.png" alt="Logo">
    <span class="marca">CARMESY</span>
  </div>

  <div class="encabezado__titulo">CONSULTAR SOLICITUD</div>

  <div class="encabezado__acciones">
    <a href="../public/index.php?controller=inicio&action=inicio" class="btn-header secondary">← Volver</a>
  </div>
</header>




  <!-- Contenido principal -->
  <main class="contenido-principal">

    <!-- Formulario de búsqueda -->
    <div class="contenedor-formulario">
      <h2>Buscar Solicitud</h2>
      <form method="GET" action="../controllers/ConsultaController.php">
        <div class="busqueda-ticket">
          <input type="text" name="id_ticket" placeholder="Ingrese número de ticket" required>
          <button type="submit" class="boton-buscar">Buscar</button>
        </div>
      </form>
    </div>

    <!-- Resultados de la búsqueda -->
    

  <?php if ($error): ?>
    <p style="color: red;"><?= $error ?></p>

  <?php elseif ($ticket): ?>
    <div class="contenedor-formulario">
    <h2>🎫 Detalles del Ticket: <?= htmlspecialchars($_GET['id_ticket']) ?></h2>
  
    <div class="formulario-grid">

      <div class="grupo-formulario">
        <label for="nombres">Nombres</label>
        <input type="text" value="<?= $ticket['nombres'] ?>" readonly>
      </div>

      <div class="grupo-formulario">
        <label for="apellidos">Apellidos</label>
        <input type="text" value="<?= $ticket['apellidos'] ?>" readonly>
      </div>

      <div class="grupo-formulario">
        <label for="documento">Documento</label>
        <input type="text" value="<?= $ticket['documento'] ?>" readonly>
      </div>

      <div class="grupo-formulario">
        <label for="tipo_documento">Tipo de Documento</label>
        <input type="text" value="<?= $ticket['tipo_documento'] ?? 'No disponible' ?>" readonly>
      </div>

      <div class="grupo-formulario">
        <label for="telefono">Teléfono</label>
        <input type="text" value="<?= $ticket['telefono'] ?? 'No disponible' ?>" readonly>
      </div>

      <div class="grupo-formulario">
        <label for="direccion">Dirección</label>
        <input type="text" value="<?= $ticket['direccion'] ?? 'No disponible' ?>" readonly>
      </div>

      <div class="grupo-formulario">
        <label for="tipo_solicitud">Tipo de Solicitud</label>
        <input type="text" value="<?= $ticket['tipo_solicitud'] ?>" readonly>
      </div>

      <div class="grupo-formulario">
        <label for="estado">Estado</label>
        <input type="text" value="<?= $ticket['estado'] ?? 'Sin estado' ?>" readonly>
      </div>

      <div class="grupo-formulario descripcion-full">
        <label for="descripcion">Descripción</label>
        <textarea readonly><?= $ticket['descripcion'] ?></textarea>
      </div>
      <div class="campo-formulario">
        <label for="fecha_registro">Fecha de Registro</label>
        <input type="text" value="<?= $ticket['fecha_registro'] ?? 'No disponible' ?>" readonly>
      </div>

      <div class="campo-formulario">
        <label for="fecha_respuesta">Fecha de Respuesta</label>
        <input type="text" value="<?= $ticket['fecha_respuesta'] ?? 'No disponible' ?>" readonly>
      </div>

      <div class="grupo-formulario descripcion-full">
        <label for="solucion">Solución</label>
        <textarea readonly><?= $ticket['solucion'] ?? 'Sin respuesta aún.' ?></textarea>
      </div>
    </div>

  <?php elseif (isset($_GET['id_ticket'])): ?>
    <p>No se encontró ninguna solicitud con ese código.</p>
  <?php endif; ?>
</div>


  </main>

  <!-- Pie de página -->
  <footer class="pie-pagina">
    Tel (+57) 601 0000000 - Dirección - www.Carmesy.com - @carmesy
  </footer>

</body>
</html>
