<?php
// controllers/GestionarController.php
require_once __DIR__ . '/../config/db.php';

class GestionarController {

    
    public function ver() {
        global $db;

        try {
            $result = $db->query(
                "SELECT tp.*, e.descripcion AS estado_descripcion
                 FROM tickets_pqrs tp
                 JOIN estado e ON tp.estado_id = e.id
                 ORDER BY tp.fecha_creacion DESC"
            );
            $tickets = $result->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            die('Error al obtener tickets: ' . $e->getMessage());
        }

        // Cambiado para cargar views/gestionar.php
        require_once BASE_PATH . '/views/gestionar.php';
    }

    public function actualizarEstado() {
        global $db;

        if (isset($_POST['id_ticket'], $_POST['estado_id'])) {
            $id_ticket = $_POST['id_ticket'];
            $estado_id = $_POST['estado_id'];

            try {
                $stmt = $db->prepare(
                    "UPDATE tickets_pqrs 
                     SET estado_id = :estado_id 
                     WHERE id_ticket = :id_ticket"
                );
                $stmt->execute([
                    'estado_id' => $estado_id,
                    'id_ticket' => $id_ticket
                ]);
            } catch (Exception $e) {
                die('Error al actualizar estado: ' . $e->getMessage());
            }
        }

        header("Location: index.php?controller=gestionar&action=ver");
        exit();
    }
}
