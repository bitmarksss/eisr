<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('daily_report_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('header_id')->constrained('daily_report_headers')->cascadeOnDelete();
            $table->string('contractor_name');
            $table->string('support');
            $table->integer('drill_steel');
            $table->string('working_place');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('daily_report_details');
    }
};
