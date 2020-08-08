<?php

namespace App\Providers\Components\JsonApiSpec\ExceptionHandler\Contracts\Exceptions;

use Symfony\Component\HttpFoundation\Response;
use Throwable;

interface Renderable extends Throwable
{
    /**
     * Render an exception into an HTTP response.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @throws \Throwable
     */
    public function render($request): Response;
}
