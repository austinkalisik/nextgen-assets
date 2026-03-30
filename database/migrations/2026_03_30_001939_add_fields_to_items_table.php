<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('items', function (Blueprint $table) {

            $table->string('asset_tag')->nullable();
            $table->string('serial_number')->nullable();

            $table->string('status')->default('available');

            $table->unsignedBigInteger('assigned_to')->nullable();

            $table->string('location')->nullable();
            $table->date('purchase_date')->nullable();

            $table->integer('quantity')->default(1);

            // Foreign key (optional but professional)
            $table->foreign('assigned_to')->references('id')->on('users')->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('items', function (Blueprint $table) {

            $table->dropColumn([
                'asset_tag',
                'serial_number',
                'status',
                'assigned_to',
                'location',
                'purchase_date',
                'quantity'
            ]);
        });
    }
};