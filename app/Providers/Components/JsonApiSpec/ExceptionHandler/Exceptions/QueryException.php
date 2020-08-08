<?php

namespace  App\Providers\Components\JsonApiSpec\ExceptionHandler\Exceptions;

use App\Providers\Components\JsonApiSpec\ExceptionHandler\Concerns\Renderable as WithRenderable;
use App\Providers\Components\JsonApiSpec\ExceptionHandler\Concerns\Traceable as WithTraceable;
use App\Providers\Components\JsonApiSpec\ExceptionHandler\Contracts\Exceptions\HttpThrowable;
use App\Providers\Components\JsonApiSpec\ExceptionHandler\Contracts\Exceptions\Mutable;
use App\Providers\Components\JsonApiSpec\ExceptionHandler\Contracts\Exceptions\Renderable;
use Throwable;

class QueryException extends ServiceUnavailableHttpException implements Mutable, Renderable, HttpThrowable
{
    use WithTraceable;
    use WithRenderable;

    public static function mutate(Throwable $throwable): self
    {
        return new self(60, 'A database error was occurs', $throwable, $throwable->getCode());
    }
}
