<?php

namespace App\Http\Controllers\Api\v1\User\Relationships\Address;

use App\Http\Controllers\Controller;
use App\Http\Requests\Address\CreateRequest;
use App\Http\Resources\Address\Resource;
use App\Model\User;

class CreateController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(CreateRequest $request, User $user): Resource
    {
        return new Resource(
            $user->addresses()->create($request->validated())
        );
    }
}
