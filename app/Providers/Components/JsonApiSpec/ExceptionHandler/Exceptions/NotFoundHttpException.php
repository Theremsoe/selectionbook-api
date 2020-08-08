<?php

namespace  App\Providers\Components\JsonApiSpec\ExceptionHandler\Exceptions;

use App\Providers\Components\JsonApiSpec\ExceptionHandler\Concerns\Renderable as WithRenderable;
use App\Providers\Components\JsonApiSpec\ExceptionHandler\Concerns\Traceable as WithTraceable;
use App\Providers\Components\JsonApiSpec\ExceptionHandler\Contracts\Exceptions\HttpThrowable;
use App\Providers\Components\JsonApiSpec\ExceptionHandler\Contracts\Exceptions\Mutable;
use App\Providers\Components\JsonApiSpec\ExceptionHandler\Contracts\Exceptions\Renderable;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException as SymfonyNotFoundHttpException;
use Throwable;

class NotFoundHttpException extends SymfonyNotFoundHttpException implements Mutable, Renderable, HttpThrowable
{
    use WithTraceable;
    use WithRenderable;

    public static function mutate(Throwable $throwable): self
    {
        return new self('Request route was not found in the server', $throwable, $throwable->getCode());
    }
}
