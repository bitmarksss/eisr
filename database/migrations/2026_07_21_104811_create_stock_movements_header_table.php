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
        Schema::create('stock_movements', function (Blueprint $table) {
            $table->id();
            $table->string('reference_no')->unique(); // e.g., ISS-2026-0001
            $table->enum('type', ['issuance', 'return', 'adjustment', 'transfer']);
            $table->foreignId('user_id')->nullable()->constrained('users'); // Who created the issuance
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stock_movements_header');
    }
};
