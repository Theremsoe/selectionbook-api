<?php

namespace App\Providers\Components\Geo\Support\Facades;

use App\Providers\Components\Geo\Support\GeoJSONReader as SupportGeoJSONReader;
use Illuminate\Support\Facades\Facade;

/**
 * @method static \Brick\Geo\Geometry read(string $geojson)
 * @method static \Brick\Geo\Geometry readGeoJSON(array $geojson)
 *
 * @see \App\Providers\Components\Geo\Support\GeoJSONReader
 */
class GeoJSONReader extends Facade
{
    /**
     * Get the registered name of the component.
     */
    protected static function getFacadeAccessor(): string
    {
        return SupportGeoJSONReader::class;
    }
}
