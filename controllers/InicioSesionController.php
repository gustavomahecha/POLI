<?php
class InicioSesionController {
    public function inicio() {
        session_start();
        if (isset($_SESSION['usuario'])) {
            header('Location: index.php?controller=InicioSesion&action=dashboard');
            exit;
        }
        require_once BASE_PATH . '/views/inicio_admin.php';
    }

    public function login() {
        require_once BASE_PATH . '/config/db.php';
        global $db;
        session_start();

        $error = null;
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $correo     = trim($_POST['correo']);
            $contrasena = trim($_POST['contrasena']);

            // Buscar usuario por correo
            $stmt = $db->prepare("SELECT * FROM usuarios_admin WHERE correo = :correo LIMIT 1");
            $stmt->bindParam(':correo', $correo);
            $stmt->execute();
            $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

            // Comparación directa de texto plano
            if ($usuario && $contrasena === $usuario['contrasena']) {
                $_SESSION['usuario'] = $usuario;
                header('Location: index.php?controller=InicioSesion&action=dashboard');
                exit;
            } else {
                $error = "Usuario o contraseña incorrectos.";
            }
        }

        // Si no es POST o credenciales erróneas, vuelve al formulario
        require_once BASE_PATH . '/views/inicio_admin.php';
    }

    public function dashboard() {
        session_start();
        if (!isset($_SESSION['usuario'])) {
            header('Location: index.php?controller=InicioSesion&action=inicio');
            exit;
        }
        
        $rol = $_SESSION['usuario']['rol'];
        if ($rol === 'super_admin') {
            // Redirigir al AdminController
            header('Location: index.php?controller=tickets&action=inicio');
            exit;
        } else {
            // Si no es super admin, mostrar su dashboard normal
            header('Location: index.php?controller=tickets&action=inicio');
        }
    }
    

    public function logout() {
        session_start();
        session_destroy();
        header('Location: index.php?controller=InicioSesion&action=inicio');
        exit;
    }
}

 