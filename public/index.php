<?php
// Mostrar errores (SOLO en desarrollo, apágalo en producción)
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Definir la ruta base (una carpeta arriba de /public)
define('BASE_PATH', dirname(__DIR__));

// Cargar configuración de la base de datos
require_once BASE_PATH . '/config/db.php';

// Cargar automáticamente controladores y modelos
spl_autoload_register(function ($class) {
    // Buscar en la carpeta 'controllers'
    $controllerPath = BASE_PATH . '/controllers/' . $class . '.php';
    if (file_exists($controllerPath)) {
        require_once $controllerPath;
        return;
    }

    // Buscar en la carpeta 'models'
    $modelPath = BASE_PATH . '/models/' . $class . '.php';
    if (file_exists($modelPath)) {
        require_once $modelPath;
        return;
    }

    // Puedes agregar más carpetas aquí si quieres (services, helpers, etc.)
});

// Obtener el controlador y la acción desde la URL
$controller = isset($_GET['controller']) ? $_GET['controller'] : 'Inicio'; // Default: Inicio
$action = isset($_GET['action']) ? $_GET['action'] : 'inicio';              // Default: inicio()

// Armar el nombre de la clase del controlador
$controllerName = ucfirst($controller) . 'Controller';

// Verificar que el controlador exista
if (class_exists($controllerName)) {
    // Crear una instancia del controlador pasando $db
    $controllerObject = new $controllerName($db);

    // Verificar que la acción (método) exista
    if (method_exists($controllerObject, $action)) {
        // Acciones que requieren un parámetro ID
        $actionsWithId = ['eliminar', 'editarAdmin'];

        if (in_array($action, $actionsWithId)) {
            if (isset($_GET['id'])) {
                $controllerObject->$action((int) $_GET['id']);
            } else {
                echo "❌ Error: No se proporcionó ID para la acción <strong>$action</strong>.";
            }
        } else {
            // Acciones normales que no requieren parámetros
            $controllerObject->$action();
        }
    } else {
        // Error: acción no encontrada
        http_response_code(404);
        echo "❌ Error 404: No existe la acción <strong>$action</strong> en el controlador <strong>$controllerName</strong>.";
    }
} else {
    // Error: controlador no encontrado
    http_response_code(404);
    echo "❌ Error 404: No existe el controlador <strong>$controllerName</strong>.";
}
?>
