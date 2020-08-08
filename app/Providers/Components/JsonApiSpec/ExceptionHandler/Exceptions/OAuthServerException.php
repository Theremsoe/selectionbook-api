<?php

namespace  App\Providers\Components\JsonApiSpec\ExceptionHandler\Exceptions;

use App\Providers\Components\JsonApiSpec\ExceptionHandler\Concerns\Renderable as WithRenderable;
use App\Providers\Components\JsonApiSpec\ExceptionHandler\Concerns\Traceable as WithTraceable;
use App\Providers\Components\JsonApiSpec\ExceptionHandler\Contracts\Exceptions\HttpThrowable;
use App\Providers\Components\JsonApiSpec\ExceptionHandler\Contracts\Exceptions\Mutable;
use App\Providers\Components\JsonApiSpec\ExceptionHandler\Contracts\Exceptions\Renderable;
use League\OAuth2\Server\Exception\OAuthServerException as LeagueOAuthServerException;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Throwable;

class OAuthServerException extends BadRequestHttpException implements Mutable, Renderable, HttpThrowable
{
    use WithTraceable;
    use WithRenderable;

    public static function mutate(Throwable $throwable): self
    {
        $throwable = self::throwableToOAuthServerException($throwable);

        return new self($throwable->getMessage(), $throwable, $throwable->getCode(), $throwable->getHttpHeaders());
    }

    /**
     * Conver a Throwable at Symfony Http Exception.
     */
    public static function throwableToOAuthServerException(Throwable $throwable): LeagueOAuthServerException
    {
        return $throwable instanceof LeagueOAuthServerException ? $throwable : new LeagueOAuthServerException('OAuth bad request', 0, 'unknow');
    }
}
