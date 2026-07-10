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
        Schema::create('stocks', function (Blueprint $table) {
            $table->id();
            $table->string('status')->default('pending');
            $table->string('kind');
            $table->string('type');
            $table->json('quantity');
            $table->foreignId('uom_id')->constrained('uoms'); 
            $table->foreignId('user_id')->constrained('users'); 
            $table->text('remarks')->nullable();
            $table->foreignId('prepared_by')->nullable()->constrained('users');
            $table->foreignId('reviewed_by')->nullable()->constrained('users');
            $table->foreignId('noted_by')->nullable()->constrained('users');
            $table->foreignId('endorsed_by')->nullable()->constrained('users');
            $table->foreignId('approved_by')->nullable()->constrained('users');
            $table->foreignId('noted_by_2')->nullable()->constrained('users');
            $table->foreignId('approved_by_2')->nullable()->constrained('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stocks');
    }
};
