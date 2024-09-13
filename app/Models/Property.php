<?php
// app/Models/Property.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class Property extends Model
{
    use HasFactory;

    protected $keyType = 'string';
    public $incrementing = false;

    protected $guarded = ['id'];

    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->id)) {
                $model->id = (string) Str::uuid();
            }
        });
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function getRouteKeyName()
    {
        return 'id'; // Ensure this matches your primary key field
    } 

    public function images()
    {
        return $this->hasMany(PropertyImage::class);
    }

    public function document()
    {
        return $this->hasOne(Document::class); // Adjusted for one-to-one relationship
    }
    public function favoritedBy()
    {
        return $this->belongsToMany(User::class, 'favorites', 'property_id', 'user_id')->withTimestamps();
    }

    public function likedBy()
    {
        return $this->belongsToMany(User::class, 'likes', 'property_id', 'user_id')->withTimestamps();
    }
    public function favoritedByUsers()
    {
        return $this->belongsToMany(User::class, 'favorites', 'property_id', 'user_id')->withTimestamps();
    }

    // protected $keyType = 'uuid';
    // public $incrementing = false;

    // Relasi one-to-many dengan Comment
    public function comments()
    {
        return $this->hasMany(Comment::class, 'property_id');
    }

}
