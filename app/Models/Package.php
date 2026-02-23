<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'price',
        'features',
        'badge',
        'order',
        'status',
    ];

    protected $casts = [
        'status' => 'boolean',
        'price' => 'decimal:2',
        'features' => 'array',
    ];

    public function scopeActive($query)
    {
        return $query->where('status', 1)->orderBy('order');
    }
}
