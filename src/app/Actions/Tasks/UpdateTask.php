<?php

namespace App\Actions\Tasks;

use App\Contracts\DTOContract;
use App\Contracts\TaskActionContract;
use App\Contracts\TaskRepositoryContract;
use App\Models\Task;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class UpdateTask extends BaseTaskAction implements TaskActionContract
{
    public function run(DTOContract $dto)
    {
        $task = $this->taskRepository->getTaskById($dto->id);

        if($task->user_id !== $dto->getUserId()){
            abort(Response::HTTP_METHOD_NOT_ALLOWED);
        }

        return $this->taskRepository->updateTask($task, $dto);
    }
}
