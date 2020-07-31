<?php

namespace App\Providers\Components\Geo\Providers;

use App\Providers\Components\Geo\Support\GeoJSONReader;
use App\Providers\Components\Geo\Support\GeoJSONWriter;
use Brick\Geo\IO\EWKBReader;
use Brick\Geo\IO\EWKBWriter;
use Illuminate\Support\ServiceProvider;

class GeoServiceProvider extends ServiceProvider
{
    /**
     * All of the container singletons that should be registered.
     *
     * @var array
     */
    public $singletons = [
        GeoJSONReader::class,
        GeoJSONWriter::class,
        EWKBReader::class,
        EWKBWriter::class,
    ];
}
