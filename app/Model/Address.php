<?php

namespace App\Model;

use App\Providers\Components\Geo\Casts\GeometryCast;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property int                             $id
 * @property string                          $addressable_type
 * @property int                             $addressable_id
 * @property string                          $street
 * @property string                          $city
 * @property string                          $state
 * @property string                          $zipcode
 * @property string                          $country
 * @property \Brick\Geo\Geometry             $geometry
 * @property \App\Model|\App\Model\User      $addressable
 * @property \Illuminate\Support\Carbon      $created_at
 * @property \Illuminate\Support\Carbon      $updated_at
 * @property null|\Illuminate\Support\Carbon $deleted_at
 */
class Address extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'street', 'city', 'state', 'zipcode', 'country', 'geometry',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'geometry' => GeometryCast::class,
    ];

    /**
     * Get the owning address model.
     */
    public function addressable(): MorphTo
    {
        return $this->morphTo();
    }
}
