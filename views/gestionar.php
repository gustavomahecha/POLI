<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Gestión de Tickets</title>
    <link rel="stylesheet" href="../public/css/principal.css">
  <link rel="stylesheet" href="../public/css/admin.css">
  
</head>
<body>
<header class="encabezado">
  <div class="encabezado__logo">
    <img src="../public/img/logo.png" alt="Logo">
    <span class="marca">CARMESY</span>
  </div>

  <div class="encabezado__titulo">PANEL ADMINISTRADOR</div>

  <div class="encabezado__acciones">
    <a href="index.php?controller=tickets&action=inicio" class="btn-header secondary">← Volver</a>
    <a href="index.php?controller=InicioSesion&action=logout" class="btn-header">Cerrar sesión</a>
  </div>
</header>
<div class="admin-panel">
  <h2>Gestión de Tickets</h2>


    <div class="admin-table-container">
    <table class="styled-table">
        <thead>
            <tr>
                <th>ID Ticket</th>
                <th>Nombre</th>
                <th>Correo</th>
                <th>Descripción</th>
                <th>Fecha</th>
                <th>Estado</th>
                <th>Actualizar Estado</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($tickets as $ticket): ?>
                <tr>
                    <td><?= htmlspecialchars($ticket['id_ticket']) ?></td>
                    <td><?= htmlspecialchars($ticket['nombres'] . ' ' . $ticket['apellidos']) ?></td>
                    <td><?= htmlspecialchars($ticket['correo']) ?></td>
                    <td><?= htmlspecialchars($ticket['descripcion']) ?></td>
                    <td><?= htmlspecialchars($ticket['fecha_creacion']) ?></td>
                    <td><?= htmlspecialchars($ticket['estado_descripcion']) ?></td>
                    <td>
                    <form action="index.php?controller=gestionar&action=actualizarEstado" method="POST" class="estado-form">
                      <input type="hidden" name="id_ticket" value="<?= htmlspecialchars($ticket['id_ticket']) ?>">
                      
                      <select name="estado_id" class="estado-select">
                          <option value="1" <?= $ticket['estado_id']==1 ? 'selected' : '' ?>>pendiente</option>
                          <option value="2" <?= $ticket['estado_id']==2 ? 'selected' : '' ?>>resuelto</option>
                          <option value="3" <?= $ticket['estado_id']==3 ? 'selected' : '' ?>>rechazado</option>
                      </select>
                      
                      <button type="submit" class="estado-btn">Guardar</button>
                  </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    </div>
    </div>
    <footer class="pie-pagina">
  Tel (+57) 601 0000000 - Dirección - www.Carmesy.com - @carmesy
</footer>

</body>
</html>
