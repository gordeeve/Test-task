<?php

namespace App\DTO;

use App\Contracts\DTOContract;

class SortingDTO implements DTOContract
{
    public function __construct(
        string $title = null,
        string $description = null,
        string $status = null,
        int $priority = null,
    ){

    }
}
