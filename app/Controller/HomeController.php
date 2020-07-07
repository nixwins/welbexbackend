<?php

namespace App\Controller;

use App\Controller\Controller;

class HomeController extends Controller {

    public function index() {
        $this->response->body("Welcome to welbex api");
    }

}
