<?php

namespace App\Services\Filter;

use App\Contracts\DTOContract;
use App\Contracts\FilterContract;
use Illuminate\Database\Eloquent\Builder;

abstract class AbstractFilter implements FilterContract
{
    /**
     * @var DTOContract
     */
    private DTOContract $dto;

    /**
     * @var Builder
     */
    protected Builder $builder;

    /**
     * @param DTOContract $dto
     */
    public function __construct(DTOContract $dto)
    {
        $this->dto = $dto;
    }

    /**
     * @param Builder $builder
     * @return void
     */
    public function apply(Builder $builder): void
    {
        $this->builder = $builder;

        foreach ($this->dto as $name => $value){
            if(method_exists($this, $name) && $value !== null){
                call_user_func_array([$this, $name], [$value]);
            }
        }
    }

}
