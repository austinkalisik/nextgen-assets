<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Assignment extends Model
{
    /**
     * =============================
     * MASS ASSIGNABLE
     * =============================
     */
    protected $fillable = [
        'item_id',
        'user_id',
        'assigned_at',
        'returned_at',
    ];

    /**
     * =============================
     * CAST DATES (IMPORTANT)
     * =============================
     */
    protected $casts = [
        'assigned_at' => 'datetime',
        'returned_at' => 'datetime',
    ];

    /**
     * =============================
     * RELATIONSHIPS
     * =============================
     */

    public function item()
    {
        return $this->belongsTo(Item::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}