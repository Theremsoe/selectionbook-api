<?php

namespace App\Providers\Components\JsonApiSpec\ExceptionHandler\Concerns;

use DateTimeInterface;
use Illuminate\Support\Str;

trait Traceable
{
    /**
     * throwable identifier.
     */
    protected string $identifier;

    /**
     * throwable timestamp.
     */
    protected string $timestamp;

    public function getIdentifier(): string
    {
        return $this->identifier ??= Str::uuid();
    }

    public function getTimestamp(): string
    {
        return $this->timestamp ??= now()->format(DateTimeInterface::RFC3339_EXTENDED);
    }
}
