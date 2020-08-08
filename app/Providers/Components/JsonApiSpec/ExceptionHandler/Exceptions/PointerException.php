<?php

namespace  App\Providers\Components\JsonApiSpec\ExceptionHandler\Exceptions;

use App\Providers\Components\JsonApiSpec\ExceptionHandler\Concerns\Traceable;
use App\Providers\Components\JsonApiSpec\ExceptionHandler\Contracts\Exceptions\Unprocessable;
use Illuminate\Support\Str;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;

class PointerException extends UnprocessableEntityHttpException implements Unprocessable
{
    use Traceable;

    protected string $key;

    public function __construct(string $key, string $message)
    {
        $this->key = $key;

        parent::__construct($message);
    }

    final public function getSource(): array
    {
        return ['pointer' => (string) Str::of($this->key)->replace('.', '/')->prepend('/')];
    }
}
