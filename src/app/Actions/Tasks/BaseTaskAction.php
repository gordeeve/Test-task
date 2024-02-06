<?php

namespace App\Actions\Tasks;

use App\Repositories\TaskRepository;

class BaseTaskAction
{
    protected $taskRepository;

    public function __construct()
    {
        if(!$this->taskRepository){
            $this->taskRepository = new TaskRepository();
        }
    }
}
