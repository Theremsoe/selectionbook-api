<?php

namespace App\Providers\Components\JsonApiSpec\ExceptionHandler;

use App\Providers\Components\JsonApiSpec\ExceptionHandler\Contracts\Exceptions\Mutable;
use App\Providers\Components\JsonApiSpec\ExceptionHandler\Contracts\Exceptions\Renderable;
use App\Providers\Components\JsonApiSpec\ExceptionHandler\Exceptions\HttpException;
use App\Providers\Components\JsonApiSpec\ExceptionHandler\Exceptions\NotFoundHttpException;
use App\Providers\Components\JsonApiSpec\ExceptionHandler\Exceptions\OAuthServerException;
use App\Providers\Components\JsonApiSpec\ExceptionHandler\Exceptions\QueryException;
use App\Providers\Components\JsonApiSpec\ExceptionHandler\Exceptions\ServiceUnavailableHttpException;
use App\Providers\Components\JsonApiSpec\ExceptionHandler\Exceptions\UnauthorizedHttpException;
use App\Providers\Components\JsonApiSpec\ExceptionHandler\Exceptions\ValidationException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\QueryException as DatabaseQueryException;
use Illuminate\Support\Collection;
use Illuminate\Validation\ValidationException as IlluminateValidationException;
use League\OAuth2\Server\Exception\OAuthServerException as LeagueOAuthServerException;
use RuntimeException;
use Symfony\Component\HttpKernel\Exception\HttpException as SymfonyHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException as SymfonyNotFoundHttpException;
use Throwable;

class Handler
{
    protected string $default = ServiceUnavailableHttpException::class;

    protected array $mutators = [
        AuthenticationException::class => UnauthorizedHttpException::class,
        LeagueOAuthServerException::class => OAuthServerException::class,
        DatabaseQueryException::class => QueryException::class,
        SymfonyNotFoundHttpException::class => NotFoundHttpException::class,
        SymfonyHttpException::class => HttpException::class,
        IlluminateValidationException::class => ValidationException::class,
    ];

    public function getDefaultMutator(): string
    {
        return $this->default;
    }

    /**
     * Return the class name (mutator) that match with throwable.
     */
    public function getMutatorFor(Throwable $throwable): ?string
    {
        return Collection::wrap($this->mutators)
            ->first(fn (string $mutator, string $classToMutate): bool => $throwable instanceof $classToMutate)
        ;
    }

    /**
     * Resolve mutator. If not found, return default mutator.
     */
    public function resolveMutator(Throwable $throwable): string
    {
        return $this->getMutatorFor($throwable) ?? $this->getDefaultMutator();
    }

    /**
     * Mutate a throwable to renderable interface.
     *
     * @throws \RuntimeException
     */
    public function mutate(Throwable $throwable): Renderable
    {
        /** @var string $mutator */
        $mutator = $this->resolveMutator($throwable);

        /** @var string[] $contracts */
        $contracts = class_implements($mutator);

        throw_if(
            ! \in_array(Mutable::class, $contracts),
            new RuntimeException("<<{$mutator}>> class must implements of <<".Mutable::class.'>> interface')
        );

        return forward_static_call([$mutator, 'mutate'], $throwable);
    }
}
