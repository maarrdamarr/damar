<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    // Allow mass assignment for all fields (simple app)
    protected $guarded = [];

    /**
     * Attribute casts
     */
    protected $casts = [
        'is_read' => 'boolean',
    ];

    // Ensure default for is_read when creating
    protected $attributes = [
        'is_read' => false,
    ];

    // Relations
    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

    public function receiver()
    {
        return $this->belongsTo(User::class, 'receiver_id');
    }

    public function item()
    {
        return $this->belongsTo(Item::class);
    }
}
