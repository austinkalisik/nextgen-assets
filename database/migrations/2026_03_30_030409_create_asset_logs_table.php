<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
 public function up(): void
{
    Schema::create('asset_logs', function (Blueprint $table) {
        $table->id();

        $table->foreignId('item_id')->constrained()->cascadeOnDelete();
        $table->foreignId('user_id')->constrained()->cascadeOnDelete();

        $table->string('action');

        $table->longText('old_values')->nullable();
        $table->longText('new_values')->nullable();

        $table->timestamps();
    });
}

    public function down(): void
    {
        Schema::dropIfExists('asset_logs');
    }
};