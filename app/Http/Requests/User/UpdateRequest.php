<?php

namespace App\Http\Requests\User;

use App\Model\User;
use App\Providers\Components\JsonApiSpec\Http\Requests\ResourceFormRequest;

class UpdateRequest extends ResourceFormRequest
{
    /**
     * User resolved by route binding.
     */
    public User $user;

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        /** @var string $repository */
        $repository = User::class;

        return [
            'name' => 'sometimes|required',
            'last_name' => 'nullable',
            'username' => "sometimes|required|unique:{$repository},username,{$this->user->getKey()}",
            'email' => "sometimes|required|email|unique:{$repository},email,{$this->user->getKey()}",
        ];
    }
}
