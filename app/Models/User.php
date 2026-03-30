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
     * MASS ASSIGNABLE
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
        'role' => 'user', // default role
    ];

    /**
     * =============================
     * HIDDEN
     * =============================
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * =============================
     * CASTS
     * =============================
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    /**
     * =============================
     * RELATION: USER HAS ASSETS
     * =============================
     */
    public function assets()
    {
        return $this->hasMany(Item::class, 'assigned_to');
    }

    /**
     * =============================
     * ROLE HELPERS (PRO LEVEL)
     * =============================
     */

    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    public function isUser()
    {
        return $this->role === 'user';
    }

    /**
     * =============================
     * FLEXIBLE PERMISSION CHECK
     * =============================
     */
    public function hasRole($role)
    {
        return $this->role === $role;
    }
}