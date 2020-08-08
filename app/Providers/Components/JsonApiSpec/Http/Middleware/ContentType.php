<?php

namespace App\Providers\Components\JsonApiSpec\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ContentType
{
    /**
     * Handle an incoming request for seet the content type header in response.
     */
    public function handle(Request $request, Closure $next): Response
    {
        /** @var \Illuminate\Http\Response|\Symfony\Component\HttpFoundation\Response $response */
        $response = $next($request);

        $response->header('Content-Type', 'application/vnd.api+json');

        return $response;
    }
}
