<?php

namespace App\Actions\Tasks;

use App\Contracts\DTOContract;
use App\Contracts\TaskActionContract;
use App\Contracts\TaskRepositoryContract;
use App\Models\Task;
use App\Services\Filter\TaskFilter;

class GetFinishedTasks implements TaskActionContract
{
    public function run(DTOContract $dto)
    {
        return Task::filter(new TaskFilter($dto));
    }
}
