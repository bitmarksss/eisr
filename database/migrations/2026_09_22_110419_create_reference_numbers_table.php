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
        Schema::create('reference_numbers', function (Blueprint $table) {
            $table->id();

            $table->string('type', 50);
            $table->string('prefix', 50);

            $table->unsignedSmallInteger('year');
            $table->unsignedTinyInteger('month');

            $table->unsignedInteger('last_number')->default(0);

            $table->timestamps();

            $table->unique(['type', 'year', 'month']);
        });


    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reference_numbers');
    }
};
