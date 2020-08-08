<?php

namespace App\Providers\Components\JsonApiSpec\ExceptionHandler\Contracts\Exceptions;

interface Unprocessable extends HttpThrowable
{
    /**
     * Define a array that indicate the reference pointer that
     * contains the error.
     */
    public function getSource(): array;
}
