<?php

namespace App\Providers\Components\JsonApiSpec\ExceptionHandler\Contracts\Exceptions;

use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;

interface HttpThrowable extends HttpExceptionInterface, Traceable
{
}
