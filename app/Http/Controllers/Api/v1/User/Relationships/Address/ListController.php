<?php

namespace App\Http\Controllers\Api\v1\User\Relationships\Address;

use App\Http\Controllers\Controller;
use App\Http\Resources\Address\Collection;
use App\Model\User;

class ListController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(User $user): Collection
    {
        return new Collection(
            $user->addresses()->paginate()
        );
    }
}
