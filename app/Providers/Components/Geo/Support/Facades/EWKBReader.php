<?php

namespace App\Providers\Components\Geo\Support\Facades;

use Brick\Geo\IO\EWKBReader as IOEWKBReader;
use Illuminate\Support\Facades\Facade;

/**
 * @method static \Brick\Geo\Geometry read(string $geojson)
 *
 * @see \App\Providers\Components\Geo\Support\GeoJSONReader
 */
class EWKBReader extends Facade
{
    /**
     * Get the registered name of the component.
     */
    protected static function getFacadeAccessor(): string
    {
        return IOEWKBReader::class;
    }
}
