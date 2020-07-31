<?php

namespace App\Http\Resources\Skill;

use App\Model\Skill;
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
                'created_at' => $this->resource->created_at,
                'updated_at' => $this->resource->updated_at,
                'deleted_at' => $this->resource->deleted_at,
            ],
            'links' => [
                'self' => route('api.v1.skill.read', $this->resource),
            ],
        ];
    }
}
