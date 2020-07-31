<?php

namespace App\Http\Controllers\Api\v1\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\CreateRequest;
use App\Http\Resources\User\Resource;
use App\Model\User;

class CreateController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(CreateRequest $request): Resource
    {
        return new Resource(
            User::create(
                $request->validated()
            )
        );
    }
}
