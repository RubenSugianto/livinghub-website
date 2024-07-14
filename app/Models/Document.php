<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Document extends Model
{
    use HasFactory;
    use HasUuids;

    protected $table = "documents";

    protected $guarded = ['id'];

    protected $fillable = [
        'property_id',
        'user_id',
        'type',
        'images',
        'status',
    ];
}
