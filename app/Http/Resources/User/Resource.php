<?php

namespace App\Http\Resources\User;

use App\Model\User;
use DateTimeInterface;
use Illuminate\Http\Resources\Json\JsonResource;

class Resource extends JsonResource
{
    /**
     * The resource instance.
     *
     * @var \App\Model\User
     */
    public $resource;

    public function __construct(User $resource)
    {
        parent::__construct($resource);
    }

    public function toArray($request): array
    {
        return [
            'type' => 'user',
            'id' => $this->resource->getKey(),
            'attributes' => [
                'name' => $this->resource->name,
                'last_name' => $this->resource->last_name,
                'email' => $this->resource->email,
                'username' => $this->resource->username,
                'born_date' => $this->resource->born_date->toDateString(),
                'created_at' => $this->resource->created_at->format(DateTimeInterface::RFC3339_EXTENDED),
                'updated_at' => $this->resource->updated_at->format(DateTimeInterface::RFC3339_EXTENDED),
                'deleted_at' => $this->resource->deleted_at
                    ? $this->resource->deleted_at->format(DateTimeInterface::RFC3339_EXTENDED)
                    : $this->resource->deleted_at,
            ],
            'relationships' => [
                'skill' => [
                    'links' => [
                        'self' => route('api.v1.user.relationships.skill.list', $this->resource),
                    ],
                ],
                'address' => [
                    'links' => [
                        'self' => route('api.v1.user.relationships.address.list', $this->resource),
                    ],
                ],
            ],
            'links' => [
                'self' => route('api.v1.user.read', $this->resource),
            ],
        ];
    }
}
