<?php

namespace App\Config;

use App\Model\AppModel;
use \RedBeanPHP\R as R;

class App {

    public const dbDriver = "mysql";
    public const host = "localhost";
    public const dbname = "p-314956_task";
    public const userName = "p-314956_test";
    public const pass = "p@$$123";
    public const PATH_CONTROLLER = '\\App\\Controller\\';
    public const PATH_VIEWS = 'app/views';

    public static $SERVER_URL;

    public static function initDB() {

        R::setup('mysql:host=' . App::host . ';dbname=' . App::dbname, App::userName, App::pass);
    }

}
