<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('stock_movement_headers', function (Blueprint $table) {
            $table->string('status')->default('pending_approval')->after('type');
        });

        Schema::create('stock_movement_approvals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('stock_movement_id')->constrained('stock_movement_headers')->cascadeOnDelete();
            $table->foreignId('user_id')->constrained('users');
            $table->unsignedTinyInteger('approver_slot');
            $table->string('status')->default('pending');
            $table->timestamp('approved_at')->nullable();
            $table->text('remarks')->nullable();
            $table->timestamps();
            $table->unique(['stock_movement_id', 'approver_slot']);
            $table->unique(['stock_movement_id', 'user_id']);
        });

        Schema::create('stock_movement_approver_assignments', function (Blueprint $table) {
            $table->id();
            $table->unsignedTinyInteger('approver_slot')->unique();
            $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
        });

        for ($slot = 1; $slot <= 5; $slot++) {
            DB::table('stock_movement_approver_assignments')->insert([
                'approver_slot' => $slot, 'user_id' => null,
                'created_at' => now(), 'updated_at' => now(),
            ]);
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('stock_movement_approvals');
        Schema::dropIfExists('stock_movement_approver_assignments');
        Schema::table('stock_movement_headers', fn (Blueprint $table) => $table->dropColumn('status'));
    }
};
