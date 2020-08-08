<?php

namespace App\Providers\Components\JsonApiSpec\ExceptionHandler\Responses\Resources;

use App\Providers\Components\JsonApiSpec\ExceptionHandler\Contracts\Exceptions\HttpThrowable;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Arr;
use Symfony\Component\HttpFoundation\Response;

class Resource extends JsonResource
{
    /**
     * The resource instance.
     *
     * @var \App\Components\JsonApiSpec\Contracts\Exceptions\HttpThrowable
     */
    public $resource;

    public function __construct(HttpThrowable $resource)
    {
        parent::__construct($resource);
    }

    public function toArray($request): array
    {
        return [
            'id' => $this->resource->getIdentifier(),
            'status' => $this->resource->getStatusCode(),
            'code' => $this->resource->getCode(),
            'title' => $this->getStatusText(),
            'detail' => $this->resource->getMessage(),
            'meta' => [
                'timestamp' => $this->resource->getTimestamp(),
            ],
        ];
    }

    public function getStatusText(): string
    {
        return Arr::get(Response::$statusTexts, $this->resource->getStatusCode(), 'Service Unavailable');
    }
}
