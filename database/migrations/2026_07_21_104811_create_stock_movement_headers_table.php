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
        Schema::create('stock_movement_headers', function (Blueprint $table) {
            $table->id();
            $table->string('reference_no')->unique(); // e.g., ISS-2026-0001
            $table->date('movement_date');
            $table->enum('type', ['receive', 'issuance', 'return', 'adjustment', 'transfer']);
            $table->foreignId('level_id')->nullable()->constrained('levels'); // Where the stock is issued
            $table->foreignId('user_id')->nullable()->constrained('users'); 
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stock_movements'); // removes old stock_movements_table
        Schema::dropIfExists('stock_movement_headers');
    }
};
