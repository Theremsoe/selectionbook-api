<?php

namespace App\Http\Controllers\Api\v1\Skill;

use App\Http\Controllers\Controller;
use App\Http\Resources\Skill\Resource;
use App\Model\Skill;

class ReadController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Skill $skill): Resource
    {
        return new Resource($skill);
    }
}
