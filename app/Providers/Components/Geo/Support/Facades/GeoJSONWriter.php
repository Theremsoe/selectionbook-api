<?php

namespace App\Providers\Components\Geo\Support\Facades;

use App\Providers\Components\Geo\Support\GeoJSONWriter as SupportGeoJSONWriter;
use Illuminate\Support\Facades\Facade;

/**
 * @method static string write(\Brick\Geo\Geometry $geometry)
 * @method static array writeToArray(\Brick\Geo\Geometry $geometry)
 *
 * @see \App\Providers\Components\Geo\Support\GeoJSONWriter
 */
class GeoJSONWriter extends Facade
{
    /**
     * Get the registered name of the component.
     */
    protected static function getFacadeAccessor(): string
    {
        return SupportGeoJSONWriter::class;
    }
}
