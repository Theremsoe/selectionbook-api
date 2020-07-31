<?php

namespace App\Http\Controllers\Api\v1\Skill;

use App\Http\Controllers\Controller;
use App\Http\Resources\Skill\Collection;
use App\Model\Skill;

class ListController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(): Collection
    {
        return new Collection(
            Skill::paginate()
        );
    }
}
