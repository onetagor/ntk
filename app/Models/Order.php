<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Order extends Model
{
    protected $fillable = [
        'order_number',
        'package_id',
        'customer_name',
        'customer_email',
        'customer_phone',
        'customer_address',
        'city',
        'postal_code',
        'package_price',
        'service_details',
        'preferred_date',
        'preferred_time',
        'special_instructions',
        'status',
        'payment_status',
        'payment_method',
        'admin_notes',
        'confirmed_at',
        'completed_at',
    ];

    protected $casts = [
        'preferred_date' => 'date',
        'confirmed_at' => 'datetime',
        'completed_at' => 'datetime',
        'package_price' => 'decimal:2',
    ];

    // Relationships
    public function package()
    {
        return $this->belongsTo(Package::class);
    }

    // Scopes
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    public function scopeConfirmed($query)
    {
        return $query->where('status', 'confirmed');
    }

    public function scopeCompleted($query)
    {
        return $query->where('status', 'completed');
    }

    // Accessors
    protected function statusBadge(): Attribute
    {
        return Attribute::make(
            get: function () {
                $colors = [
                    'pending' => '#ffc107',
                    'confirmed' => '#0dcaf0',
                    'in_progress' => '#0d6efd',
                    'completed' => '#198754',
                    'cancelled' => '#dc3545',
                ];

                return [
                    'color' => $colors[$this->status] ?? '#6c757d',
                    'class' => $this->status ?? 'secondary',
                ];
            }
        );
    }

    // Generate unique order number
    public static function generateOrderNumber()
    {
        $prefix = 'ORD';
        $date = now()->format('Ymd');
        $random = str_pad(rand(0, 9999), 4, '0', STR_PAD_LEFT);
        
        return $prefix . $date . $random;
    }
}

