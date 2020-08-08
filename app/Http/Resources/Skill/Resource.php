<?php

namespace App\Http\Resources\Skill;

use App\Model\Skill;
use DateTimeInterface;
use Illuminate\Http\Resources\Json\JsonResource;

class Resource extends JsonResource
{
    /**
     * The resource instance.
     *
     * @var \App\Model\Skill
     */
    public $resource;

    public function __construct(Skill $resource)
    {
        parent::__construct($resource);
    }

    public function toArray($request): array
    {
        return [
            'type' => 'skill',
            'id' => $this->resource->getKey(),
            'attributes' => [
                'name' => $this->resource->name,
                'details' => $this->resource->details,
                'created_at' => $this->resource->created_at->format(DateTimeInterface::RFC3339_EXTENDED),
                'updated_at' => $this->resource->updated_at->format(DateTimeInterface::RFC3339_EXTENDED),
                'deleted_at' => $this->resource->deleted_at
                    ? $this->resource->deleted_at->format(DateTimeInterface::RFC3339_EXTENDED)
                    : $this->resource->deleted_at,
            ],
            'relationships' => [
                'user' => $this->whenLoaded('user', fn (): array => [
                    'links' => [
                        'self' => route('api.v1.user.read', $this->resource->user),
                        'edit' => route('api.v1.user.relationships.skill.read', [$this->resource->user, $this->resource]),
                    ],
                    'data' => [
                        'type' => $this->resource->user->getTable(),
                        'id' => $this->resource->user->getKey(),
                    ],
                ]),
            ],
            'links' => [
                'self' => route('api.v1.skill.read', $this->resource),
            ],
        ];
    }
}
