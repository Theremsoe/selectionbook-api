<?php

namespace App\Http\Controllers\Api\v1\User\Relationships\Skill;

use App\Http\Controllers\Controller;
use App\Http\Requests\Skill\CreateRequest;
use App\Http\Resources\Skill\Resource;
use App\Model\User;

class CreateController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(CreateRequest $request, User $user): Resource
    {
        return new Resource(
            $user->skills()->create($request->validated())
        );
    }
}
