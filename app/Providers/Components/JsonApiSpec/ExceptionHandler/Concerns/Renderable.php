<?php

namespace App\Providers\Components\JsonApiSpec\ExceptionHandler\Concerns;

use App\Providers\Components\JsonApiSpec\ExceptionHandler\Responses\Resources\Collection;
use Symfony\Component\HttpFoundation\Response;

trait Renderable
{
    public function render($request): Response
    {
        return Collection::fromHttpThrowable($this)
            ->response($request)
            ->setStatusCode($this->getStatusCode())
            ->withHeaders($this->getHeaders())
        ;
    }
}
