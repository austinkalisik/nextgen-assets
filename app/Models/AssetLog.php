<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AssetLog extends Model
{
    protected $fillable = [
        'item_id',
        'user_id',
        'action',
        'old_values',
        'new_values'
    ];

    protected $casts = [
        'old_values' => 'array',
        'new_values' => 'array',
    ];

    public function item()
    {
        return $this->belongsTo(Item::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
