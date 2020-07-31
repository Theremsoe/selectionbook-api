<?php

namespace App\Providers\Components\Geo\Support\Facades;

use Brick\Geo\IO\EWKBWriter as IOEWKBWriter;
use Illuminate\Support\Facades\Facade;

/**
 * @method static string write(\Brick\Geo\Geometry  $geojson)
 *
 * @see \App\Providers\Components\Geo\Support\GeoJSONReader
 */
class EWKBWriter extends Facade
{
    /**
     * Get the registered name of the component.
     */
    protected static function getFacadeAccessor(): string
    {
        return IOEWKBWriter::class;
    }
}
