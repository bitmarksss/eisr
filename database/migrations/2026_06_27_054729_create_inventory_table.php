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
        Schema::create('inventory', function (Blueprint $table) {
            $table->id();
            $table->string('item_code')->unique(); // Added unique item code column
            $table->foreignId('supplier_id')->constrained('suppliers'); // Suppliers table
            $table->string('name');
            $table->string('location'); // Added location column
            $table->foreignId('kind_id')->constrained('inventory_kinds'); // Inventory kinds table
            $table->integer('quantity')->default(0);
            $table->foreignId('uom')->constrained('uoms'); // Unit of measurements table
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inventory');
    }
};