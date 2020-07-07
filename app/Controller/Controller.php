<?php

namespace App\Controller;

use App\Config\App;

class Controller {

    protected $request;
    protected $response;
    protected $service;
    protected $app;
    protected $params;

    public function init($req, $res, $service, $app, $params) {

        $this->request = $req;
        $this->response = $res;
        $this->service = $service;
        $this->app = $app;
        $this->params = $params;
    }

}
