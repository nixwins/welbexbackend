<?php

namespace App\Model;

use \RedBeanPHP\R as R;
use App\Model\Model;

class TasksModel extends Model {

    public function getTaskList($limit = 4, $offset = 0, $order = "id") {

        $products = R::getAll('SELECT * FROM ' . $this->tableName . ' ORDER BY  ? DESC LIMIT ? OFFSET ?', [$order, $limit, $offset]);
        return $products;
    }

    public function getTaskCount() {
        return R::count($this->tableName);
    }

}
