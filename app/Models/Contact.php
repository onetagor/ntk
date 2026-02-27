<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'message',
        'status',
        'admin_reply',
        'replied_at',
        'replied_by',
    ];

    protected $casts = [
        'replied_at' => 'datetime',
    ];

    /**
     * Get the admin who replied to this contact.
     */
    public function repliedBy()
    {
        return $this->belongsTo(Admin::class, 'replied_by');
    }

    /**
     * Scope to get pending contacts.
     */
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    /**
     * Scope to get replied contacts.
     */
    public function scopeReplied($query)
    {
        return $query->where('status', 'replied');
    }
}
