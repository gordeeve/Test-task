<?php

namespace App\DTO;

use App\Contracts\DTOContract;

class FilterDTO implements DTOContract
{
    public ?string $title;
    public ?string $description;
    public ?string $status;
    public ?int $priority;
    public ?string $sortBy;
    public ?string $andSortBy;
    public ?string $id;


    public function __construct(
        string $id = null,
        string $title = null,
        string $description = null,
        string $status = null,
        int $priority = null,
        string $sortBy = null,
        string $andSortBy = null
    )
    {
        $this->id = $id;
        $this->title = $title;
        $this->description = $description;
        $this->status = $status;
        $this->priority = $priority;
        $this->sortBy = $sortBy;
        $this->andSortBy = $andSortBy;
    }
}
