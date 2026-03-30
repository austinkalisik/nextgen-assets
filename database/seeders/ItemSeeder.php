<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Item;

class ItemSeeder extends Seeder
{
    public function run(): void
    {
        Item::insert([

            [
                'part_no' => 'LAP-001',
                'brand' => 'Dell',
                'part_name' => 'Laptop',
                'description' => 'Dell Latitude Laptop',
                'status' => 'available',
                'quantity' => 5,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'part_no' => 'PHN-002',
                'brand' => 'Samsung',
                'part_name' => 'Galaxy Phone',
                'description' => 'Samsung Galaxy S21',
                'status' => 'assigned',
                'quantity' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'part_no' => 'MON-003',
                'brand' => 'LG',
                'part_name' => 'Monitor',
                'description' => '27 inch monitor',
                'status' => 'maintenance',
                'quantity' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],

        ]);
    }
}