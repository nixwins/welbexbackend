<?php

use Core\Router;
use App\Config\App;

App::initDB();

$router = new Router();

$router->routeMap('GET', '/', ["controller" => "HomeController", "action" => "index"]);

$router->routeMap('GET', '/tasks', ["controller" => "TaskController", "action" => "getTaskList"]);
$router->routeMap('GET', '/tasks/[:page]', ["controller" => "TaskController", "action" => "getTasksPage"]);


$router->dispatch();

