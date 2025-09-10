<?php
declare(strict_types=1);

error_reporting(E_ALL);
ini_set('display_errors', '1');
session_start();

// Autocarga simple para src/*
spl_autoload_register(function ($class) {
    $baseDir = __DIR__ . '/src/';
    $class = str_replace('\\', '/', $class); // fix de escape
    $paths = [
        $baseDir . 'control/' . $class . '.php',
        $baseDir . 'model/' . $class . '.php',
        $baseDir . 'library/' . $class . '.php',
        $baseDir . $class . '.php'
    ];
    foreach ($paths as $p) {
        if (file_exists($p)) { require_once $p; return; }
    }
});

require_once __DIR__ . '/src/config/config.php';
require_once __DIR__ . '/src/library/Conexion.php';
require_once __DIR__ . '/src/library/Csrf.php';
require_once __DIR__ . '/src/library/Controller.php';

// Router muy básico ?c=controlador&a=accion
$c = strtolower($_GET['c'] ?? 'home');
$a = strtolower($_GET['a'] ?? 'index');
$controllerClass = ucfirst($c) . 'Controller';
$action = $a . 'Action';

try {
    if (!class_exists($controllerClass)) {
        throw new Exception("Controlador '$controllerClass' no encontrado");
    }
    $controller = new $controllerClass();
    if (!method_exists($controller, $action)) {
        throw new Exception("Acción '$action' no encontrada en $controllerClass");
    }
    $controller->$action();
} catch (Throwable $e) {
    http_response_code(500);
    $message = (defined('APP_DEBUG') && APP_DEBUG) ? $e->getMessage() : 'Ocurrió un error interno.';
    include __DIR__ . '/src/view/errors/500.php';
}
