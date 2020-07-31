<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property int                             $id
 * @property string                          $name
 * @property null|string                     $details
 * @property \App\Model\User                 $user
 * @property \Illuminate\Support\Carbon      $created_at
 * @property \Illuminate\Support\Carbon      $updated_at
 * @property null|\Illuminate\Support\Carbon $deleted_at
 */
class Skill extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'details',
    ];

    /**
     * Get the user that owns the skill.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
