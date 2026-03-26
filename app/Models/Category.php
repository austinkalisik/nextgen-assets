<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Item;

class Category extends Model
{
    /**
     * =============================
     * MASS ASSIGNABLE FIELDS
     * =============================
     */
    protected $fillable = [
        'name',
        'description',
    ];

    /**
     * =============================
     * RELATIONSHIP: CATEGORY → ITEMS
     * =============================
     */
    public function items()
    {
        return $this->hasMany(Item::class);
    }
}