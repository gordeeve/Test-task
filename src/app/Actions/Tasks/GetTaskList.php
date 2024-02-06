<?php

namespace App\Actions\Tasks;

use App\Contracts\DTOContract;
use App\Contracts\TaskActionContract;
use App\Models\Task;
use App\Services\Filter\TaskFilter;


class GetTaskList extends BaseTaskAction implements TaskActionContract
{
    public function run(DTOContract $dto)
    {
        return Task::filter(new TaskFilter($dto));
    }
}
