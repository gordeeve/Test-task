<?php

namespace App\OpenApi\Parameters;

use GoldSpecDigital\ObjectOrientedOAS\Objects\Parameter;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Schema;
use Vyuldashev\LaravelOpenApi\Factories\ParametersFactory;

class TaskListParameters extends ParametersFactory
{
    /**
     * @return Parameter[]
     */
    public function build(): array
    {
        return [

            Parameter::query()
                ->name('task_id')
                ->description('string, required task id')
                ->required(false)
                ->schema(Schema::string()),

            Parameter::query()
                ->name('task name')
                ->in('json')
                ->description('string, required task id')
                ->required(false)
                ->schema(Schema::string()),

        ];
    }
}
