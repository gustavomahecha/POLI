<?php
require_once '../models/Solicitud.php';
require_once '../config/db.php'; // Conexión DB

class SolicitudController
{
    public function ver()
    {
        global $db;
        require_once BASE_PATH . '/views/formulario_solicitudes.php';
    }
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = [
        'nombres' => $_POST['nombres'],
        'apellidos' => $_POST['apellidos'],
        'tipo_documento_id' => $_POST['tipo_documento'],
        'documento' => $_POST['documento'],
        'telefono' => $_POST['telefono'],
        'correo' => $_POST['correo'],
        'direccion' => $_POST['direccion'],
        'tipo_pqrs_id' => $_POST['tipo'],
        'descripcion' => $_POST['descripcion']
    ];

    $solicitud = new Solicitud($db);
    $id_ticket = $solicitud->guardar($data);

    if ($id_ticket) {
        header("Location: ../public/index.php?controller=inicio&action=inicio&id_ticket=$id_ticket");

        exit;
    } else {
        echo "Error al guardar la solicitud.";
    }

}



