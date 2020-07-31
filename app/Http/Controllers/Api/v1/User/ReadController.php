<?php

namespace App\Http\Controllers\Api\v1\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\User\Resource;
use App\Model\User;

class ReadController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(User $user): Resource
    {
        return new Resource($user);
    }
}
