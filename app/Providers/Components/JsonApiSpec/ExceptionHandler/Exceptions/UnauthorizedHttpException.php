<?php

namespace  App\Providers\Components\JsonApiSpec\ExceptionHandler\Exceptions;

use App\Providers\Components\JsonApiSpec\ExceptionHandler\Concerns\Renderable as WithRenderable;
use App\Providers\Components\JsonApiSpec\ExceptionHandler\Concerns\Traceable as WithTraceable;
use App\Providers\Components\JsonApiSpec\ExceptionHandler\Contracts\Exceptions\HttpThrowable;
use App\Providers\Components\JsonApiSpec\ExceptionHandler\Contracts\Exceptions\Mutable;
use App\Providers\Components\JsonApiSpec\ExceptionHandler\Contracts\Exceptions\Renderable;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException as ExceptionUnauthorizedHttpException;
use Throwable;

class UnauthorizedHttpException extends ExceptionUnauthorizedHttpException implements Mutable, Renderable, HttpThrowable
{
    use WithTraceable;
    use WithRenderable;

    public static function mutate(Throwable $throwable): self
    {
        return new self('Bearer', 'A bearer token is required in request', $throwable, $throwable->getCode());
    }
}
