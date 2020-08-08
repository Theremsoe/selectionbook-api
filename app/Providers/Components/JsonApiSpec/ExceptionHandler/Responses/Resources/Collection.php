<?php

namespace App\Providers\Components\JsonApiSpec\ExceptionHandler\Responses\Resources;

use App\Providers\Components\JsonApiSpec\ExceptionHandler\Contracts\Exceptions\HttpThrowable;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Support\Collection as SupportCollection;

class Collection extends ResourceCollection
{
    /**
     * The resource that this resource collects.
     *
     * @var string
     */
    public $collects = Resource::class;

    /**
     * The "data" wrapper that should be applied.
     *
     * @var string
     */
    public static $wrap = 'errors';

    /**
     * Create a resource collection from resource(s).
     */
    public static function fromHttpThrowable(HttpThrowable $throwable): self
    {
        return new self(SupportCollection::wrap($throwable));
    }
}
