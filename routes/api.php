<?php

require_once __DIR__ . '/../app/Controllers/NumberController.php';

require_once __DIR__ . '/../routes/api.php';

use App\Controllers\NumberController;
use App\Router\Router;

$router = new Router();

$router->post('/generate', [NumberController::class, 'generateNumber']);
$router->get('/numbers', [NumberController::class, 'getAllNumbers']);
$router->get('/numbers/{id}', [NumberController::class, 'getNumberById']);

$router->dispatch();
