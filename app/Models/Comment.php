<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Comment extends Model
{
    // use HasFactory;

    // Mengatur properti yang dapat diisi (mass assignable)
    protected $fillable = ['property_id', 'user_name', 'comment'];

    // Mengatur tipe data UUID untuk primary key
    protected $keyType = 'uuid';

    // Mengatur primary key tidak auto-increment
    public $incrementing = false;

    // Menginisialisasi model dengan UUID saat membuat entri baru
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->{$model->getKeyName()})) {
                $model->{$model->getKeyName()} = (string) Str::uuid();
            }
        });
    }

    // Relasi many-to-one dengan Property
    public function property()
    {
        return $this->belongsTo(Property::class, 'property_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
