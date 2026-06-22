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
        Schema::create('user_permissions', function (Blueprint $table) {
            // 1. Define the foreign key for user
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            
            // 2. Define the string column for the module name
            $table->string('module_type');
            
            // 3. Standard CRUD columns
            $table->boolean('can_create')->default(false);
            $table->boolean('can_read')->default(false);
            $table->boolean('can_update')->default(false);
            $table->boolean('can_delete')->default(false);
            
            // 4. Flexible JSON list for custom actions (e.g., ["can_upload_excel"])
            $table->json('custom_permissions')->nullable();
            
            $table->timestamps();

            // 5. Define the composite primary key AFTER the columns exist
            $table->primary(['user_id', 'module_type']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_permissions');
    }
};