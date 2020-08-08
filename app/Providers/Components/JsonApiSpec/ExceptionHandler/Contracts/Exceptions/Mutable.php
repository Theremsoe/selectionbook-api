<?php

namespace App\Providers\Components\JsonApiSpec\ExceptionHandler\Contracts\Exceptions;

use Throwable;

interface Mutable extends Throwable
{
    /**
     * Give a throwable and convert to another.
     */
    public static function mutate(Throwable $throwable): self;
}
