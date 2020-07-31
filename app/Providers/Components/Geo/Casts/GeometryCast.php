<?php

namespace App\Providers\Components\Geo\Casts;

use App\Providers\Components\Geo\Support\Facades\EWKBReader;
use App\Providers\Components\Geo\Support\Facades\EWKBWriter;
use App\Providers\Components\Geo\Support\Facades\GeoJSONReader;
use Brick\Geo\Geometry;
use Illuminate\Contracts\Database\Eloquent\CastsAttributes;

class GeometryCast implements CastsAttributes
{
    /**
     * Cast the given value.
     *
     * @param \Illuminate\Database\Eloquent\Model $model
     * @param string                              $value
     *
     * @throws \Brick\Geo\Exception\GeometryException if the GeoJSON file is invalid
     */
    public function get($model, string $key, $value, array $attributes): Geometry
    {
        return EWKBReader::read(hex2bin($value));
    }

    /**
     * Prepare the given value for storage.
     *
     * @param \Illuminate\Database\Eloquent\Model $model
     * @param array|\Brick\Geo\Geometry|string    $value
     *
     * @throws \Brick\Geo\Exception\GeometryException if the GeoJSON file is invalid
     */
    public function set($model, string $key, $value, array $attributes): string
    {
        /** @var null|\Brick\Geo\Geometry $geometry */
        $geometry = $value instanceof Geometry ? $value : null;

        if (\is_array($value)) {
            $geometry = GeoJSONReader::readGeoJSON($value);
        }

        return $geometry ? bin2hex(EWKBWriter::write($geometry)) : $value;
    }
}
