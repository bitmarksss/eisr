<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('inventory_stocks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('item_id')->constrained('inventory_items')->onDelete('cascade');
            $table->enum('location', ['surface', 'underground']);
            $table->foreignId('level_id')->nullable()->constrained('levels')->onDelete('cascade');
            $table->integer('quantity')->default(0);
            $table->timestamps();

            // The Magic: Ensures an item only has ONE record per specific level/location
            $table->unique(['item_id', 'location', 'level_id'], 'item_location_level_unique');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inventory_stocks');
    }
};
