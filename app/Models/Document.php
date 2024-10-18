<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Document extends Model
{
    use HasFactory;
    use HasUuids;

    protected $table = 'documents';

    // It's better to use either guarded or fillable, not both.
    protected $fillable = [
        'property_id',
        'user_id',
        'type',
        'file',    // Changed 'images' to 'file' to match the migration
        'status',
    ];


    // Define the inverse relationship with the Property model
    public function property()
    {
        return $this->belongsTo(Property::class, 'property_id');
    }
}
