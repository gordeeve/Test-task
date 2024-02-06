<?php

namespace App\OpenApi\RequestBodies;

use GoldSpecDigital\ObjectOrientedOAS\Objects\RequestBody;
use OpenApi\Attributes\MediaType;
use Vyuldashev\LaravelOpenApi\Factories\RequestBodyFactory;

class StoreTaskRequestBody extends RequestBodyFactory
{
    public function build(): RequestBody
    {
        return RequestBody::create('TaskCreate')
            ->description('User data')
            ;
    }
}
