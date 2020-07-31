<?php

namespace App\Http\Resources\Address;

use App\Model\Address;
use App\Providers\Components\Geo\Support\Facades\GeoJSONWriter;
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
                'created_at' => $this->resource->created_at,
                'updated_at' => $this->resource->updated_at,
                'deleted_at' => $this->resource->deleted_at,
            ],
            'links' => [
                'self' => route('api.v1.address.read', $this->resource),
            ],
        ];
    }
}
