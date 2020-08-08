<?php

namespace  App\Providers\Components\JsonApiSpec\ExceptionHandler\Exceptions;

use App\Providers\Components\JsonApiSpec\ExceptionHandler\Concerns\Traceable as withTraceable;
use App\Providers\Components\JsonApiSpec\ExceptionHandler\Contracts\Exceptions\HttpThrowable;
use App\Providers\Components\JsonApiSpec\ExceptionHandler\Contracts\Exceptions\Mutable;
use App\Providers\Components\JsonApiSpec\ExceptionHandler\Contracts\Exceptions\Renderable;
use App\Providers\Components\JsonApiSpec\ExceptionHandler\Responses\Resources\Collection as ResourcesCollection;
use App\Providers\Components\JsonApiSpec\ExceptionHandler\Responses\Resources\PointerResource;
use App\Providers\Components\JsonApiSpec\ExceptionHandler\Responses\Resources\Resource;
use Illuminate\Support\Collection;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;
use Throwable;

class ValidationException extends UnprocessableEntityHttpException implements Mutable, Renderable, HttpThrowable
{
    use withTraceable;

    public static function mutate(Throwable $throwable): self
    {
        return new self($throwable->getMessage(), $throwable, $throwable->getCode());
    }

    public function render($request): Response
    {
        return $this->getErrorBag()
            ->map(
                fn (array $messages, string $key): array => array_map(
                    fn (string $message): array => ['key' => $key, 'message' => $message],
                    $messages
                )
            )
            ->flatten(1)
            ->map(fn (array $set): PointerException => new PointerException($set['key'], $set['message']))
            ->mapInto(PointerResource::class)
            ->prepend(new Resource($this))
            ->pipe(
                fn (Collection $collection): Response => (new ResourcesCollection($collection))
                    ->response($request)
                    ->setStatusCode($this->getStatusCode())
                    ->withHeaders($this->getHeaders())
            )
        ;
    }

    /**
     * Get an errors bag as collection from validation exception.
     */
    public function getErrorBag(): Collection
    {
        /** @var \Illuminate\Validation\ValidationException $previous */
        $previous = $this->getPrevious();

        return Collection::wrap($previous->errors());
    }
}
