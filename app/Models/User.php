<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class User extends Authenticatable
{
    use HasFactory, Notifiable;
    use HasUuids;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    protected $guarded = ['id'];
    protected $fillable = [
        'fullname',
        'username',
        'email',
        'password',
        'phone',
        'gender',
        'age',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function properties() {
        return $this->hasMany(Property::class);
    }

    public function favorites()
    {
        return $this->belongsToMany(Property::class, 'favorites', 'user_id', 'property_id')->withTimestamps();
    }

    public function likes()
    {
        return $this->belongsToMany(Property::class, 'likes', 'user_id', 'property_id')->withTimestamps();

    // ini sebenernya gatau perlu atau ngga tapi liat dulu nanti
    public function profile() {
        return $this->hasMany(User::class);

    }
}
