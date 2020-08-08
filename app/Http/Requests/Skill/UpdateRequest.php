<?php

namespace App\Http\Requests\Skill;

use App\Providers\Components\JsonApiSpec\Http\Requests\ResourceFormRequest;

class UpdateRequest extends ResourceFormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'name' => 'sometimes|required',
            'details' => 'nullable',
        ];
    }
}
