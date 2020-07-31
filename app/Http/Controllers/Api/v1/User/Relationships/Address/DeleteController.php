<?php

namespace App\Http\Controllers\Api\v1\User\Relationships\Address;

use App\Http\Controllers\Controller;
use App\Http\Resources\Address\Resource;
use App\Model\Address;
use App\Model\User;

class DeleteController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(User $user, Address $address): Resource
    {
        $address->delete();

        return new Resource($address);
    }
}
