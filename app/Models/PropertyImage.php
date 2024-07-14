<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class PropertyImage extends Model
{
    use HasFactory;
    use HasUuids;

    protected $table = "property_images";

    protected $guarded = ['id'];

    protected $fillable = [
        'property_id',
        'user_id',
        'images'
    ];

    public function properties()
    {
        return $this->belongsTo(Property::class);
    }
}
