<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Favourite extends Model
{
    use HasFactory;
    use HasUuids;

    protected $table = "favorites";

    protected $guarded = ['id'];

    protected $fillable = ['user_id', 'property_id'];
    
}
