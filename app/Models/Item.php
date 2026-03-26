<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    /**
     * =============================
     * MASS ASSIGNABLE FIELDS
     * =============================
     */
    protected $fillable = [
        'part_no',
        'brand',
        'part_name',
        'description',
        'category_id',
        'supplier_id',
    ];

    /**
     * =============================
     * RELATIONSHIPS
     * =============================
     */

    // Product belongs to Category
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // Product belongs to Supplier
    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }
}