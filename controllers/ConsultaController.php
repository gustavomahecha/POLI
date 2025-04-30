<?php
require_once '../config/db.php';
require_once '../models/Solicitud.php';

$id_ticket = null;
$error = null;

if (isset($_GET['id_ticket'])) {
    $id_ticket = trim($_GET['id_ticket']);
    $modelo = new Solicitud($db);

    try {
        $ticket = $modelo->buscarPorTicket($id_ticket);
    } catch (Exception $e) {
        $error = $e->getMessage();
    }
}

require_once '../views/consultar_solicitud.php';
