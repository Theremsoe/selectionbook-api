<?php

namespace App\Http\Resources\Address;

use App\Model\Address;
use App\Providers\Components\Geo\Support\Facades\GeoJSONWriter;
use DateTimeInterface;
use Illuminate\Http\Resources\Json\JsonResource;

class Resource extends JsonResource
{
    /**
     * The resource instance.
     *
     * @var \App\Model\Address
     */
    public $resource;

    public function __construct(Address $resource)
    {
        parent::__construct($resource);
    }

    public function toArray($request): array
    {
        return [
            'type' => 'address',
            'id' => $this->resource->getKey(),
            'attributes' => [
                'street' => $this->resource->street,
                'city' => $this->resource->city,
                'state' => $this->resource->state,
                'zipcode' => $this->resource->zipcode,
                'country' => $this->resource->country,
                'geometry' => GeoJSONWriter::writeToArray($this->resource->geometry),
                'created_at' => $this->resource->created_at->format(DateTimeInterface::RFC3339_EXTENDED),
                'updated_at' => $this->resource->updated_at->format(DateTimeInterface::RFC3339_EXTENDED),
                'deleted_at' => $this->resource->deleted_at
                    ? $this->resource->deleted_at->format(DateTimeInterface::RFC3339_EXTENDED)
                    : $this->resource->deleted_at,
            ],
            'relationships' => [
                'addressable' => $this->whenLoaded('addressable', fn (): array => [
                    'links' => [
                        'self' => route('api.v1.user.read', $this->resource->addressable),
                        'edit' => route('api.v1.user.relationships.address.read', [$this->resource->addressable, $this->resource]),
                    ],
                    'data' => [
                        'type' => $this->resource->addressable->getTable(),
                        'id' => $this->resource->addressable->getKey(),
                    ],
                ]),
            ],
            'links' => [
                'self' => route('api.v1.address.read', $this->resource),
            ],
        ];
    }
}
