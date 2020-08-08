<?php

namespace App\Http\Controllers\Api\v1\User\Relationships\Skill;

use App\Http\Controllers\Controller;
use App\Http\Resources\Skill\Collection;
use App\Model\User;

class ListController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(User $user): Collection
    {
        return new Collection(
            $user->skills()->with('user')->paginate()
        );
    }
}
