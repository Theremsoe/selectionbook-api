<?php

namespace App\Providers\Components\JsonApiSpec\ExceptionHandler\Responses\Resources;

use App\Providers\Components\JsonApiSpec\ExceptionHandler\Contracts\Exceptions\Unprocessable;

class PointerResource extends Resource
{
    /**
     * The resource instance.
     *
     * @var \App\Components\JsonApiSpec\Contracts\Exceptions\Unprocessable
     */
    public $resource;

    public function __construct(Unprocessable $resource)
    {
        parent::__construct($resource);
    }

    public function toArray($request): array
    {
        return [
            'title' => 'Invalid given attribute',
            'source' => $this->resource->getSource(),
            $this->merge(parent::toArray($request)),
        ];
    }
}
