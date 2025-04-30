<?php
class Solicitud {
    private $db;

    public function __construct($conexion) {
        $this->db = $conexion;
    }

    public function generarTicketID() {
        $numeros = str_pad(rand(0, 999), 3, '0', STR_PAD_LEFT);
        $letras = strtoupper(substr(str_shuffle("ABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 3));
        $ultimo = rand(0, 9);
        return "$numeros-$letras-$ultimo";
    }
    
    public function guardar($data) {
        // Generar y agregar el ID del ticket
        $data['id_ticket'] = $this->generarTicketID();
    
        // Consulta SQL para insertar el registro
        $sql = "INSERT INTO tickets_pqrs (
                    id_ticket, nombres, apellidos, tipo_documento_id, documento, telefono,
                    correo, direccion, tipo_pqrs_id, descripcion
                ) VALUES (
                    :id_ticket, :nombres, :apellidos, :tipo_documento_id, :documento, :telefono,
                    :correo, :direccion, :tipo_pqrs_id, :descripcion
                )";
    
        // Preparar y ejecutar
        $stmt = $this->db->prepare($sql);
        $stmt->execute($data);
    
        // Retornar el ID generado para usarlo en el controlador/redirección
        return $data['id_ticket'];
    }

    public function buscarPorTicket($ticket_id) {
        $sql = "SELECT 
            t.nombres, 
            t.apellidos, 
            t.documento,
            td.descripcion AS tipo_documento,
            t.telefono,
            t.direccion,
            tp.descripcion AS tipo_solicitud,
            t.descripcion,
            e.descripcion AS estado,
            r.respuesta AS solucion,
            t.fecha_creacion AS fecha_registro,
            r.fecha_respuesta
        FROM tickets_pqrs t
        LEFT JOIN tipo_pqrs tp ON t.tipo_pqrs_id = tp.id
        LEFT JOIN estado e ON t.estado_id = e.id
        LEFT JOIN respuestas_pqrs r ON r.id_ticket = t.id_ticket
        LEFT JOIN tipo_documento td ON t.tipo_documento_id = td.id
        WHERE t.id_ticket = :ticket_id";


    
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['ticket_id' => $ticket_id]);
    
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    
    
    
    
}
?>
