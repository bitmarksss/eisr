<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::dropIfExists('daily_report_items');
        Schema::create('daily_report_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('detail_id')->constrained('daily_report_details')->cascadeOnDelete();
            $table->foreignId('item_id')->constrained('inventory_items');
            $table->decimal('quantity', 12, 3);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('daily_report_items');
    }
};
