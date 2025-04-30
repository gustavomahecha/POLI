<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>CARMESY - Formulario Solicitudes</title>
  <link rel="stylesheet" href="../public/css/formulario_solicitudes.css">
  <link rel="stylesheet" href="../public/css/principal.css">

</head>
<body>

  <!-- Encabezado -->
  <header class="encabezado">
  <div class="encabezado__logo">
    <img src="../public/img/logo.png" alt="Logo">
    <span class="marca">CARMESY</span>
  </div>

  <div class="encabezado__titulo">FORMULARIO SOLICITUDES</div>

  <div class="encabezado__acciones">
    <a href="index.php?controller=inicio&action=inicio" class="btn-header secondary">← Volver</a>
  </div>
</header>

 
  <!-- Contenido principal -->
  <main class="contenido-principal-form">
    <form class="formulario" action="../controllers/SolicitudController.php" method="POST">
      <div class="formulario-grid">
        <div class="campo-formulario">
          <label for="nombres">NOMBRES</label>
          <input type="text" id="nombres" name="nombres">
        </div>
    
        <div class="campo-formulario">
          <label for="apellidos">APELLIDOS</label>
          <input type="text" id="apellidos" name="apellidos">
        </div>
    
        <div class="campo-formulario">
          <label for="tipo_documento">TIPO DE DOCUMENTO</label>

          <?php
          require_once '../config/db.php';

            $query = $db->query("SELECT id, descripcion FROM tipo_documento");
            $tipos_documento = $query->fetchAll(PDO::FETCH_ASSOC);
            ?>

            <select id="tipo_documento" name="tipo_documento">
              <option value="">Seleccione una opción</option>
              <?php foreach ($tipos_documento as $tipo): ?>
                <option value="<?= $tipo['id'] ?>"><?= $tipo['descripcion'] ?></option>
              <?php endforeach; ?>
            
            </select>

        </div>
    
        <div class="campo-formulario">
          <label for="documento">DOCUMENTO</label>
          <input type="text" id="documento" name="documento">
        </div>
    
        <div class="campo-formulario">
          <label for="telefono">TELÉFONO</label>
          <input type="tel" id="telefono" name="telefono">
        </div>
    
        <div class="campo-formulario">
          <label for="correo">CORREO ELECTRÓNICO</label>
          <input type="email" id="correo" name="correo">
        </div>
    
        <div class="campo-formulario">
          <label for="direccion">DIRECCIÓN</label>
          <input type="text" id="direccion" name="direccion">
        </div>
    
        <div class="campo-formulario">
          <label for="tipo">TIPO DE SOLICITUD</label>
          <select id="tipo" name="tipo">
            <option value="">Seleccione una opción</option>
            <?php
              try {
                $db = new PDO('mysql:host=localhost;dbname=carmesy_db;charset=utf8', 'root', '');
                $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                $stmt = $db->query("SELECT id, descripcion FROM tipo_pqrs");
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                  echo "<option value=\"{$row['id']}\">{$row['descripcion']}</option>";
                }
              } catch (PDOException $e) {
                echo "<option>Error al cargar</option>";
              }
            ?>
          </select>
        </div>

      </div>
    
      <div class="campo-formulario descripcion-full">
        <label for="descripcion">DESCRIPCIÓN SOLICITUD</label>
        <textarea id="descripcion" name="descripcion"></textarea>
      </div>
    
      <div class="contenedor-boton">
        <button type="submit" class="boton-enviar">Enviar Solicitud</button>
      </div>
    </form>
    
    
  </main>

  <!-- Pie de página -->
  <footer class="pie-pagina">
    Tel (+57) 601 0000000 - Dirección - www.Carmesy.com - @carmesy
  </footer>

  <script src="../public/js/formulario_solicitudes.js"></script>

</body>
</html>
