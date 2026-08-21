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
        Schema::create('daily_reports_header', function (Blueprint $table) {
            $table->id();
            $table->date('report_date');
            $table->string('location');
            $table->string('contractor_name');
            $table->string('support');
            $table->integer('drill_steel');
            $table->string('working_place');
            $table->foreignId('uploaded_by')->constrained('users'); // Admin user who generated it
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('daily_reports_header');
    }
};
