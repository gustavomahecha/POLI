<?php
try {
    $db = new PDO('mysql:host=localhost;dbname=carmesy_db;charset=utf8', 'root', '');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (Exception $e) {
    die('Error de conexión: ' . $e->getMessage());
}
?>
