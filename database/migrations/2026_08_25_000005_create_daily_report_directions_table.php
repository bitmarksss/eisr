<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('daily_report_directions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('detail_id')->constrained('daily_report_details')->cascadeOnDelete();
            $table->string('direction');
            $table->string('type', 2);
            $table->integer('distance');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('daily_report_directions');
    }
};
