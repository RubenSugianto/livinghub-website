<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Like extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'likes'; // Ensure table name matches the actual database table name

    protected $guarded = ['id']; // Prevent 'id' from being mass-assigned
    protected $fillable = ['user_id', 'property_id']; // Allow these fields to be mass-assigned

    /**
     * Define the relationship with the `User` model.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Define the relationship with the `Property` model.
     */
    public function property()
    {
        return $this->belongsTo(Property::class);
    }
}
