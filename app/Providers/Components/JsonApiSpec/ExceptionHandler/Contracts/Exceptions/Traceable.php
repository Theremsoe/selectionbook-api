<?php

namespace App\Providers\Components\JsonApiSpec\ExceptionHandler\Contracts\Exceptions;

use Throwable;

interface Traceable extends Throwable
{
    /**
     * Return a unique string identifier for trace throwable object.
     */
    public function getIdentifier(): string;

    /**
     * Return a timestamp (datetime string).
     */
    public function getTimestamp(): string;
}
