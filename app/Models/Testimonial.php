<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'position',
        'comment',
        'image',
        'rating',
        'order',
        'status',
    ];

    protected $casts = [
        'rating' => 'integer',
    ];

    public function scopeActive($query)
    {
        return $query->where('status', 'active')->orderBy('order');
    }
}
