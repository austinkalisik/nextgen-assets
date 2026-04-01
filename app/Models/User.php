<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * =============================
     * RELATIONSHIPS
     * =============================
     */

    // 🔥 FIX: plural (hasMany)
    public function assignments()
    {
        return $this->hasMany(Assignment::class);
    }

    // 🔥 ADD: items through assignments
    public function assignedItems()
    {
        return $this->hasManyThrough(
            Item::class,
            Assignment::class,
            'user_id', // FK on assignments
            'id',      // FK on items
            'id',      // local key users
            'item_id'  // local key assignments
        );
    }

    /**
     * =============================
     * MASS ASSIGNABLE FIELDS
     * =============================
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    /**
     * =============================
     * DEFAULT ROLE ( IMPORTANT)
     * =============================
     */
    protected $attributes = [
        'role' => 'user',
    ];

    /**
     * =============================
     * HIDDEN FIELDS
     * =============================
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
}