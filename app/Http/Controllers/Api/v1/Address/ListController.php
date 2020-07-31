<?php

namespace App\Http\Controllers\Api\v1\Address;

use App\Http\Controllers\Controller;
use App\Http\Resources\Address\Collection;
use App\Model\Address;

class ListController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(): Collection
    {
        return new Collection(
            Address::paginate()
        );
    }
}
