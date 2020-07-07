<?php

namespace App\Model;

use App\Config\App;
use \RedBeanPHP\R as R;

abstract class Model {

    protected $tableName;
    protected $bean;
    private $toolbox;

    public function __construct() {

        $this->setTableNameFromClassName();
    }

    public function connectTest() {
        $books = R::getAll(
                        'SELECT * FROM roles');
    }

    private function setTableNameFromClassName() {

        $arr = \explode("\\", \get_class($this));
        $clasName = $arr[count($arr) - 1];
        $tableName = \str_replace("Model", "", $clasName);
        $this->tableName = lcfirst($tableName);
    }

}
