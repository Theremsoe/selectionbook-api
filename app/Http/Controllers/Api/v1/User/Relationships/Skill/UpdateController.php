<?php

namespace App\Http\Controllers\Api\v1\User\Relationships\Skill;

use App\Http\Controllers\Controller;
use App\Http\Requests\Skill\UpdateRequest;
use App\Http\Resources\Skill\Resource;
use App\Model\Skill;
use App\Model\User;

class UpdateController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(UpdateRequest $request, User $user, Skill $skill): Resource
    {
        $skill->update(
            $request->validated()
        );

        return new Resource($skill);
    }
}
