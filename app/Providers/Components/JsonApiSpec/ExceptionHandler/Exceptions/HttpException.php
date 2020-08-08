<?php

namespace  App\Providers\Components\JsonApiSpec\ExceptionHandler\Exceptions;

use App\Providers\Components\JsonApiSpec\ExceptionHandler\Concerns\Renderable as WithRenderable;
use App\Providers\Components\JsonApiSpec\ExceptionHandler\Concerns\Traceable as WithTraceable;
use App\Providers\Components\JsonApiSpec\ExceptionHandler\Contracts\Exceptions\HttpThrowable;
use App\Providers\Components\JsonApiSpec\ExceptionHandler\Contracts\Exceptions\Mutable;
use App\Providers\Components\JsonApiSpec\ExceptionHandler\Contracts\Exceptions\Renderable;
use Symfony\Component\HttpKernel\Exception\HttpException as SymfonyHttpException;
use Throwable;

class HttpException extends SymfonyHttpException implements Mutable, Renderable, HttpThrowable
{
    use WithTraceable;
    use WithRenderable;

    public static function mutate(Throwable $throwable): self
    {
        /** @var \Symfony\Component\HttpKernel\Exception\HttpException $symfonyThrowable */
        $symfonyThrowable = self::throwableToHttpException($throwable);

        return new self($symfonyThrowable->getStatusCode(), $symfonyThrowable->getMessage(), $symfonyThrowable, $symfonyThrowable->getHeaders(), $symfonyThrowable->getCode());
    }

    /**
     * Conver a Throwable at Symfony Http Exception.
     */
    public static function throwableToHttpException(Throwable $throwable): SymfonyHttpException
    {
        return $throwable instanceof SymfonyHttpException ? $throwable : new SymfonyHttpException(503, $throwable->getMessage(), $throwable);
    }
}
