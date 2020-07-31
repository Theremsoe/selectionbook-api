<?php

namespace App\Http\Controllers\Api\v1\User\Relationships\Address;

use App\Http\Controllers\Controller;
use App\Http\Requests\Address\UpdateRequest;
use App\Http\Resources\Address\Resource;
use App\Model\Address;
use App\Model\User;

class UpdateController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(UpdateRequest $request, User $user, Address $address): Resource
    {
        $address->update(
            $request->validated()
        );

        return new Resource($address);
    }
}
