<?php

namespace Core;

use App\Config\App;

class Router {

    public function __construct() {
        $this->klein = new \Klein\Klein();
    }
    
    public function routeMap($method, $uri, $controllerAction) 
    {

        $this->klein->respond($method, $uri, function($req, $resp, $service, $app) use($controllerAction, $method) {

            $strController = App::PATH_CONTROLLER . $controllerAction["controller"];
            $action = $controllerAction["action"];

            $this->initController($method, $strController, $action, $req, $resp, $service, $app);
        });
    }
    
    private function initController($method, $controllerName, $action, $req, $resp, $service, $app)
    {
        $controller = new $controllerName();
         
        switch ($method) 
        {
            case 'GET':
                 $controller->init($req, $resp, $service, $app, $req->paramsNamed());
                break;
            
            case 'POST':
                 $controller->init($req, $resp, $service, $app, $req->paramsPost());
                break;
            default:
                break;
        }
    
          $controller->$action();
    }

    public function dispatch() {
        $this->klein->dispatch();
    }


}
