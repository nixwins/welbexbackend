<?php

namespace App\Controller;

use App\Controller\Controller;
use App\Model\TasksModel as Tasks;

class TaskController extends Controller {

    public function getTaskList() {

        $tasksModel = new Tasks();
        $data = ["count" => $tasksModel->getTaskCount(), "tasks" => $tasksModel->getTaskList()];
        header("Access-Control-Allow-Origin: *");
        $this->response->json($data);
    }

    public function getTasksPage() {

        $page = isset($this->params["page"]) ? $this->params["page"] : 1;
        $limit = 4;


        $offset = $limit * ($page - 1);

        $tasksModel = new Tasks();
        $data = ["count" => $tasksModel->getTaskCount(), "tasks" => $tasksModel->getTaskList($limit, $offset)];
        header("Access-Control-Allow-Origin: *");
        $this->response->json($data);
    }

}
