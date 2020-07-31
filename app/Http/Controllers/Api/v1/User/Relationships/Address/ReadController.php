<?php

namespace App\Http\Controllers\Api\v1\User\Relationships\Address;

use App\Http\Controllers\Controller;
use App\Http\Resources\Address\Resource;
use App\Model\Address;

class ReadController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Address $address): Resource
    {
        return new Resource($address);
    }
}
