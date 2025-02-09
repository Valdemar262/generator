<?php

namespace App\Router;

class Router
{
    private array $routes = [];

    public function get(string $route, array $handler): void
    {
        $this->addRoute('GET', $route, $handler);
    }

    private function addRoute(string $method, string $route, array $handler): void
    {
        $this->routes[] = [
            'method' => $method,
            'route' => $this->convertRouteToRegex($route),
            'handler' => $handler,
            'originalRoute' => $route
        ];
    }

    private function convertRouteToRegex(string $route): string
    {
        return '#^' . preg_replace('/\{([a-zA-Z0-9_]+)\}/', '([a-zA-Z0-9_]+)', $route) . '$#';
    }

    public function post(string $route, array $handler): void
    {
        $this->addRoute('POST', $route, $handler);
    }

    public function dispatch(): void
    {
        $path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $method = $_SERVER['REQUEST_METHOD'];

        foreach ($this->routes as $route) {
            if ($method === $route['method'] && preg_match($route['route'], $path, $matches)) {
                [$controller, $method] = $route['handler'];
                $controllerInstance = new $controller();
                array_shift($matches); // Убираем первый элемент, так как это полное совпадение

                echo json_encode($controllerInstance->$method(...$matches));
                return;
            }
        }

        http_response_code(404);
        echo json_encode(['error' => 'Route not found']);
    }
}
