<?php

namespace App\Contracts;
use App\Contracts\DTOContract;
use App\Models\Task;

interface TaskRepositoryContract
{
    public function getAllTasks();
    public function getTaskById(int $TaskId);
    public function deleteTask(int $TaskId);
    public function createTask(DTOContract $TaskDetailsDTO);
    public function updateTask(Task $task, DTOContract $newDetails);
    public function setTaskFinished(int $id);
    public function getFulfilledTasks();
}
