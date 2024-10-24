<?php

require_once 'helpers/log.php';
require_once 'helpers/env.php';
require_once 'helpers/sessions.php';
require_once 'helpers/connection.php';

require_once 'models/UserModel.php';

require_once 'controllers/TemplateController.php';
require_once 'controllers/AuthController.php';
require_once 'controllers/DashboardController.php';
require_once 'controllers/UserController.php';

global $env;
$env = new Environment('.env');
$URI = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$METHOD = $_SERVER['REQUEST_METHOD'];

function resolveRoute(string $uri, string $method, array $routes) {
    if (isset($routes[$method])) {
        foreach ($routes[$method] as $route => $handler) {
            if ($uri === $route) {
                call_user_func($handler);
                return true;
            }
        }
    }
    return false;
}

if (isset($_SESSION['user_id'])) {
    $routes = [
        'GET' => [
            '/'          => [DashboardController::class, 'render'],
            '/dashboard' => [DashboardController::class, 'render'],

            '/logout'    => [AuthController::class, 'logout'],
        ],
        'POST' => [
        ]
    ]; 

    if (!resolveRoute($URI, $METHOD, $routes)) {
        http_response_code(404);
    }
} else {
    $routes = [
        'GET' => [
            '/'      => [AuthController::class, 'renderLoging']
        ],
        'POST' => [
            '/login' => [AuthController::class, 'login']
        ],
    ];

    if (!resolveRoute($URI, $METHOD, $routes)) {
        http_response_code(404);
    }
}