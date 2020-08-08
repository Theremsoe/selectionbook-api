<?php

namespace App\Exceptions;

use App\Providers\Components\JsonApiSpec\ExceptionHandler\Handler as JsonApiSpecHandler;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * @throws \Exception
     */
    public function report(Throwable $exception): void
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @throws \Throwable
     */
    public function render($request, Throwable $exception): Response
    {
        if ($request->is('api/*')) {
            $exception = (new JsonApiSpecHandler())->mutate(
                $this->prepareException($exception)
            );
        }

        return parent::render($request, $exception);
    }
}
