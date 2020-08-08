<?php

namespace App\Model;

use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
// use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;

/**
 * @property int                                      $id
 * @property string                                   $name
 * @property null|string                              $last_name
 * @property string                                   $email
 * @property string                                   $username
 * @property string                                   $password
 * @property \Illuminate\Database\Eloquent\Collection $skills
 * @property \Illuminate\Database\Eloquent\Collection $addresses
 * @property \Illuminate\Support\Carbon               $born_date
 * @property \Illuminate\Support\Carbon               $created_at
 * @property \Illuminate\Support\Carbon               $updated_at
 * @property null|\Illuminate\Support\Carbon          $deleted_at
 */
class User extends Model implements AuthorizableContract, AuthenticatableContract
{
    use Notifiable;
    use SoftDeletes;
    use Authenticatable;
    use Authorizable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'last_name', 'email', 'username', 'born_date', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'born_date' => 'date:Y-m-d',
        'email_verified_at' => 'datetime',
    ];

    /**
     * Encrypt and set the user's password.
     */
    public function setPasswordAttribute(string $value): void
    {
        $this->attributes['password'] = Hash::make($value);
    }

    /**
     * Get the skils for the user.
     */
    public function skills(): HasMany
    {
        return $this->hasMany(Skill::class);
    }

    /**
     * Get the user addresses.
     */
    public function addresses(): MorphMany
    {
        return $this->morphMany(Address::class, 'addressable');
    }
}
