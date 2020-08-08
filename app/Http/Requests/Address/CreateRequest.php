<?php

namespace App\Http\Requests\Address;

use App\Providers\Components\JsonApiSpec\Http\Requests\ResourceFormRequest;

class CreateRequest extends ResourceFormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'street' => 'required',
            'city' => 'required',
            'state' => 'required',
            'zipcode' => 'required',
            'country' => 'required',
            'geometry' => 'required|array',
            'geometry.type' => 'required|in:Point',
            'geometry.coordinates' => 'required|array|size:2',
            'geometry.coordinates.*' => 'required|numeric',
        ];
    }
}
