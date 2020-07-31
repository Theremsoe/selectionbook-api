<?php

namespace App\Http\Controllers\Api\v1\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\User\Collection;
use App\Model\User;

class ListController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(): Collection
    {
        return new Collection(
            User::paginate()
        );
    }
}
