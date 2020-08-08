<?php

namespace App\Http\Requests\Address;

use App\Providers\Components\JsonApiSpec\Http\Requests\ResourceFormRequest;

class UpdateRequest extends ResourceFormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'street' => 'sometimes|required',
            'city' => 'sometimes|required',
            'state' => 'sometimes|required',
            'zipcode' => 'sometimes|required',
            'country' => 'sometimes|required',
            'geometry' => 'sometimes|required|array',
            'geometry.type' => 'required_if:geometry|in:Point',
            'geometry.coordinates' => 'required_if:geometry|array|size:2',
            'geometry.coordinates.*' => 'required_if:geometry|numeric',
        ];
    }
}
