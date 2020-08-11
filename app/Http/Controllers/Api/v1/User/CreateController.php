<?php

namespace App\Http\Controllers\Api\v1\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\CreateRequest;
use App\Http\Resources\User\Resource;
use App\Model\User;
use Illuminate\Support\Str;

class CreateController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(CreateRequest $request): Resource
    {
        /** @var arra $data */
        $data = $request->validated();

        $data['password'] = Str::random(32);

        return new Resource(
            User::create($data)
        );
    }
}
