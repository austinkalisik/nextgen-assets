<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Item;

class Supplier extends Model
{
    /**
     * =============================
     * MASS ASSIGNABLE FIELDS
     * =============================
     */
    protected $fillable = [
        'name',
        'email',
        'phone',
        'company',
    ];

    /**
     * =============================
     * RELATIONSHIP: SUPPLIER → ITEMS
     * =============================
     */
    public function items()
    {
        return $this->hasMany(Item::class);
    }
}