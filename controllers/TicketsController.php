<?php

class TicketsController
{
        public function inicio()
        {
            session_start();
            $rol = $_SESSION['usuario']['rol'] ?? null;
            require_once BASE_PATH . '/views/radicar_tickets.php';
           
        }

}
