<?php

class InicioController
{
    public function inicio()
    {
        session_start();

        if (isset($_SESSION['usuario'])) {
            // Usuario logueado
            require_once BASE_PATH . '/views/radicar_tickets.php';
        } else {
            // Usuario no logueado
            require_once BASE_PATH . '/views/radicar_solicitudes.php';
        }
    }
}
