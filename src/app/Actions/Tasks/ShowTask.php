<?php

namespace App\Actions\Tasks;

use App\Contracts\DTOContract;
use App\Contracts\TaskActionContract;
use App\Contracts\TaskRepositoryContract;
use App\Models\Task;

class ShowTask extends BaseTaskAction implements TaskActionContract
{
    /**
     * @param DTOContract $dto
     * @param TaskRepositoryContract|null $taskRepository
     * @return mixed
     */
    public function run(DTOContract $dto): Task
    {
        return $this->taskRepository->getTaskById($dto->id);
    }
}
