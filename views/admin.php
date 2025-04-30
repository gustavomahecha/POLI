<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>CARMESY - Gestión de Administradores</title>
  <link rel="stylesheet" href="../public/css/radicar_solicitudes.css">
  <link rel="stylesheet" href="../public/css/principal.css">
  <link rel="stylesheet" href="../public/css/admin.css">
  <link rel="stylesheet" href="../public/css/modal_admin.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
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



  
 
  <?php if (isset($_GET['status'])): ?>
  <div id="alerta-exito" class="alerta">
    
    <?php
      switch ($_GET['status']) {
        case 'creado':
          echo '✅ Registro creado correctamente.';
          break;
        case 'actualizado':
          echo '✅ Registro actualizado correctamente.';
          break;
        case 'eliminado':
          echo '✅ Registro eliminado correctamente.';
          break;
      }
    ?>
  </div>
<?php endif; ?>



<div class="admin-panel">
  <h2>Administradores</h2>

  <div class="admin-table-container">
    <table class="styled-table">
      <thead>
        <tr>
          <th>ID</th>
          <th>Correo</th>
          <th>Documento</th>
          <th>Nombres</th>
          <th>Rol</th>
          <th>Operaciones</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($admins as $admin): ?>
          <tr>
            <td><?= htmlspecialchars($admin['id_admin']) ?></td>
            <td><?= htmlspecialchars($admin['correo']) ?></td>
            <td><?= htmlspecialchars($admin['numero_documento']) ?></td>
            <td><?= htmlspecialchars($admin['nombres'] . ' ' . $admin['apellidos']) ?></td>
            <td><?= htmlspecialchars($admin['rol']) ?></td>
            <td>
              <button class="icon-btn edit" title="Editar"
                data-id="<?= $admin['id_admin'] ?>"
                data-nombres="<?= htmlspecialchars($admin['nombres']) ?>"
                data-apellidos="<?= htmlspecialchars($admin['apellidos']) ?>"
                data-correo="<?= htmlspecialchars($admin['correo']) ?>"
                data-numero_documento="<?= htmlspecialchars($admin['numero_documento']) ?>"
                data-tipo_documento="<?= htmlspecialchars($admin['tipo_documento_id']) ?>"
                data-telefono="<?= htmlspecialchars($admin['telefono']) ?>"
                data-direccion="<?= htmlspecialchars($admin['direccion']) ?>"
                data-rol="<?= htmlspecialchars($admin['rol']) ?>"
                onclick="editarAdmin(this)">
                <i class="fas fa-pen"></i>
              </button>

              <button class="icon-btn delete" title="Eliminar"
                data-id="<?= $admin['id_admin'] ?>"
                onclick="confirmarEliminacion(this)">
                <i class="fas fa-trash"></i>
              </button>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>

  <div class="admin-modal-footer">
    <button class="admin-btn-add" id="openModalBtn">➕ Añadir Admin</button>
  </div>
</div>

<!-- Modal -->
<div id="adminModal" class="modal">
  <div class="modal-content">
    <div class="modal-header">
      <h2 id="modal-title"><i class="fas fa-user-shield"></i> Administrador</h2>
      <span class="close" id="closeModalBtn">&times;</span>
    </div>

    <form id="adminForm" method="POST" action="index.php?controller=admin&action=crearAdmin">
      <div class="form-row">
        <div class="form-group">
          <label for="nombres">Nombres</label>
          <input type="text" id="nombres" name="nombres" required>
        </div>

        <div class="form-group">
          <label for="apellidos">Apellidos</label>
          <input type="text" id="apellidos" name="apellidos" required>
        </div>
      </div>

      <div class="form-row">
        <div class="form-group">
          <label for="tipo_documento">Tipo de Documento</label>
          <select id="tipo_documento" name="tipo_documento" required>
            <option value="">Seleccione una opción</option>
            <?php foreach ($tipos_documento as $tipo): ?>
              <option value="<?= htmlspecialchars($tipo['id']) ?>">
                <?= htmlspecialchars($tipo['descripcion']) ?>
              </option>
            <?php endforeach; ?>
          </select>
        </div>

        <div class="form-group">
          <label for="numero_documento">Documento</label>
          <input type="text" id="numero_documento" name="numero_documento" required>
        </div>
      </div>

      <div class="form-row">
        <div class="form-group">
          <label for="telefono">Teléfono</label>
          <input type="text" id="telefono" name="telefono">
        </div>

        <div class="form-group">
          <label for="correo">Correo Electrónico</label>
          <input type="email" id="correo" name="correo" required>
        </div>
      </div>

      <div class="form-row">
        <div class="form-group">
          <label for="direccion">Dirección</label>
          <input type="text" id="direccion" name="direccion">
        </div>

        <div class="form-group">
          <label for="rol">Rol</label>
          <select id="rol" name="rol" required>
            <option value="">Seleccione un rol</option>
            <option value="admin">Admin</option>
            <option value="super_admin">Super Admin</option>
          </select>
        </div>
      </div>

      <div id="contrasenaContainer" class="form-row" style="display: none;">
        <div class="form-group full-width">
          <label for="contrasena">Nueva Contraseña</label>
          <input type="password" id="contrasena" name="contrasena">
        </div>
      </div>

      <div class="form-submit">
        <button type="submit" class="btn-submit">Enviar</button>
      </div>
    </form>

    <div id="btn-cambiar-clave">
      <button type="button" onclick="mostrarCampoContrasena()">🔑 Cambiar clave</button>
    </div>
  </div>
</div>


<footer class="pie-pagina">
  Tel (+57) 601 0000000 - Dirección - www.Carmesy.com - @carmesy
</footer>

<!-- Scripts -->
<script src="../public/js/admin.js"></script>
<script>
function cerrarAlerta() {
  const alerta = document.getElementById('alerta-exito');
  if (alerta) {
    alerta.style.opacity = '0';
    setTimeout(() => {
      alerta.remove();

      const params = new URLSearchParams(window.location.search);
      params.delete('status');
      const nuevaUrl = window.location.origin + window.location.pathname + (params.toString() ? '?' + params.toString() : '');
      window.history.replaceState({}, document.title, nuevaUrl);
    }, 500);
  }
}

document.addEventListener('DOMContentLoaded', function () {
  const cerrarBtn = document.getElementById('cerrarAlerta');
  const alerta = document.getElementById('alerta-exito');

  if (cerrarBtn) {
    cerrarBtn.addEventListener('click', cerrarAlerta);
  }

  if (alerta) {
    setTimeout(cerrarAlerta, 4000);
  }
});
</script>

</body>
</html>
