<?php
declare(strict_types=1);

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL & ~E_DEPRECATED);

// public/index.php - Punto de entrada

session_start();

// Autoload simple
spl_autoload_register(function ($class) {
    $paths = [__DIR__ . '/../app/models/' . $class . '.php', __DIR__ . '/../app/controllers/' . $class . '.php'];
    foreach ($paths as $p) {
        if (file_exists($p)) {
            require_once $p;
            return;
        }
    }
});

require_once __DIR__ . '/../config/database.php'; // crea $pdo

// Ruteo básico por GET params
$controller = $_GET['controller'] ?? 'auth';
$action = $_GET['action'] ?? 'login';

$controller = preg_replace('/[^a-z0-9_]/i','', $controller);
$action = preg_replace('/[^a-z0-9_]/i','', $action);

$controllerClass = ucfirst($controller) . 'Controller';
$controllerFile = __DIR__ . '/../app/controllers/' . $controllerClass . '.php';

if (file_exists($controllerFile)) {
    require_once $controllerFile;
    $ctrl = new $controllerClass($pdo);
    if (method_exists($ctrl, $action)) {
        $ctrl->{$action}();
    } else {
        http_response_code(404);
        echo "Accion no encontrada";
    }
} else {
    http_response_code(404);
    echo "Controlador no encontrado";
}


