<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    /**
     * =============================
     * MASS ASSIGNABLE
     * =============================
     */
    protected $fillable = [
        'part_no',
        'brand',
        'part_name',
        'description',
        'category_id',
        'supplier_id',
        'asset_tag',
        'serial_number',
        'status',
        'assigned_to',
        'location',
        'purchase_date',
        'quantity'
    ];

    /**
     * =============================
     * DEFAULT VALUES (🔥 IMPORTANT)
     * =============================
     */
    protected $attributes = [
        'status' => 'available',
        'quantity' => 1,
    ];

    /**
     * =============================
     * RELATIONSHIPS
     * =============================
     */

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }

    /**
     * =============================
     * STATUS LABEL (🔥 UI HELPER)
     * =============================
     */
    public function getStatusLabelAttribute()
    {
        return ucfirst($this->status ?? 'unknown');
    }
}