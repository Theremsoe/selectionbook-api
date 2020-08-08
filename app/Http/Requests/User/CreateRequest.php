<?php

namespace App\Http\Requests\User;

use App\Model\User;
use App\Providers\Components\JsonApiSpec\Http\Requests\ResourceFormRequest;

class CreateRequest extends ResourceFormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        /** @var string $repository */
        $repository = User::class;

        return [
            'name' => 'required',
            'last_name' => 'nullable',
            'email' => "required|email|unique:{$repository},email",
            'username' => "required|unique:{$repository},username",
            'password' => 'required',
        ];
    }
}
