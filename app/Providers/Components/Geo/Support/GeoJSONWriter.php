<?php

namespace App\Providers\Components\Geo\Support;

use Brick\Geo\Exception\GeometryIOException;
use Brick\Geo\Geometry;
use Brick\Geo\GeometryCollection;
use Brick\Geo\IO\GeoJSONWriter as IOGeoJSONWriter;

class GeoJSONWriter extends IOGeoJSONWriter
{
    protected bool $prettyPrint;

    /**
     * GeoJSONWriter constructor.
     *
     * @param bool $prettyPrint whether to pretty-print the JSON output
     */
    public function __construct(bool $prettyPrint = false)
    {
        $this->prettyPrint = $prettyPrint;
    }

    /**
     * Convert a geometry to RFC 7946 string.
     *
     * @param Geometry $geometry the geometry to export as GeoJSON
     *
     * @throws GeometryIOException if the given geometry cannot be exported as GeoJSON
     */
    public function write(Geometry $geometry): string
    {
        return $this->genGeoJSONString(
            $this->writeToArray($geometry)
        );
    }

    /**
     * Convert a geometry to RFC 7946 array.
     *
     * @param Geometry $geometry the geometry to export as GeoJSON
     *
     * @throws GeometryIOException if the given geometry cannot be exported as GeoJSON
     */
    public function writeToArray(Geometry $geometry): array
    {
        return self::isGeometricCollection($geometry)
        ? $this->writeFeatureCollection($geometry)
        : $this->formatGeoJSONGeometry($geometry);
    }

    public static function isGeometricCollection(Geometry $geometry): bool
    {
        return $geometry instanceof GeometryCollection
        // Filter out MultiPoint, MultiLineString and MultiPolygon
        && 'GeometryCollection' === $geometry->geometryType();
    }

    /**
     * @throws GeometryIOException
     */
    protected function formatGeoJSONGeometry(Geometry $geometry): array
    {
        $geometryType = $geometry->geometryType();
        $validGeometries = [
            'Point',
            'MultiPoint',
            'LineString',
            'MultiLineString',
            'Polygon',
            'MultiPolygon',
        ];

        if (! \in_array($geometryType, $validGeometries)) {
            throw GeometryIOException::unsupportedGeometryType($geometry->geometryType());
        }

        return [
            'type' => $geometryType,
            'coordinates' => $geometry->toArray(),
        ];
    }

    /**
     * @throws GeometryIOException
     */
    protected function writeFeatureCollection(GeometryCollection $geometryCollection): array
    {
        $geojsonArray = [
            'type' => 'FeatureCollection',
            'features' => [],
        ];

        foreach ($geometryCollection->geometries() as $geometry) {
            $geojsonArray['features'][] = [
                'type' => 'Feature',
                'geometry' => $this->formatGeoJSONGeometry($geometry),
            ];
        }

        return $geojsonArray;
    }

    protected function genGeoJSONString(array $geojsonArray): string
    {
        return json_encode($geojsonArray, $this->prettyPrint ? JSON_PRETTY_PRINT : 0);
    }
}
