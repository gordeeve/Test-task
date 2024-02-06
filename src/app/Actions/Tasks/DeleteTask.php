<?php

namespace App\Actions\Tasks;

use App\Contracts\DTOContract;
use App\Contracts\TaskActionContract;
use App\Contracts\TaskRepositoryContract;

class DeleteTask extends BaseTaskAction implements  TaskActionContract
{
    public function run(DTOContract $dto)
    {
        return $this->taskRepository->deleteTask($dto->id);
    }
}
