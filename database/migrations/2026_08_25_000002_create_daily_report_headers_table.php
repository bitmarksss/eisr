<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::dropIfExists('daily_reports_header');
        Schema::create('daily_report_headers', function (Blueprint $table) {
            $table->id();
            $table->date('report_date');
            $table->foreignId('level_id')->constrained('levels');
            $table->foreignId('prepared_by')->constrained('users');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('daily_report_headers');
    }
};
