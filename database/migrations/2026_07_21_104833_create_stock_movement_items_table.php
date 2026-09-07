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
        Schema::create('stock_movement_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('stock_movement_id')->constrained('stock_movement_headers')->onDelete('cascade');
            $table->foreignId('item_id')->constrained('inventory_items');
            
            // Source & Destination tracking
            $table->enum('source_location', ['surface', 'underground'])->default('surface');
            $table->foreignId('source_level_id')->nullable()->constrained('levels');
            
            $table->enum('destination_location', ['surface', 'underground'])->default('underground');
            $table->foreignId('destination_level_id')->nullable()->constrained('levels');
            
            $table->integer('quantity');
            $table->text('remarks')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stock_movement_items');
    }
};
