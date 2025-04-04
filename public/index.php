<?php
// Cargar constantes y rutas
session_start();
require_once __DIR__ . '/../config/constants.php';
require_once __DIR__ . '/../config/routes.php';

// Función sencilla para cargar controladores
function loadController($controllerName, $action = 'index') {
    $controllerFile = APP_PATH . "/controllers/{$controllerName}.php";

    if (file_exists($controllerFile)) {
        require_once $controllerFile;
        if (class_exists($controllerName)) {
            $controller = new $controllerName();

            if (method_exists($controller, $action)) {
                $controller->$action();
                return;
            }
        }
    }

    // Si el controlador o acción no existe, mostrar 404
    require_once VIEW_PATH . '/errors/404.php';
}

// Obtener ruta solicitada
$requestUri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$basePath = dirname($_SERVER['SCRIPT_NAME']); // /client/public
$route = str_replace($basePath, '', $requestUri);
$route = trim($route, '/');

// Redireccionar a login si no hay ruta
if ($route === '') {
    header("Location: login");
    exit;
}

// Ejecutar acción correspondiente
if (isset($routes[$route])) {
    $controllerInfo = explode('@', $routes[$route]);
    $controllerName = $controllerInfo[0];
    $actionName = $controllerInfo[1] ?? 'index';
    loadController($controllerName, $actionName);
} else {
    require_once VIEW_PATH . '/errors/404.php';
}
