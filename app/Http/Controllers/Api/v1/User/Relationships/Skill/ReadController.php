<?php

namespace App\Http\Controllers\Api\v1\User\Relationships\Skill;

use App\Http\Controllers\Controller;
use App\Http\Resources\Skill\Resource;
use App\Model\Skill;
use App\Model\User;

class ReadController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(User $user, Skill $skill): Resource
    {
        return new Resource($skill);
    }
}
