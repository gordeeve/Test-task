<?php

namespace App\Repositories;

use App\Contracts\DTOContract;
use App\Contracts\TaskRepositoryContract;
use App\Enums\Messages;
use App\Enums\TaskStatus;
use App\Models\Task;

class TaskRepository implements TaskRepositoryContract
{

    public function getAllTasks()
    {
        return Task::all();
    }

    public function getTaskById(int $TaskId)
    {
        return Task::findOrFail($TaskId);
    }

    public function deleteTask(int $TaskId)
    {
        $task = $this->getTaskById($TaskId);
        if($task->status === TaskStatus::TODO->value){
            return Task::destroy($TaskId);
        }

        return null;
    }

    public function createTask(DTOContract $TaskDetailsDTO)
    {
        return Task::create($TaskDetailsDTO->toArray());
    }

    public function updateTask(Task $task, DTOContract $newDetails)
    {
        $task->update($newDetails->toArray());
        return $task;
    }

    public function getFulfilledTasks()
    {
        return Task::whereStatus(TaskStatus::DONE->value)->get();
    }

    public function setTaskFinished($task_id)
    {
        $task = $this->getTaskById($task_id);
        $task->status = TaskStatus::DONE->value;
        $task->save();

        return $task;
    }
}
