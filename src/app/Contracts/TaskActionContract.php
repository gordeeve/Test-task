<?php

namespace App\Contracts;

interface TaskActionContract
{
    public function run(DTOContract $dto);
}
