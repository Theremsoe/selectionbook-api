<?php

namespace App\Http\Requests\User;

use App\Model\User;
use App\Providers\Components\JsonApiSpec\Http\Requests\ResourceFormRequest;

/**
 * @property \App\Model\User $user
 */
class UpdateRequest extends ResourceFormRequest
{
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
